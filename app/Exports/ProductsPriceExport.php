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

    public function __construct($cnyUsdRate)
    {
        $cnyUsdRate = is_numeric($cnyUsdRate) && $cnyUsdRate > 0 ? $cnyUsdRate : 6.7;
        $this->cnyUsdRate = str_replace(',', '.', $cnyUsdRate);
    }

    public function collection(): Collection
    {
        return Product::with('price')->orderByDesc('id')->get();
    }

    public function headings(): array
    {
        return [
            'Part Number',          // A
            'Available QTY Mega',        // B
            'MFG',                  // C
            'Mouser Price',         // D
            'China Price (CNY)',    // E
            'China Price (USD)',    // F
            'USD Price ($)',        // G
            'Discount %',           // H
            'Special Profit %',     // I
        ];
    }

    public function map($product): array
    {
        static $rowNumber = 2;
        $currentExcelRow = $rowNumber++;

        $cnyPrice = $product->price->cny_price ?? '';
        $usdPrice = $product->price->usd_price ?? '';
        $rate = $this->cnyUsdRate;

        return [
            $product->part_number,                                      // A
            $product->available_qty_mega ?? 0,                          // B
            $product->mfg ?? '',                                        // C
            $usdPrice,                                                  // D
            $cnyPrice,                                                  // E
            '=IF(E' . $currentExcelRow . '="", "", E' . $currentExcelRow . ' / ' . $rate . ')', // F
            $usdPrice,                                                  // G
            $product->price->discount_percent ?? 0,                     // H
            $product->price->special_profit_percent ?? 0,               // I
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 16,
            'C' => 20,
            'D' => 18,
            'E' => 18,
            'F' => 18,
            'G' => 16,
            'H' => 14,
            'I' => 16,
        ];
    }

    public function styles(Worksheet $sheet): array|null
    {
        // وسط‌چین کردن تمام ستون‌ها
        $sheet->getStyle('A:I')->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
        );

        $sheet->getStyle('A:I')->getAlignment()->setVertical(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        );

        // استایل هدر
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2C3E50'],
            ],
        ]);

        $highestRow = $sheet->getHighestRow();

        // رنگ ستون Mouser Price (D)
        $sheet->getStyle('D2:D' . $highestRow)->getFill()->setFillType(
            \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID
        );
        $sheet->getStyle('D2:D' . $highestRow)->getFill()->getStartColor()->setARGB('FFD0E1FD');

        // رنگ ستون China Price USD (F)
        $sheet->getStyle('F2:F' . $highestRow)->getFill()->setFillType(
            \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID
        );
        $sheet->getStyle('F2:F' . $highestRow)->getFill()->getStartColor()->setARGB('FFF4CCCC');

        // رنگ ستون USD Price (G)
        $sheet->getStyle('G2:G' . $highestRow)->getFill()->setFillType(
            \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID
        );
        $sheet->getStyle('G2:G' . $highestRow)->getFill()->getStartColor()->setARGB('FFD9EAD3');

        return [];
    }
}
