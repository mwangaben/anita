<?php

namespace App\Http\Controllers;

class MocksController extends Controller
{
    public function index()
    {
        $names = ['Benedict', 'Mwanga', 'Neema'];
        return $names;
    }
}
