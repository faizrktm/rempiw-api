<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Helper\CekJatuhTempo;

class InvoiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show($id){
        $result = Invoice::with(['invoice_details'])
            ->where('invoice_number', $id)
            ->first();
        return $this->successResponse(200, $result);
    }

    public function list(){
        $results = Invoice::with(['invoice_details'])
            ->where('status', 'draft')
            ->get();
        return $this->successResponse(200, $results);
    }

    public function send($id){
        $result = Invoice::with(['invoice_details'])->find($id);
        if(!$result){
            return $this->errorResponse(404, 'Invoice Tidak Ditemukan');
        }
        $jt = new CekJatuhTempo();
        $pesan = $jt->create_notification($result);
        $response = $jt->send_whatsapp($pesan, $result->no_hp, $result->nama);
        if($response->status){
            $result->status = 'sent';
            $result->save();
            return $this->successResponse(200, 'Notifikasi berhasil dikirim');
        } else {
            return $this->errorResponse(500, 'Gagal mengirim pesan');
        }
    }

    public function check(){
        try {
            $obj = new CekJatuhTempo;
            $obj();
            return $this->successResponse(200, 'Notifikasi berhasil dikirim');
        } catch (\Exception $e) {
            return $this->errorResponse(500, $e->getMessage());
        }
    }
}
