<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // تنفيذ استعلامات SQL خام
    public function rawQueries()
    {
        $results = DB::select("
            SELECT users.name, orders.total, orders.status
            FROM users
            JOIN orders ON users.id = orders.user_id
        ");

        return view('reports.raw', compact('results'));
    }

    // تنفيذ استعلامات باستخدام Query Builder
    public function builderQueries()
    {
        $results = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('users.name', DB::raw('SUM(orders.total) as total_spent'))
            ->groupBy('users.name')
            ->get();

        return view('reports.builder', compact('results'));
    }
}
