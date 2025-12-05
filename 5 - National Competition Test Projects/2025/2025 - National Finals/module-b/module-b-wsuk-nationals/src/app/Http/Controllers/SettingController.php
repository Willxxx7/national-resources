<?php

namespace App\Http\Controllers;

class SettingController extends Controller
{
    /**
     * Shows settings.
     */
    public function index()
    {
        return view('settings');
    }
}
