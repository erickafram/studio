<?php

namespace App\Http\Controllers;

use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('name')->get();
        return view('home', compact('services'));
    }
}


