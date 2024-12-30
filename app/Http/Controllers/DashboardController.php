<?php

namespace App\Http\Controllers;

use App\Models\Ekanban\Ekanban_stock_limit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Show the dashboard
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        $cutOffdate = '2024-05-20';
        $mpname = Carbon::now()->format('m-Y');

        $getdata = Ekanban_stock_limit::select(
            DB::raw('MAX(ekanban_stock_limit.id) as id'),
            DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
            DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
            DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
            DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
            DB::raw('MAX(ekanban_stock_limit.min) as min'),
            DB::raw('MAX(ekanban_stock_limit.max) as max'),
            DB::raw('MAX(ekanban_fg_tbl.balance) as balance'),
            DB::raw('COALESCE(SUM(ekanban_fgin_tbl.qty), 0) as jumlah_qty')
        )
            ->leftJoin('ekanban_fg_tbl', function ($join) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fg_tbl.item_code');
            })
            ->leftJoin('ekanban_fgin_tbl', function ($join) use ($cutOffdate) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fgin_tbl.item_code')
                    ->whereNull('ekanban_fgin_tbl.chutter_address')
                    ->whereNull('ekanban_fgin_tbl.last_updated_by')
                    ->where('ekanban_fgin_tbl.creation_date', '>', $cutOffdate);
            })
            ->where('ekanban_fg_tbl.mpname', '=', $mpname)
            ->where('ekanban_stock_limit.is_active', '1')
            ->orderByDesc('ekanban_stock_limit.action_date')
            ->groupBy('ekanban_stock_limit.itemcode')
            ->get()
            ->toArray();

        // Total number of items
        $totalCount = count($getdata);

        // Filter for KRITIS
        $getDatakritisFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] < $item['min'];
        });

        // Filter for OVER
        $getDataoverFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] > $item['max'];
        });

        // Filter for OK
        $getDataokFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] >= $item['min'] && $item['balance'] <= $item['max'];
        });

        // Count the results
        $countKritis = count($getDatakritisFiltered);
        $countOver = count($getDataoverFiltered);
        $countOk = count($getDataokFiltered);

        // Calculate percentages
        $percentKritis = ($totalCount > 0) ? ($countKritis / $totalCount) * 100 : 0;
        $percentOver = ($totalCount > 0) ? ($countOver / $totalCount) * 100 : 0;
        $percentOk = ($totalCount > 0) ? ($countOk / $totalCount) * 100 : 0;

        // Pass the results to the view
        return view('portal.index', [
            'percentKritis' => round($percentKritis, 2),
            'percentOver' => round($percentOver, 2),
            'percentOk' => round($percentOk, 2),
        ]);


    }
    public function andon_chuter_fg(){
        {
            date_default_timezone_set('Asia/Jakarta');

            $mpname = Carbon::now()->format('m-Y');
            $cutOffdate = '2024-05-20'; // Tanggal cut off yang Anda sebutkan
            // $get_data_out = DB::connection('ekanban')
            // ->table('ekanban_chutter_fgout')
            // ->select('qty')
            // ->get();
            // dd($get_data_out);
            $data = Ekanban_stock_limit::select(
                'ekanban_stock_limit.itemcode',
                DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
                DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
                DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
                DB::raw('MAX(ekanban_stock_limit.part_type) as part_type'),
                DB::raw('MAX(ekanban_stock_limit.min) as min'),
                DB::raw('MAX(ekanban_stock_limit.max) as max'),
                DB::raw('MAX(ekanban_stock_limit.cust_code) as cust_code'),
                DB::raw('MAX(ekanban_fg_tbl.balance) as balance'),
            )
                ->leftJoin('ekanban_fg_tbl', function ($join) {
                    $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fg_tbl.item_code');
                })
                ->where('ekanban_fg_tbl.mpname', '=', $mpname)
                ->where('ekanban_stock_limit.is_active', '1')
                ->groupBy('ekanban_stock_limit.itemcode')
                // ->havingRaw('MAX(ekanban_fg_tbl.balance) < MAX(ekanban_stock_limit.min) OR MAX(ekanban_fg_tbl.balance) > MAX(ekanban_stock_limit.max)')
                ->orderBy('ekanban_stock_limit.chutter_address', 'asc')
                ->get()
                ->toArray();

            // dd($data);
            // Group the data by the first character of chutter_address
            $groupedData = collect($data)->groupBy(function ($item) {
                return substr($item['chutter_address'], 0, 1); // Kelompokkan berdasarkan karakter pertama dari chutter_address
            });
            // for itemcode
            // Inisialisasi variabel
            $carouselDataitemcode = [];
            $currentTables = [];

            // Urutan chutter address yang diinginkan
            $orderedChutterAddresses = ['O', 'M', 'N', 'L', 'K', 'R'];

            // Memproses setiap chutter address sesuai urutan yang ditentukan
            foreach ($orderedChutterAddresses as $chutterAddress) {
                if ($groupedData->has($chutterAddress)) {
                    $items = $groupedData->get($chutterAddress);
                    $chunks = $items->chunk(10); // Memecah item menjadi bagian-bagian dengan maksimal 15 baris per tabel

                    foreach ($chunks as $chunk) {
                        $currentTables[] = [
                            'chutter_address' => $chutterAddress,
                            'items' => $chunk->toArray()
                        ];

                        // Jika sudah ada 3 tabel, tambahkan ke carousel data
                        if (count($currentTables) == 3) {
                            $carouselDataitemcode[] = $currentTables;
                            $currentTables = []; // Reset untuk halaman carousel berikutnya
                        }
                    }
                }
            }

            // Menangani tabel yang tersisa (hanya dari chutter address saat ini)
            if (!empty($currentTables)) {
                // Tambahkan tabel yang tersisa ke carouselDataitemcode
                $carouselDataitemcode[] = $currentTables;
            }

            // fot chuter
            $carouselDatachuter = [];
            $currentTables = [];

            // Urutan chutter address yang diinginkan
            $orderedChutterAddresses = ['O', 'M', 'N', 'L', 'K', 'R'];

            // Memproses setiap chutter address sesuai urutan yang ditentukan
            foreach ($orderedChutterAddresses as $chutterAddress) {
                if ($groupedData->has($chutterAddress)) {
                    $items = $groupedData->get($chutterAddress);
                    $chunks = $items->chunk(25); // Memecah item menjadi bagian-bagian dengan maksimal 15 baris per tabel

                    foreach ($chunks as $chunk) {
                        $currentTables[] = [
                            'chutter_address' => $chutterAddress,
                            'items' => $chunk->toArray()
                        ];

                        // Jika sudah ada 3 tabel, tambahkan ke carousel data
                        if (count($currentTables) == 3) {
                            $carouselDatachuter[] = $currentTables;
                            $currentTables = []; // Reset untuk halaman carousel berikutnya
                        }
                    }
                }
            }

            // Menangani tabel yang tersisa (hanya dari chutter address saat ini)
            if (!empty($currentTables)) {
                // Tambahkan tabel yang tersisa ke carouselDatachuter
                $carouselDatachuter[] = $currentTables;
            }
            // dd($carouselData);

            // Return the view with the prepared carousel data
            return view('dashboard-chuter-fg.index', compact('carouselDataitemcode', 'carouselDatachuter'));
        }
    }

}
