<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Tahoma, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; direction: rtl; text-align: right; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header { background: #107c41; color: #ffffff; padding: 20px; text-align: center; }
        .content { padding: 20px; color: #333333; line-height: 1.6; }
        .box { background: #f9f9f9; border: 1px solid #ddd; padding: 15px; border-radius: 5px; margin: 15px 0; }
        .footer { background: #333333; color: #ffffff; padding: 15px; text-align: center; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; font-size: 13px; }
        th { background: #eee; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>فروشگاه قطعات الکترونیک شیرازچیپ</h2>
    </div>
    <div class="content">
        <p>{{ $isAdmin ? 'مدیر گرامی، یک سفارش جدید ثبت شد:' : 'کاربر گرامی، سفارش شما با موفقیت ثبت و پرداخت گردید.' }}</p>

        <div class="box">
            <p><strong>کد پیگیری سفارش:</strong> <span style="color: #d33; font-size: 16px;">{{ $order->ordre_number }}</span></p>
            <p><strong>مبلغ کل:</strong> {{ number_format($order->total_amount) }} تومان</p>
        </div>

        <h4>جزئیات سفارش:</h4>
        <table>
            <thead>
            <tr>
                <th>نام محصول</th>
                <th>تعداد</th>
                <th>قیمت (تومان)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p>تلفن پشتیبانی فروشگاه: 07130000000 | وب‌سایت: shirazchip.com</p>
        <p>تمامی حقوق محفوظ است © 2026</p>
    </div>
</div>
</body>
</html>
