<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function download($orderId)
    {
        $order = Order::with(['user', 'orderItems.product', 'orderItems.vendor'])->findOrFail($orderId);

        $data = [
            'order' => $order,
            'date' => date('d/m/Y'),
        ];

        $pdf = Pdf::loadView('customer.invoice', $data);

        return $pdf->download("invoice-{$order->order_number}.pdf");
    }
}
