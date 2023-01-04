<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\EventTicketController;
use App\Http\Controllers\TicketSaleController;
use App\Http\Controllers\GuestController;
use App\Models\EventTickets;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\InputFields;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\WebProfile;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// event api
Route::post('store/event', [EventController::class, 'eventStore'])->name('event.store');
Route::post('event/edit/{eventId}', [EventController::class, 'eventEdit'])->name('event.edit');
Route::post('event/publish/{eventId}', [EventController::class, 'editPublish'])->name('event.publish');
Route::get('event/{eventList}', [EventController::class, 'getEvent'])->name('event.get');

// fileUpload api
Route::post('store/file-upload/{id?}', [FileUploadController::class, 'fileUpload'])->name('file.store');
Route::get('files/{id}', [FileUploadController::class, 'files'])->name('files');
Route::get('file-delete/{id}', [FileUploadController::class, 'fileDelete'])->name('file.delete');


// ticket api
Route::post('create/ticket/{event_id}', [EventTicketController::class, 'store'])->name('ticket.create');
Route::post('update/ticket/{id}', [EventTicketController::class, 'update'])->name('ticket.update');
Route::get('get/tickets/{event_id}', [EventTicketController::class, 'getTicket'])->name('ticket.create');
Route::get('duplicate/ticket/{id}', [EventTicketController::class, 'duplicate'])->name('ticket.duplicate');
Route::get('delete/ticket/{id}', [EventTicketController::class, 'deleteTicket'])->name('ticket.delete');
Route::post('ticket/sale', [TicketSaleController::class, 'sale'])->name('ticket.sale');



// get user ip info
Route::get('/get-ip', function() {
    $json = file_get_contents("https://ipinfo.io/json");
    return json_decode($json);
})->name('get_ip');

// guest api
Route::get('guest/{email}', [GuestController::class, 'getGuest'])->name('get.guest');
Route::post('guest-create', [GuestController::class, 'createGuest'])->name('create.guest');
Route::get('/event-history/{email}', [GuestController::class, 'getHistory'])->name('get.history');

// get event guest
Route::get('event-guest/{eventList}', [EventController::class, 'getEventGuest'])->name('get.event_guest');
Route::get('event-sales/{eventList}', [EventController::class, 'getEventSales'])->name('get.event_sales');

Route::post('checkin', [EventController::class, 'checkin'])->name('check_in');


Route::post('/stripe-pay', [TicketSaleController::class, 'stripe_pay'])->name('stripe.pay');

Route::post('create-payment', function (Request $request) {
    return $request->all();
    // return $request->all();
    $card = collect($request->all());
    $items = [];
    $sub_total = 0;
    foreach ($card as $key => $od) { 
        $ticket = EventTickets::where('id', $od['ticket_id'])->first();
        $order_items = [];
        // return $ticket;
        $sub_total += $od['price'] * $od['quantity'];
        $order_items['amount']['value'] = $od['price'] * $od['quantity'];
        // $order_items->setName($ticket->ticket_name)
        //     ->setCurrency('USD')
        //     ->setQuantity($od['quantity'])
        //     // ->setSku("123123") // Similar to `item_number` in Classic API
        //     ->setPrice($od['price']);
        array_push($items, $order_items);
        // $items[] = $order_items;
        // return $order_items;
    }
    return $items;
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            env('PAYPAL_SANDBOX_CLIENT_ID'),     // ClientID
            env('PAYPAL_SANDBOX_CLIENT_SECRET')      // ClientSecret
        )
    );

    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

    $items = [];
    $sub_total = 0;
    foreach ($card as $key => $od) { 
        $ticket = EventTickets::where('id', $od['ticket_id'])->first();
        $order_items = new Item();
        // return $ticket;
        $sub_total += $od['price'] * $od['quantity'];
        $order_items->setName($ticket->ticket_name)
            ->setCurrency('USD')
            ->setQuantity($od['quantity'])
            // ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice($od['price']);
        array_push($items, $order_items);
        // $items[] = $order_items;
        // return $order_items;
    }
    // return $items;
    // return $sub_total;



    $itemList = new ItemList();
    // $itemList->setItems(array($item1, $item2));
    $itemList->setItems($items);

    $details = new Details();
    $details->setSubtotal($sub_total);
    // $details->setShipping(1.2)
    //     ->setTax(1.3)
    //     ->setSubtotal(17.50);

    $amount = new Amount();
    $amount->setCurrency("USD")
        ->setTotal($sub_total)
        ->setDetails($details);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription("Payment description")
        ->setInvoiceNumber(uniqid());

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl(route('home'))
        ->setCancelUrl(route('home'));

    // Add NO SHIPPING OPTION
    $inputFields = new InputFields();
    $inputFields->setNoShipping(1);

    $webProfile = new WebProfile();
    $webProfile->setName('test' . uniqid())->setInputFields($inputFields);

    $webProfileId = $webProfile->create($apiContext)->getId();

    $payment = new Payment();
    $payment->setExperienceProfileId($webProfileId); // no shipping
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));

        $payment->create($apiContext);
    // try {
    // } catch (Exception $ex) {
    //     echo $ex;
    //     exit(1);
    // }

    return $payment;
})->name('create_payment');

Route::post('execute-payment/{order}', function (Request $request, Request $order) {
    if ($order->payment_status == 1) {
        return null;
    }
    // return $order;
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            env('PAYPAL_SANDBOX_CLIENT_ID'),     // ClientID
            env('PAYPAL_SANDBOX_CLIENT_SECRET')      // ClientSecret
        )
    );

    $paymentId = $request->paymentID;
    $payment = Payment::get($paymentId, $apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($request->payerID);

    $transaction = new Transaction();
    $amount = new Amount();
    $details = new Details();

    // $details->setShipping(2.2)
    //     ->setTax(1.3)
    //     ->setSubtotal(17.50);
    $details->setSubtotal($order->sub_total);
        // ->setShipping($order->shipping_cost)
        // ->setTax(1.3)

    $amount->setCurrency('USD');
    $amount->setTotal($order->sub_total);
    $amount->setDetails($details);
    $transaction->setAmount($amount);

    $execution->addTransaction($transaction);

    try {
        $result = $payment->execute($execution, $apiContext);
        $order->update([
            'payment_status' => 1,
            'status' => 3
        ]);
        $order->transaction()->create([
            'amount' => $order->sub_total,
            // 'order_id' => '',
            'transaction_info' => json_encode($result),
        ]);
        Session::flash('done_order', 'done');
    } catch (Exception $ex) {
        echo $ex;
        exit(1);
    }

    return $result;
});