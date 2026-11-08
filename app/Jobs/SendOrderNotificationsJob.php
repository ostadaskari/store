<?php

namespace App\Jobs;

use App\Mail\OrderPlacedMail;
use App\Services\SmsIrService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrderNotificationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $order;

    /**
     * Create a new job instance.
     */
    public function __construct($order)
    {
        // برای اطمینان از اینکه رابطه user هنگام اجرای صف هم بارگذاری شود
        $this->order = $order->load('user', 'items');
    }

    /**
     * Execute the job.
     */
    public function handle(SmsIrService $smsService): void
    {
        // ۱. ارسال ایمیل به مشتری (از طریق ارتباط با جدول users)
        if ($this->order->user && !empty($this->order->user->email)) {
            Mail::to($this->order->user->email)->send(new OrderPlacedMail($this->order, false));
        }

        // ۲. ارسال ایمیل به ادمین فروشگاهش
        $adminEmail = config('mail.admin_address', 'info@shirazchip.com');
        Mail::to($adminEmail)->send(new OrderPlacedMail($this->order, true));

        // ۳. ارسال پیامک به مشتری
        if ($this->order->user && !empty($this->order->user->mobile)) {
            $smsService->sendOrderNotification(
                $this->order->user->mobile,
                $this->order->order_number);
        }
    }
}
