<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function create()
    {
        return Inertia::render('Cart');
    }

    public function store(Request $request)
    {
        
    }

    public function fetch(Request $request){

    }

    public function update(Request $request){

    }

    public function delete(Request $request){

    }


}
