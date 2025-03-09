<?php

namespace App\Http\Controllers;

use App\Models\ship;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function index() {
        $ship = ship::all();
        return response()->json($ship);
    }
}
