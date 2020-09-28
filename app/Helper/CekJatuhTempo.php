<?php

namespace App\Helper;

use App\Models\Invoice;
use Carbon\Carbon;

class CekJatuhtempo {
    public function __invoke() {
        try {
            $threeDaysAfterToday = Carbon::now();
            $asDay = $threeDaysAfterToday->addDays(3)->day;
            $invoices = Invoice::where('jatuh_tempo', $asDay)->get();
            if(!$invoices->isEmpty()){
                foreach ($invoices as $key => $value) {
                    $pesan = $this->create_notification($value);
                    $response = $this->send_whatsapp($pesan, $value->no_hp, $value->nama);
                    if($response->status){
                        $invoice = Invoice::find($value->id);
                        $invoice->status = 'sent';
                        $invoice->save();
                    }
                }
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function create_notification($result){
        $url = 'https://rempiw.vercel.app/'.$result->invoice_number;
        $pesan = 'Halo '.$result->nama.'. Pembayaran IW anda akan jatuh tempo pada tanggal '.$result->jatuh_tempo.'. Segera lakukan pembayaran sesuai prosedur yang telah ditentukan. Detail bisa dilihat pada website berikut '.$url;

        return $pesan;
    }

    public function send_whatsapp($message, $phone, $name = ''){
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
}
