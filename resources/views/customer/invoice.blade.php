<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; margin: 0; padding: 0; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; font-size: 16px; line-height: 24px; }
        .invoice-box table { width: 100%; line-height: inherit; text-align: left; border-collapse: collapse; }
        .invoice-box table td { padding: 5px; vertical-align: top; }
        .invoice-box table tr td:nth-child(2) { text-align: right; }
        .invoice-box table tr.top table td { padding-bottom: 20px; }
        .invoice-box table tr.top table td.title { font-size: 45px; line-height: 45px; color: #333; }
        .invoice-box table tr.information table td { padding-bottom: 40px; }
        .invoice-box table tr.heading td { background: #f9fafb; border-bottom: 1px solid #ddd; font-weight: bold; padding: 10px; font-size: 12px; text-transform: uppercase; }
        .invoice-box table tr.details td { padding-bottom: 20px; }
        .invoice-box table tr.item td { border-bottom: 1px solid #eee; padding: 15px 10px; font-size: 14px; }
        .invoice-box table tr.item.last td { border-bottom: none; }
        .invoice-box table tr.total td:nth-child(2) { border-top: 2px solid #eee; font-weight: bold; font-size: 20px; }
        .vendor-section { margin-top: 20px; font-size: 10px; color: #777; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title" style="font-weight: 900; color: #291030;">Aadees</td>
                            <td>
                                Invoice #: {{ $order->order_number }}<br>
                                Created: {{ $date }}<br>
                                Payment: {{ strtoupper($order->payment_status) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <strong>Billed To:</strong><br>
                                {{ $order->user->name ?? 'Guest User' }}<br>
                                {{ $order->user->email ?? '' }}<br>
                                {{ $order->shipping_address ?? 'Global Shipping' }}
                            </td>
                            <td>
                                <strong>Marketplace:</strong><br>
                                Aadees Multi-Vendor<br>
                                admin@Aadees.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Item Detail</td>
                <td>Vendor</td>
                <td style="text-align: center;">Qty</td>
                <td style="text-align: right;">Price</td>
            </tr>
            @foreach($order->order_items as $item)
                <tr class="item">
                    <td>
                        <strong>{{ $item->product->name }}</strong><br>
                        <small style="color: #999;">SKU: {{ $item->product->sku }}</small>
                    </td>
                    <td>{{ $item->vendor->business_name ?? $item->vendor->name }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
            <tr class="total">
                <td colspan="2"></td>
                <td style="text-align: right; padding-top: 20px;">Shipping:</td>
                <td style="text-align: right; padding-top: 20px;">₹{{ number_format($order->shipping_amount, 2) }}</td>
            </tr>
            <tr class="total">
                <td colspan="2"></td>
                <td style="text-align: right;">Grand Total:</td>
                <td style="text-align: right;">₹{{ number_format($order->total_amount, 2) }}</td>
            </tr>
        </table>

        <div class="vendor-section">
            <p>* This invoice contains items from multiple independent vendors. Shipping charges are calculated per shipment.</p>
        </div>

        <div class="footer">
            Thank you for shopping with Aadees Marketplace. Powered by Razorpay Route.
        </div>
    </div>
</body>
</html>
