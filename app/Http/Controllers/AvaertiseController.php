<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AvaertiseController extends Controller
{
    use Utils; 
    public function index() {
        if(auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
        $advertises = Advertise::orderBy('position', 'ASC')
                        ->get()
                        ->map(function ($item) {
                            // $item['start_at'] = Carbon::parse($item->start_at)->format('Y-m-d H:i:s A');
                            // $item['end_at'] = Carbon::parse($item->end_at)->format('Y-m-d H:i:s A');
                            return $item;
                        });
        return Inertia::render('Advertise', [
            'advertises' => $advertises,
        ]);
    }

    public function store(Request $request) {
        if(auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
        $request->validate([
            'title' => 'required',
            'link' => 'required',
        ]);
        // return $request->all();
        DB::beginTransaction();
        if (isset($request->advertise_id)) {
            // return $request->all();
            $ad = Advertise::find($request->advertise_id);
            $data = [
                'title' => $request->title,
                // 'image' => $fileLocation,
                'description' => $request->description,
                'status' => $request->status,
                'link' => $request->link,
                'featured' => $request->featured,
                'position' => $request->position,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
                'settings' => $request->settings ? $request->settings : null,
            ];
            if ($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $uniqueCode = md5(uniqid(rand(), true));
                $file_name  = $request->type.'-'.$uniqueCode.'-'.$file->getClientOriginalName();
                $file_type  = $file->getClientOriginalExtension();
                $data['image'] = $file->move('images', $file_name);
                if (file_exists(public_path($ad->image))) {
                    unlink(public_path($ad->path));
                }
            }
            $ad->update($data);
        } else {
            $request->validate([
                'banner_image' => 'required|image',
            ]);
            $file = $request->file('banner_image');
            $uniqueCode = md5(uniqid(rand(), true));
            $file_name  = $request->type.'-'.$uniqueCode.'-'.$file->getClientOriginalName();
            $file_type  = $file->getClientOriginalExtension();
            $fileLocation = $file->move('images', $file_name);
            Advertise::create([
                'title' => $request->title,
                'image' => $fileLocation,
                'description' => $request->description,
                'status' => $request->status,
                'link' => $request->link,
                'featured' => $request->featured,
                'position' => $request->position,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
                'settings' => $request->settings ? $request->settings : null,
            ]);
        }
        DB::commit();
        return back()->with('success', 'Advertise create successfully');
    }

    public function delete(Request $request) {
        if(auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
        $request->validate([
            'advertise_id' => 'required'
        ]);
        $ad = Advertise::find($request->advertise_id);
        if (file_exists(public_path($ad->image))) {
            unlink(public_path($ad->image));
        }
        $ad->delete();
        return back();
    }
}
