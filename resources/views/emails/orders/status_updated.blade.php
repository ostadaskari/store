<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>به‌روزرسانی وضعیت سفارش</title>
    <!-- استایل‌های اصلی برای کلاینت‌های وب و موبایل -->
    <style>
        body { margin: 0; padding: 0; background-color: #f4f4f4; font-family: Tahoma, 'Droid Arabic Kufi', sans-serif; }
        table { border-collapse: collapse; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); }
        .header { background-color: #4CAF50; color: #ffffff; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; line-height: 1.8; color: #333333; }
        .panel { background-color: #f9f9f9; border-left: 5px solid #4CAF50; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .table-data th, .table-data td { padding: 10px; border: 1px solid #dddddd; text-align: right; }
        .table-data th { background-color: #eeeeee; font-weight: bold; }
        .btn-primary { display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #4CAF50; color: #ffffff !important; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #999999; }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Tahoma, 'Droid Arabic Kufi', sans-serif;">
<!-- جدول اصلی (برای سازگاری با کلاینت‌ها) -->
<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #f4f4f4;">
    <tr>
        <td align="center" style="padding: 20px;">
            <table class="container" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; max-width: 600px; margin: 0 auto; padding: 0; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); text-align: right;">

                <!-- لوگو/عنوان شرکت -->
                <tr>
                    <td class="header" style="background-color: #4CAF50; color: #ffffff; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
                        <h1 style="margin: 0; font-size: 24px;">{{ config('app.name') }}</h1>
                    </td>
                </tr>

                <!-- متن اصلی -->
                <tr>
                    <td class="content" style="padding: 20px; line-height: 1.8; color: #333333;">
                        <h2 style="font-size: 18px; color: #4CAF50; margin-top: 0;">به‌روزرسانی وضعیت سفارش شما</h2>

                        <p>مشتری گرامی، **{{ $order->user->name . ' ' . $order->user->family }}**،</p>

                        <p>وضعیت سفارش شما با شماره **#{{ $order->order_number }}** به‌روزرسانی شد.</p>
                        <p style="font-size: 16px; font-weight: bold; color: #222;">وضعیت جدید سفارش: <span style="color: #FF9800;">{{ $order->status_text }}</span></p>

                        <!-- پنل جزئیات کلی -->
                        <div class="panel" style="background-color: #f9f9f9; border-right: 5px solid #4CAF50; padding: 15px; margin: 20px 0; border-radius: 4px; border-left: none;">
                            <h3 style="margin-top: 0; font-size: 16px;">جزئیات کلی سفارش:</h3>
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; text-align: right;">
                                <tr>
                                    <td style="padding: 5px 0;"><strong>کد سفارش:</strong></td>
                                    <td style="padding: 5px 0;">#{{ $order->order_number }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0;"><strong>وضعیت:</strong></td>
                                    <td style="padding: 5px 0;">{{ $order->status_text }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0;"><strong>تاریخ ثبت:</strong></td>
                                    <td style="padding: 5px 0;">{{ jdate($order->created_at)->format('Y/m/d H:i') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0;"><strong>مبلغ نهایی:</strong></td>
                                    <td style="padding: 5px 0;">{{ number_format($order->total_amount) }} تومان</td>
                                </tr>
                            </table>
                        </div>

                        <!-- جدول اقلام سفارش -->
                        <h3 style="margin-top: 30px; font-size: 16px;">اقلام سفارش داده شده:</h3>
                        <table class="table-data" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <thead>
                            <tr>
                                <th style="padding: 10px; border: 1px solid #dddddd; text-align: right; background-color: #eeeeee; font-weight: bold;">نام محصول</th>
                                <th style="padding: 10px; border: 1px solid #dddddd; text-align: center; background-color: #eeeeee; font-weight: bold;">تعداد</th>
                                <th style="padding: 10px; border: 1px solid #dddddd; text-align: left; background-color: #eeeeee; font-weight: bold;">قیمت واحد</th>
                                <th style="padding: 10px; border: 1px solid #dddddd; text-align: left; background-color: #eeeeee; font-weight: bold;">مجموع</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #dddddd; text-align: right;">{{ $item->product->part_number ?? $item->name }}</td>
                                    <td style="padding: 10px; border: 1px solid #dddddd; text-align: center;">{{ $item->quantity }}</td>
                                    <td style="padding: 10px; border: 1px solid #dddddd; text-align: left;">{{ number_format($item->price) }} تومان</td>
                                    <td style="padding: 10px; border: 1px solid #dddddd; text-align: left;">{{ number_format($item->price * $item->quantity) }} تومان</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- دکمه مشاهده سفارش -->
                        <div style="text-align: center;">
                            <a href="{{ route('home') }}" class="btn-primary" style="display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #4CAF50; color: #ffffff !important; text-decoration: none; border-radius: 4px; font-weight: bold;">
                                مشاهده کامل سفارش
                            </a>
                        </div>

                        <p style="margin-top: 30px;">با احترام،<br>تیم {{ config('app.name') }}</p>

                    </td>
                </tr>

                <!-- فوتر -->
                <tr>
                    <td class="footer" style="text-align: center; padding: 20px; font-size: 12px; color: #999999;">
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. کلیه حقوق محفوظ است.</p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
