<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view("dashboard.calendarioCitas");
    }

    public function home(){
        return view("dashboard.calendarioCitas");
    }

    public function gestion(){
        return view("dashboard.gestionCitas");
    }

    public function calendario(){
        return view("dashboard.calendarioCitas");
    }
}
