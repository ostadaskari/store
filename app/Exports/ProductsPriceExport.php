<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use App\Models\Warehouse\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsPriceExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $cnyUsdRate;
    // دریافت نرخ تبدیل از طریق Constructor
    public function __construct($cnyUsdRate)
    {
        $cnyUsdRate = is_numeric($cnyUsdRate) && $cnyUsdRate > 0 ? $cnyUsdRate : 7.2;
        // تبدیل نقطه اعشار به استاندارد فرمول‌های اکسل (برای جلوگیری از تداخل با تنظیمات لوکال)
        $this->cnyUsdRate = str_replace(',', '.', $cnyUsdRate);
    }
    public function collection(): Collection
    {
        // تمام محصولات همراه با قیمت‌ها را دریافت می‌کنیم
        return Product::with('price')->orderByDesc('id')->get();
    }
    public function headings(): array
    {
        return [
            'Part Number',          // A
            'Mouser Price',         // B (آبی کم‌رنگ)
            'China Price (CNY)',    // C
            'China Price (USD)',    // D (قرمز کم‌رنگ - شامل فرمول)
            'USD Price ($)',        // E (سبز شفاف)
            'Discount %',           // F
            'Special Profit %',     // G
            'Sell Price (Toman)'    // H
        ];
    }

    public function map($product): array
    {
        static $rowNumber = 2; // شروع از ردیف 2 (ردیف 1 هدر است)
        $currentExcelRow = $rowNumber++;

        $usdPrice = $product->price->usd_price ?? '';
        $rate = $this->cnyUsdRate;

        return [
            $product->part_number,                                     // ستون A
            $usdPrice,                                                 // ستون B: Mouser Price (کپی پیش‌فرض قیمت دلار)
            '',                                                        // ستون C: China Price (CNY) - ورود دستی کاربر
           // // استفاده از نرخ وارد شده توسط اپراتور در فرمول اکسل
            '=IF(C' . $currentExcelRow . '="", "", C' . $currentExcelRow . ' / ' . $rate . ')', // ستون D: فرمول تبدیل یوان به دلار (فرض نرخ تبدیل 6.66)
            $usdPrice,                                                 // ستون E: USD Price ($)
            $product->price->discount_percent ?? 0,                    // ستون F
            $product->price->special_profit_percent ?? 0,              // ستون G
            $product->price->sell_price_toman ?? 0,                    // ستون H
        ];
    }

    // تنظیم عرض ستون‌ها متناسب با تیترها
    public function columnWidths(): array
    {
        return [
            'A' => 20, // Part Number
            'B' => 18, // Mouser Price
            'C' => 18, // China Price (CNY)
            'D' => 18, // China Price (USD)
            'E' => 16, // USD Price ($)
            'F' => 14, // Discount %
            'G' => 16, // Special Profit %
            'H' => 20, // Sell Price (Toman)
        ];
    }

    // اعمال استایل‌ها، رنگ‌بندی و وسط‌چین کردن
    public function styles(Worksheet $sheet): array|null
    {
        // راست‌به‌چپ کردن صفحه اکسل
        $sheet->getStyle('A:H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A:H')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // استایل هدر (سطر اول)
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2C3E50'], // رنگ تیره برای هدر
            ],
        ]);

        $highestRow = $sheet->getHighestRow();

        // رنگ ستون Mouser Price (ستون B) -> آبی کم‌رنگ (#D9EAD3 یا آبی روشن‌تر مثل #D0E1FD)
        $sheet->getStyle('B2:B' . $highestRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('B2:B' . $highestRow)->getFill()->getStartColor()->setARGB('FFD0E1FD');

        // رنگ ستون China Price USD (ستون D) -> قرمز کم‌رنگ (#F4CCCC)
        $sheet->getStyle('D2:D' . $highestRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('D2:D' . $highestRow)->getFill()->getStartColor()->setARGB('FFF4CCCC');

        // رنگ ستون USD Price $ (ستون E) -> سبز شفاف/کم‌رنگ (#D9EAD3)
        $sheet->getStyle('E2:E' . $highestRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('E2:E' . $highestRow)->getFill()->getStartColor()->setARGB('FFD9EAD3');

        return [];
    }
}
