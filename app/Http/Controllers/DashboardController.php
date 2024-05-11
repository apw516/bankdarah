<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function Index()
    {
        $menu = 'dashboard';
        $stok = DB::select('SELECT (SELECT COUNT(id) AS jumlah FROM tb_kartu_stok WHERE gol_dar = ? AND STATUS = 1) AS goldar_A
        ,(SELECT COUNT(id) AS jumlah FROM tb_kartu_stok WHERE gol_dar = ? AND STATUS = 1) AS goldar_B
        ,(SELECT COUNT(id) AS jumlah FROM tb_kartu_stok WHERE gol_dar = ? AND STATUS = 1) AS goldar_AB
        ,(SELECT COUNT(id) AS jumlah FROM tb_kartu_stok WHERE gol_dar = ? AND STATUS = 1) AS goldar_O
         FROM tb_kartu_stok LIMIT 1', ['A', 'B', 'AB', 'O']);
        $bulan = db::select('select * from mt_bulan');
        $now = DATE('m');
        return view('Dashboard.index', compact([
            'menu', 'stok', 'bulan', 'now'
        ]));
    }
    public function ambilProgresPemakaianDarah(Request $request)
    {
        $bulan = $request->bulan;
        $year = date('Y');
        $progres = db::select("SELECT
        (SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE jenis_goldar = ? AND MONTH(tgl_entry) = '$bulan' AND YEAR(tgl_entry) = '$year' AND STATUS = 1) AS goldar_A
        ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE jenis_goldar = ? AND MONTH(tgl_entry) = '$bulan' AND YEAR(tgl_entry) = '$year' AND STATUS = 1) AS goldar_B
        ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE jenis_goldar = ? AND MONTH(tgl_entry) = '$bulan' AND YEAR(tgl_entry) = '$year' AND STATUS = 1) AS goldar_AB
        ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE jenis_goldar = ? AND MONTH(tgl_entry) = '$bulan' AND YEAR(tgl_entry) = '$year' AND STATUS = 1) AS goldar_O
        ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE  STATUS = 1) AS ALL_STOK
         FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = ? AND YEAR(tgl_entry) = ? LIMIT 1", ['A', 'B', 'AB', 'O', $bulan, $year]);
        if (count($progres) > 0) {
            return view('Dashboard.progres_pemakaian_darah', compact([
                'bulan', 'progres'
            ]));
        } else {
            return "<h4 class='text-danger'>Data tidak ditemukan !</h4>";
        }
    }
    public function ambilGraffikPemakaian(Request $request)
    {
        $goldargrafik = $request->goldargrafik;
        $year = date('Y');
        if ($goldargrafik == 'ALL') {
            $DATA = DB::select("SELECT
            (SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '01' AND YEAR(tgl_entry) = $year AND STATUS = 1) AS Januari
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '02'  AND YEAR(tgl_entry) = $year  AND STATUS = 1) AS Februari
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '03'  AND YEAR(tgl_entry) = $year  AND STATUS = 1) AS Maret
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '04'  AND YEAR(tgl_entry) = $year  AND STATUS = 1) AS April
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '05'  AND YEAR(tgl_entry) = $year  AND STATUS = 1) AS Mei
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '06'  AND YEAR(tgl_entry) = $year  AND STATUS = 1) AS Juni
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '07'  AND YEAR(tgl_entry) = $year  AND STATUS = 1) AS Juli
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '08'  AND YEAR(tgl_entry) = $year  AND STATUS = 1) AS Agustus
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '09'  AND YEAR(tgl_entry) = $year  AND STATUS = 1) AS September
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '10'  AND YEAR(tgl_entry) = $year  AND STATUS = 1) AS Oktober
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '11'  AND YEAR(tgl_entry) = $year  AND STATUS = 1) AS November
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '12'  AND YEAR(tgl_entry) = $year  AND STATUS = 1) AS Desember
            FROM tb_pemakaian_detail WHERE YEAR(tgl_entry) = $year LIMIT 1");
        }else{
            $DATA = DB::select("SELECT
            (SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '01' AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik' AND STATUS = 1) AS Januari
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '02'  AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik'  AND STATUS = 1) AS Februari
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '03'  AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik'  AND STATUS = 1) AS Maret
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '04'  AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik'  AND STATUS = 1) AS April
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '05'  AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik'  AND STATUS = 1) AS Mei
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '06'  AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik'  AND STATUS = 1) AS Juni
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '07'  AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik'  AND STATUS = 1) AS Juli
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '08'  AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik'  AND STATUS = 1) AS Agustus
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '09'  AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik'  AND STATUS = 1) AS September
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '10'  AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik'  AND STATUS = 1) AS Oktober
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '11'  AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik'  AND STATUS = 1) AS November
            ,(SELECT COUNT(id) AS jumlah FROM tb_pemakaian_detail WHERE MONTH(tgl_entry) = '12'  AND YEAR(tgl_entry) = $year AND jenis_goldar = '$goldargrafik'  AND STATUS = 1) AS Desember
            FROM tb_pemakaian_detail WHERE YEAR(tgl_entry) = $year LIMIT 1");
        }
        if(count($DATA) > 0){

            return view('Dashboard.grafikpemakaian', compact([
                'DATA'
            ]));
        }else{
            return "<h4 class='text-danger'>Data tidak ditemukan !</h4>";
        }
    }
}
