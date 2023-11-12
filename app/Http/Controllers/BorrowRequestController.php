<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\BorrowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowRequestController extends Controller
{
    public function index(){
        return view('userrq.create_request');
    }

    public function create()
{
    $assets = Asset::all(); // เรียกดึงข้อมูลทรัพย์สิน
    return view('userrq.create_request', compact('assets'));
}

        public function store(Request $request)
    {
        $createrq = new BorrowRequest;
        $createrq->create_by = Auth::user()->id;
        $createrq->borrow_date = $request->borrow_date;
        $createrq->return_date = $request->return_date;
        $createrq->asset = $request->asset;
        $createrq->quantity = $request->quantity;
        $createrq->description = $request->description;

        $createrq->save();

    }

}
