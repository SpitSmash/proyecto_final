<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    function store(Request $request)
    {
        if (Auth::user() != null && Auth::user()->hasRole('client')) {
            if ($request->to != null) {
                $today = date('m/d/Y H:i');
                $date1 = Carbon::createFromFormat('m/d/Y H:i', $today);
                $date2 = Carbon::createFromFormat('m/d/Y H:i', $request->to . ' ' . $request->dropoffTime);
                // dd($date1, $date2);
                if ($date1 > $date2) {
                    return redirect(url('/'))->with('error', 'lessdate');
                }
                return redirect(url('/'))->with('success', 'request');
            } else {
                return redirect(url('/'))->with('error', 'datempy');
            }
            // dd($request->to);
        }
        return redirect(url('/'))->with('error', 'difrole');
    }
}
