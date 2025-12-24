<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Ipe\Sdk\Facades\SmsIr;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = "داشبورد ادمین";

        /** ---- SMS Credit ---- **/
        $response = SmsIr::getCredit();
        $credit = $response->status ? (int) $response->data : 0;

        $data['sms_credit'] = $credit;
        $data['low_credit'] = $credit < 100;

        /** ---- Basic Stats ---- **/
        $data['orders_count'] = Order::count();
        $data['sales_total'] = Order::where('status','!=','canceled')->sum('total_amount');
        $data['clients_count'] = User::where('is_admin', '0')->where('is_delete', '0')->count();

        $data['orders_taday'] = Order::where('status','!=','canceled')
            ->where('is_payment',1)
            ->whereDate('created_at', date('Y-m-d'))
            ->count();

        $data['orders_taday_amount'] = Order::where('status','!=','canceled')
            ->where('is_payment',1)
            ->whereDate('created_at', date('Y-m-d'))
            ->sum('total_amount');

        $data['clients_today'] = User::where('is_admin', '0')
            ->where('is_delete', '0')
            ->whereDate('created_at', date('Y-m-d'))
            ->count();

        $data['latest_orders'] = Order::latest()->limit(10)->get();


        /** ---- CHART DATA ---- **/

// Current Jalali year
        $jalaliYear = Jalalian::now()->getYear();

// Generate Persian month names safely
        $jalaliMonths = collect(range(1, 12))->map(function ($m) use ($jalaliYear) {
            $date = \Carbon\Carbon::create(now()->year, $m, 1, 0, 0, 0);
            return Jalalian::fromDateTime($date)->format('%B');
        });


        // 2) Fetch Gregorian-year stats from DB
        $year = now()->year;

        $orders = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total_orders'),
            DB::raw('SUM(total_amount) as total_sales')
        )
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $customers = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total_customers')
        )
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $data['chart_months'] = $jalaliMonths;

        // Chart A — Counts
        $data['chart_orders'] = collect(range(1,12))->map(fn($m) =>
            optional($orders->firstWhere('month',$m))->total_orders ?? 0
        );

        $data['chart_customers'] = collect(range(1,12))->map(fn($m) =>
            optional($customers->firstWhere('month',$m))->total_customers ?? 0
        );

        // Chart B — Sales
        $data['chart_sales'] = collect(range(1,12))->map(fn($m) =>
            optional($orders->firstWhere('month',$m))->total_sales ?? 0
        );

        return view('admin.dashboard', $data);
    }
}
