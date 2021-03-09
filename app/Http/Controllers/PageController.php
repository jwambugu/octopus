<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    /**
     * Render the application index page.
     * @return Application|Factory|View
     */
    public function index()
    {
//        \Mail::to('jay@test.com')->send(new PropertyBooked());
//        return new PropertyBooked();
        return view('welcome');
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
