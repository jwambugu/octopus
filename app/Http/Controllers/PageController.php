<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Render the application index page.
     * @param Request $request
     * @return
     */
    public function index(Request $request)
    {
//        $response = PayPalController::createOrderRequest();
//
//        info($response['results']->id);
//        $orderID = $response['results']->id;
//
//        \DB::table('payments')->where('id', 1)->update([
//            'paypal_order_id' => $orderID,
//            'request_response_data' => json_encode($response),
//        ]);
//
//        $approveData = collect($response['links'])->where('rel', 'approve')->first();
//
////        dd($approveData->href);
//        return redirect($approveData->href);

        return (new VacationController)->index($request);
    }

    /**
     * Render the application about us page.
     * @return Application|Factory|View
     */
    public function aboutUs()
    {
        return view('pages.about-us');
    }

    /**
     * Render the application contact us page.
     * @return Application|Factory|View
     */
    public function contactUs()
    {
        return view('pages.contact-us');

    }
}
