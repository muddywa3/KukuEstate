<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function adminIndex()
    {
        $orders = Order::latest()->get();
        return view('admin.orders', compact('orders'));
    }
public function store(Request $request)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'phone_number'  => 'required|string|max:20',
        'product_name'  => 'required|string', // Hapa inatumika kama sehemu ya ujumbe/maoni
        'location'      => 'nullable|string|max:255',
    ]);

    Order::create([
        'customer_name' => $request->customer_name,
        'phone_number'  => $request->phone_number,
        'product_name'  => $request->product_name,
        'quantity'      => $request->quantity ?? 1,
        'location'      => $request->location,
        'status'        => 'Pending',
    ]);

    return redirect()->back()->with('success', 'Asante kwa mawasiliano/maoni yako! Tutawasiliana nawe hivi punde.');
}
}
