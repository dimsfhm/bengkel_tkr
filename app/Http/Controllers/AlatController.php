<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        return view('admin.alat-tersedia');
    }

    public function store(Request $request)
    {
        // sementara hanya dump
        dd($request->all());
    }
}