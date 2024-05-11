<?php

namespace App\Http\Controllers;

use App\Models\Pemakaiandetail;
use App\Models\Pemakaianheader;
use App\Models\Stokdarah;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BankDarahController extends Controller
{
    public function indexDataPemakaian()
    {
        $menu = 'datapemakaian';
        $awal = date('Y-01-m');
        $akhir  = $this->get_date();
        return view('Bankdarah.indexdatapemakaian', compact([
            'menu', 'awal', 'akhir'
        ]));
    }
    public function indexDataStokDarah()
    {
        $menu = 'datastokdarah';
        $awal = date('Y-01-m');
        $akhir  = $this->get_date();
        return view('Bankdarah.indexdatastokdarah', compact([
            'menu', 'awal', 'akhir'
        ]));
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
    public function simpanStokDarah(Request $request)
    {
        $data1 = json_decode($_POST['data1'], true);
        foreach ($data1 as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'tglterima') {
                $arraydarah[] = $dataSet;
            }
        }

        foreach ($arraydarah as $d) {
            $data_darah = [
                'nomor_kantong' => $d['nomorkantong'],
                'gol_dar' => $d['goldar'],
                'tgl_expired' => $d['tglexp'],
                'tgl_entry' => $this->get_now(),
                'pic' => auth()->user()->id,
                'tgl_terima' => $d['tglterima'],
            ];
            Stokdarah::create($data_darah);
        }
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanPemakaianDarah(Request $request)
    {
        $data1 = json_decode($_POST['data1'], true);
        foreach ($data1 as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'tglexp') {
                $arraydarah[] = $dataSet;
            }
        }
        $data_header = [
            'kode_pemakaian_header' => $this->get_kode_pemakaian_header(),
            'pic' => auth()->user()->id,
            'tgl_entry' => $this->get_now()
        ];
        $tb_pemakaian_header = Pemakaianheader::create($data_header);
        $jumlah_labu = 0;
        foreach ($arraydarah as $d) {
            $jumlah_labu = $jumlah_labu + 1;
            $data_detail = [
                'id_header' => $tb_pemakaian_header->id,
                'nomor_kantong' => $d['nomorkantong'],
                'jenis_goldar' => $d['goldar'],
                'tgl_expired' => $d['tglexp'],
                'tgl_entry' => $d['tglpakai'],
                'pic' => auth()->user()->id,
            ];
            Pemakaiandetail::create($data_detail);
            $datastok = [
                'status' => 2,
                'tgl_keluar' => $this->get_now()
            ];
            Stokdarah::whereRaw('id = ?', array($d['idkantong']))->update($datastok);
        }
        $data_h = [
            'jumlah_labu' => $jumlah_labu
        ];
        Pemakaianheader::whereRaw('id = ?', array($tb_pemakaian_header->id))->update($data_h);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function ambilStokDarah(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $stok = DB::select('select * from tb_kartu_stok where tgl_terima between ? and ? order by id desc', [$awal, $akhir]);
        return view('Bankdarah.tabel_Stok_darah_all', compact([
            'stok', 'awal', 'akhir'
        ]));
    }
    public function ambilStokDarahPemakaian()
    {
        $stok = DB::select('select * from tb_kartu_stok where status =?', [1]);
        return view('Bankdarah.tabel_Stok_darah_tersedia', compact([
            'stok'
        ]));
    }
    public function ambilDataPemakaian(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $list = DB::select('select * from tb_pemakaian_header where date(tgl_entry) between ? and ? and status = ? ORDER BY id desc', [$awal, $akhir, 1]);
        return view('Bankdarah.tabel_data_pemakaian', compact([
            'list'
        ]));
    }
    public function detailStok(Request $request)
    {
        $id = $request->id;
        $detail = db::select('select * from tb_kartu_stok where id= ?', [$id]);
        return view('Bankdarah.formeditstok', compact([
            'detail'
        ]));
    }
    public function simpanEditStok(Request $request)
    {
        $data1 = json_decode($_POST['data1'], true);
        foreach ($data1 as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $data_detail = [
            'nomor_kantong' => $dataSet['nomorkantong_d'],
            'gol_dar' => $dataSet['jenisgoldar_d'],
            'tgl_expired' => $dataSet['tglexp_d'],
            'tgl_terima' => $dataSet['tglterima_d'],
            'status' => $dataSet['status_d'],
        ];
        Stokdarah::whereRaw('id = ?', array($dataSet['id_S']))->update($data_detail);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil diedit !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanEditUser(Request $request)
    {
        $data1 = json_decode($_POST['data1'], true);
        foreach ($data1 as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $data_user = [
            'nama' => $dataSet['nama'],
            'username' => $dataSet['username'],
            'hak_akses' => $dataSet['hakakses'],
            'status' => $dataSet['status'],
        ];
        User::whereRaw('id = ?', array($dataSet['id']))->update($data_user);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil diedit !'
        ];
        echo json_encode($data);
        die;
    }
    public function hapusStok(Request $request)
    {
        $id = $request->id;
        Stokdarah::whereRaw('id = ?', array($id))->delete();
        $data = [
            'kode' => 200,
            'message' => 'Stok berhasil  dihapus !'
        ];
        echo json_encode($data);
        die;
    }
    public function batalPemakaian(Request $request)
    {
        $id = $request->id;
        $header = DB::select('select * from tb_pemakaian_header where id = ? ', [$id]);
        $detail = DB::select('select * from tb_pemakaian_detail where id_header = ? ', [$id]);
        Pemakaianheader::whereRaw('id = ?', array($id))->update(['status' => 2]);
        Pemakaiandetail::whereRaw('id = ?', array($id))->update(['status' => 2]);
        foreach ($detail as $d) {
            Stokdarah::whereRaw('nomor_kantong = ?', array($d->nomor_kantong))->update(['status' => 1]);
        }
        $data = [
            'kode' => 200,
            'message' => 'Data pemakaian berhasil dibatalkan !'
        ];
        echo json_encode($data);
        die;
    }
    public function detailPemakaianDarah(Request $request)
    {
        $id = $request->id;
        $header = DB::select('select * from tb_pemakaian_header where id = ?', [$id]);
        $detail = DB::select('select * from tb_pemakaian_detail where id_header = ? and status = ?', [$id, 1]);
        return view('Bankdarah.tabel_detail_pemakaian', compact([
            'detail', 'header'
        ]));
    }
    public function get_kode_pemakaian_header()
    {
        $q = DB::connection('mysql')->select('SELECT id,kode_pemakaian_header,RIGHT(kode_pemakaian_header,3) AS kd_max  FROM tb_pemakaian_header
            WHERE DATE(tgl_entry) = CURDATE()
            ORDER BY id DESC
            LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'H' . $kd;
    }
    public function returPemakaian(Request $request)
    {
        $id = $request->id;
        $detail = DB::select('select * from tb_pemakaian_detail where id = ?', [$id]);
        $header = DB::select('select * from tb_pemakaian_header where id = ?', [$detail[0]->id_header]);
        Pemakaiandetail::whereRaw('id = ?', array($id))->update(['status' => 2]);
        Stokdarah::whereRaw('nomor_kantong = ?', array($detail[0]->nomor_kantong))->update(['status' => 1]);
        $jumlah_labu = $header[0]->jumlah_labu;
        $jumlah_labu_skrg = $jumlah_labu - 1;
        if ($jumlah_labu_skrg == 0) {
            Pemakaianheader::whereRaw('id = ?', array($header[0]->id))->update(['status' => 2, 'jumlah_labu' => 0]);
        } elseif ($jumlah_labu_skrg > 0) {
            Pemakaianheader::whereRaw('id = ?', array($header[0]->id))->update(['jumlah_labu' => $jumlah_labu_skrg]);
        } else {
            $data = [
                'kode' => 500,
                'message' => 'Semua pemakaian sudah dibatalkan !'
            ];
            echo json_encode($data);
            die;
        }
        $data = [
            'kode' => 200,
            'message' => 'Pemakaian darah berhasil dibatalkan'
        ];
        echo json_encode($data);
        die;
    }
    public function indexDataUser()
    {
        $menu = 'datauser';
        return view('Bankdarah.indexdatauser', compact([
            'menu'
        ]));
    }
    public function ambilDataUser(Request $request)
    {
        $datauser = db::select('select * from user');
        return view('Bankdarah.tabel_user',compact([
            'datauser'
        ]));
    }
    public function formEditUser(Request $request)
    {
        $user = db::select('select * from user where id = ?',[$request->id]);
        return view('Bankdarah.formedituser',compact([
            'user'
        ]));
    }
}
