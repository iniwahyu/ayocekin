<?php

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

function rupiah($amount) {
    return number_format($amount, 0, ".", ",");
}

function phoneIndo($nohp) {
    $nohp = str_replace(" ", "", $nohp);
    // kadang ada penulisan no hp 0811 239 345
    $nohp = str_replace("(", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace(")", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace(".", "", $nohp);
    // kadang ada penulisan no hp 0811.239.345 
    $nohp = str_replace("-", "", $nohp);
    // kadang ada penulisan no hp dengan (-) 

    $hp = '';

    if (!preg_match('/[^+0-9]/', trim($nohp)))
    // cek apakah no hp mengandung karakter + dan 0-9
    {
        if (substr(trim($nohp), 0, 3) == '+62')
        // cek apakah no hp karakter 1-3 adalah +62
        {
            $hp = trim($nohp);
        } elseif (substr(trim($nohp), 0, 1) == '0')
        // cek apakah no hp karakter 1 adalah 0
        {
            $hp = '62' . substr(trim($nohp), 1);
        } else {
            $hp = $nohp;
        }
        // fungsi trim() untuk menghilangan
        // spasi yang ada didepan/belakang
    } else {
        return false;
        // $hp = 'Format no hp yang dimasukkan tidak lengkap atau salah!';
    }
    return $hp;
}

function kirimWhatsapp($phone, $message, $type = null) {

    $token = "zr66c5h1JYdZnapzKm8Fxw1GbEeUmkpgHFEVL4bQgypnmSs5QK";
    // $phone= "6281575127090"; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
    // $message = "Ada Order Masuk Bosque. Dikasih info Masszeh";

    $curlUrl = 'https://app.ruangwa.id/api/send_message';
    if ($type == 'express') {
        $curlUrl = 'https://app.ruangwa.id/api/send_express';
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $curlUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'token='.$token.'&number='.$phone.'&message='.$message,
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;

}

function orderStatus($number) {
    $data = [
        '1' => 'Pesanan Diterima',
        '2' => 'Pesanan Tertunda',
        '3' => 'Pesanan Invalid',
        '4' => 'Pesanan Gagal',
        '5' => 'Pesanan Berhasil',
    ];
    return $data[$number];
}

function paymentStatus($number) {
    $data = [
        '1' => 'Pembayaran Diterima',
        '2' => 'Pembayaran Dikonfirmasi',
        '3' => 'Pembayaran Diproses',
        '4' => 'Pembayaran Ditolak',
        '5' => 'Pembayaran Berhasil'
    ];
    return $data[$number];
}

function dmyToymd($date) {
    return Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
}

function ymdTodmy($date) {
    return Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
}