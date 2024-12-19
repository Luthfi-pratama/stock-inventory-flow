<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\StockItem;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ManagerController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $range = $request->input('range', 'custom'); // Default ke 'custom'

        if ($startDate && $endDate) {
            // Filter berdasarkan rentang tanggal
            $data = StockItem::whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay(),
            ])->get();
            $title = "Rekap Dari $startDate Sampai $endDate";
        } else {
            // Jika tidak ada input tanggal, gunakan logika default
            switch ($range) {
                case 'today':
                    $data = StockItem::whereDate('created_at', Carbon::today())->get();
                    $title = 'Rekap Hari Ini';
                    break;

                case 'thisWeek':
                    $data = StockItem::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
                    $title = 'Rekap Minggu Ini';
                    break;

                case 'thisMonth':
                    $data = StockItem::whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->get();
                    $title = 'Rekap Bulan Ini';
                    break;

                default:
                    $data = StockItem::all(); // Semua data
                    $title = 'Semua Data';
            }
        }



        return view('manager.dashboard-mngr', compact('data', 'title', 'range', 'startDate', 'endDate'));
    }


    public function cetakData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $data = StockItem::whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay(),
            ])->get();
            $title = "Tanggal $startDate Sampai $endDate";
        } else {
            $data = StockItem::all();
            $title = 'Semua Data';
        }

        // Menggunakan dompdf untuk menghasilkan PDF
        $pdf = PDF::loadView('manager.cetak-data', compact('data', 'title', 'startDate', 'endDate'));
        return $pdf->download('cetak-data.pdf');
    }

    public function previewData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $data = StockItem::whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay(),
            ])->get();
            $title = "Rekap Dari $startDate Sampai $endDate";
        } else {
            $data = StockItem::all();
            $title = 'Semua Data';
        }

        return view('manager.preview-pdf', compact('data', 'title', 'startDate', 'endDate'));
    }

    public function pengguna()
    {
        return view('manager.pengguna');
    }

    public function laporan()
    {
        $total = StockItem::count();
        $totalUser = User::count();
        $stockData = Category::select('name')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('name')
            ->get();

        $categories = $stockData->pluck('name');
        $totals = $stockData->pluck('total');

        return view('manager.laporan', compact('total', 'totalUser', 'categories', 'totals'));
    }
}
