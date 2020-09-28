<?php

function sendWhatsapp($message, $phone, $name = ''){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.autochat.id/api/message/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array('phone' => $phone,'name' => $name,'message' => $message,'image_url' => '','image_hash' => ''),
    CURLOPT_HTTPHEADER => array(
        "x-api-key: 26ad42a0b8981b0a4b8dabdccc7a684148327052"
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response);
}

function createNotification($result){
    $url = 'https://rempiw.vercel.app/'.$result->invoice_number;
    $pesan = 'Halo '.$result->nama.'. Pembayaran IW anda akan jatuh tempo pada tanggal '.$result->jatuh_tempo.'. Segera lakukan pembayaran sesuai prosedur yang telah ditentukan. Detail bisa dilihat pada website berikut '.$url;

    return $pesan;
}
