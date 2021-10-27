<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class AdminController extends Controller
{
    public function index(Request $request) {
        return view("admin.index");
    }
}
