<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class index extends Controller
{
    //

    public function home() {
        $order = DB::table('orders')->whereMonth('added_datetime', Carbon::now()->month)
        ->get()->count();
        $sale = DB::table('orders')->select(DB::raw('sum(total_amount) as total'))
        ->first();
        $readyshipped = DB::table('orders')->where([["status",'=',2]])->get()->count();
        $pending = DB::table('orders')->where([["status",'=',1]])->get()->count();
        $deliverd = DB::table('orders')->where([["status",'=',3]])->get()->count();
        // dd($order1);
        return view('backend.index')
            ->with('order',$order)
            ->with('sale',$sale)
            ->with('shipped',$readyshipped)
            ->with('pending',$pending)
            ->with('deliverd',$deliverd);
    }
}
