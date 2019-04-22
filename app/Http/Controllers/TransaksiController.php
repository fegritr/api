<?php

namespace App\Http\Controllers;


use App\Transaksi;
use App\User;
use Illuminate\Http\Request;
use Validator;

class TransaksiController extends Controller
{

    public function index()
    {
        $data = Transaksi::all();
        if (count($data) > 0) {
            $res['message'] = 'Success!';
            $res['values'] = $data;
            return response($res);
        } else {
            $res['message'] = 'Data Empty';
            return response($res, 404);
        }
    }

    public function store(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $login = User::where('email', $email)->first();
        if ($login) {
            if ($password === $login->password) {
                $nama_barang = $request->input('nama_barang');
                $harga = $request->input('harga');
                $tanggal_transaksi = \Carbon\Carbon::now();


                $data = new \App\Transaksi();
                $data->nama_barang = $nama_barang;
                $data->harga = $harga;
                $data->tanggal_transaksi = $tanggal_transaksi;

                if ($data->save()) {
                    $res['message'] = "Success!";
                    $res['value'] = $data;
                    return response($res);
                }
            } else {
                $res['message'] = 'Email atau Password Salah!';
                return response($res);
            }
        } else {
            $res['message'] = 'Email Tidak Terdaftar!';
            return response($res);
        }
    }

    public function show($id)
    {
        $data = Transaksi::where('id', $id)->get();
        if (count($data) > 0) {
            $res['message'] = 'Success!';
            $res['values'] = $data;
            return response($res);
        } else {
            $res['message'] = 'Data Not Found';
            return response($res, 404);
        }
    }

    public function searchTransaksi($nama_barang)
    {
        $data = Transaksi::where('nama_barang', 'LIKE', '%' . $nama_barang . '%')->get();
        if (count($data) > 0) {
            $res['message'] = 'Success!';
            $res['values'] = $data;
            return response($res);
        } else {
            $res['message'] = 'Data Not Found';
            return response($res, 404);
        }
    }

    public function showTotalTransaksi($days)
    {
                $date = \Carbon\Carbon::today()->subDays($days);

                $data = Transaksi::where('tanggal_transaksi', '>=', $date)->get('harga');
                $sum = 0;
                foreach ($data as $total => $value) {
                    $sum += $value['harga'];
                }

                if (count($data) > 0) {
                    $res['message'] = 'Success!';
                    $res['total_harga'] = $sum;
                    $res['total_transaksi'] = count($data);

                    return response($res);
                } else {
                    $res['message'] = 'Data not found';


                    return response($res, 404);
                } 
        }
    

    public function update(Request $request, $id)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $login = User::where('email', $email)->first();
        if ($login) {
            if ($password === $login->password) {
                $nama_barang = $request->input('nama_barang');
                $harga = $request->input('harga');

                $data = Transaksi::where('id', $id)->first();
                $data->nama_barang = $nama_barang;
                $data->harga = $harga;

                if ($data->save()) {
                    $res['message'] = "Success!";
                    $res['value'] = $data;
                    return response($res);
                }
            } else {
                $res['message'] = 'Email atau Password Salah!';
                return response($res);
            }
        } else {
            $res['message'] = 'Email Tidak Terdaftar!';
            return response($res);
        }
    }

    public function destroy(Request $request, $id)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $login = User::where('email', $email)->first();
        if ($login) {
            if ($password === $login->password) {
                $data = \App\Transaksi::where('id', $id)->first();

                if ($data != null) {
                    $res['message'] = "Success!";
                    $res['value'] = $data;
                    return response($res);
                } else {
                    $res['message'] = "Data Not Found!";
                    return response($res, 404);
                }
            } else {
                $res['message'] = 'Email atau Password Salah!';
                return response($res);
            }
        } else {
            $res['message'] = 'Email Tidak Terdaftar!';
            return response($res);
        }
    }
}
