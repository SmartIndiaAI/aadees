<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Stats for the user
        $stats = [
            'total_orders' => Order::where('user_id', $user->id)->count(),
            'pending_orders' => Order::where('user_id', $user->id)->where('status', 'pending')->count(),
            'confirmed_orders' => Order::where('user_id', $user->id)->where('status', 'confirmed')->count(),
            'total_spent' => Order::where('user_id', $user->id)->where('payment_status', 'paid')->sum('total_amount'),
        ];

        // Isolated orders for this user
        $recentOrders = Order::where('user_id', $user->id)
            ->with('orderItems.product')
            ->latest()
            ->take(10)
            ->get();

        return view('customer.dashboard', compact('user', 'stats', 'recentOrders'));
    }
}
