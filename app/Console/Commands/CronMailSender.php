<?php

namespace App\Console\Commands;

use App\Mail\CanWithdraw;
use App\Mail\EventNoticeMail;
use App\Mail\EventOverMail;
use App\Models\EventList;
use App\Models\Guests;
use App\Models\TicketSales;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CronMailSender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    
     public function sendNotice($eventList, $type) {
        foreach ($eventList as $key => $event) {
            $ids = $event->eventTickets()->pluck('id');
            $sales = TicketSales::where('guest_id', '!=', null)->whereIn('ticket_id', $ids)->pluck('guest_id');
            $guests = Guests::whereIn('id', $sales)->get();
            if ($type == 'admin_overview_notice') {
                $all_sales = TicketSales::where('guest_id', '!=', null)->whereIn('ticket_id', $ids)->get();
                $commission = 0; // (($sales->sum('price') / 100) * $sales->sum('commission'))
                $total_sales_amount =  0; //$sales->sum('price') - $commission;
                foreach ($all_sales as $key => $v) {
                    $t_com = (($v->price * $v->quantity) / 100) * $v->commission;
                    $commission += $t_com;
                    $total_sales_amount += ($v->price * $v->quantity) - $t_com;
                }
                $admin = User::where('type', 'admin')->first();
                $summery = [
                    'commission' => $commission,
                    'total_sales_amount' => $total_sales_amount,
                    'total_attendees' => $all_sales->count('quantity'),
                ];
                $event->update([
                    'admin_overview_notice' => 1
                ]);
                Mail::to($admin)->send(new EventOverMail($event->user, $event, $summery));
            }
            if($type == 'can_withdraw_notice') {
                Mail::to($event->user)->send(new CanWithdraw($event->user, $event));
                $event->update([
                    'can_withdraw_notice' => 1
                ]);
            }
            if ($type=='weekly_notice') {
                $event->update(['weekly_notice' => 1]);
                foreach ($guests as $guest) {
                    Mail::to($guest)->send(new EventNoticeMail($guest, $event));
                }
            }
            if ($type=='hourly_notice') {
                // dd($event);
                $event->update(['hourly_notice' => 1]);
                foreach ($guests as $guest) {
                    Mail::to($guest)->send(new EventNoticeMail($guest, $event));
                } 
            }
        }
    }

    public function sendWeekNotice() {
        $query = EventList::query();
        $query->where('publish', 1)
            ->where('weekly_notice', 0)
            ->whereDate('start_date', '=', now()->addWeek());

        $eventList = $query->get();
        $this->sendNotice($eventList, 'weekly_notice');
    }

    public function sendHourlyNotice() {
        $query = EventList::query();
        $query->where('publish', 1);
        $eventList = $query->where('hourly_notice', 0)->get()->map(function($event) {
            // $event->start_at = Carbon::parse(date('Y-m-d H:i:s', strtotime("$event->start_date $event->start_time")));
            return $event;
        })->whereBetween('start_date', [Carbon::now(), Carbon::now()->addDays(2)]); 
        $this->sendNotice($eventList, 'hourly_notice');
    }

    public function sendOverviewNotice() {
        $query = EventList::query();
        $query->where('publish', 1);
        $eventList = $query->where('admin_overview_notice', 0)->whereDate('end_date', '<', now())->get();
        $this->sendNotice($eventList, 'admin_overview_notice');
    }
    public function canWithdraw() {
        $query = EventList::query();
        $query->where('publish', 1);
        $eventList = $query->where('can_withdraw_notice', 0)->whereDate('end_date', '<', now())->get();
        $this->sendNotice($eventList, 'can_withdraw_notice');
    }


    public function handle()
    {
        $this->sendHourlyNotice();
        $this->sendWeekNotice();
        $this->sendOverviewNotice();
        $this->canWithdraw();
        // admin_overview_notice
    }
}

