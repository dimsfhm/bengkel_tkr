<?php

namespace App\Http\Controllers;

use App\Models\log_aktivitas;

class LogController extends Controller
{
    public function index()
    {
        $logs = log_aktivitas::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.log_aktivitas', compact('logs'));
    }
}