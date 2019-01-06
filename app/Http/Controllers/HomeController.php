<?php

namespace App\Http\Controllers;

use App\Cars;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cars = Cars::join('car_biddings', 'car_biddings.car_id', 'cars.id')
            ->join('car_images', 'cars.id', 'car_images.car_id')
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->paginate(50);

        return view('home')->with('cars', $cars);
    }
}
