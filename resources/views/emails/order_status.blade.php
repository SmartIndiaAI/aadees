<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f9fafb; padding: 40px; color: #111827; }
        .container { max-width: 600px; margin: auto; background: #ffffff; padding: 40px; border-radius: 20px; border: 1px solid #f3f4f6; }
        .logo { height: 40px; margin-bottom: 40px; }
        h1 { font-size: 24px; font-weight: 900; letter-spacing: -0.05em; text-transform: uppercase; margin-bottom: 20px; color: #291030; }
        p { font-size: 14px; line-height: 1.6; color: #4b5563; }
        .accent { font-weight: 800; color: #291030; text-transform: uppercase; letter-spacing: 0.1em; font-size: 10px; }
        .order-number { font-size: 18px; font-weight: 900; color: #111827; margin: 20px 0; }
        .footer { margin-top: 40px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3em; color: #9ca3af; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <span class="accent">Order Update</span>
        <h1>Status <span style="color: #8e46a5; font-style: italic;">Refined.</span></h1>
        
        <p>{{ $statusMessage }}</p>

        <div class="order-number">#{{ $order->order_number }}</div>

        <p>You can track the progress of your order in your personal digital dashboard area.</p>

        <div class="footer">
            Aadees Marketplace Premium Experience
        </div>
    </div>
</body>
</html>
