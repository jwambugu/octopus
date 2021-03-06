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
     * @return Application|Factory|View
     */
    public function index(Request $request): Factory|View|Application
    {
        return (new VacationController)->index($request);
    }

    /**
     * Render the application about us page.
     * @return Application|Factory|View
     */
    public function aboutUs(): View|Factory|Application
    {
        return view('pages.about-us');
    }

    /**
     * Render the application contact us page.
     * @return Application|Factory|View
     */
    public function contactUs(): View|Factory|Application
    {
        return view('pages.contact-us');

    }
}
