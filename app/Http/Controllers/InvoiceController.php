<?php
namespace App\Http\Controllers;

use App\Invoice;
use App\Pesanan;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class InvoiceController extends Controller {

    public function index($id){

        $invoices = Invoice::where('id_pesanan',$id);

        return response()->json($invoices,200);
    }

    public function create(Request $request,$user,$id){
        $date = Carbon::now()->format('dmy');
        $inv = "INV-".$date.'/'.time();
        $nm_tm = $request->input('nm_tamu');
        $alamat = $request->input('alamat');
        $type = $request->input('type');
        $hp = $request->input('hp');
        $add = $request->input('add_service');
        $bukti_by = $request->input('bukti_byr');
        $total = $request->input('total');

        $create = Invoice::create([
            'id_invoices' => $inv,
            'id_pesanan' => $id,
            'nm_tamu' => $nm_tm,
            'alamat' => $alamat,
            'type_byr' => $type,
            'bukti_byr' => $bukti_by,
            'hp' => $hp,
            'add_service' => $add,
            'total_harga' => $total
        ]);

        if (!$create) {
            $res['message'] = "invalid" ;
            $res['redirect'] = 2;
            return response($res);
        } else {
            $res['message'] = "success" ;
            $res['redirect'] = 1;
            return response($res);
        }
    }


    public function test(Request $request,$id){

        $date = Carbon::now()->format('dmy');
        $inv = "INV-".$date.'/'.time();

        $nm_tm = $request->input('nm_tamu');
        $alamat = $request->input('alamat');
        $type = $request->input('type');
        $hp = $request->input('hp');
        $add = $request->input('add_service');
        $bukti_by = $request->input('bukti_byr');
        $total = $request->input('total');

        $create = Invoice::create([
            'id_invoices' => $inv,
            'id_pesanan' => $id,
            'nm_tamu' => $nm_tm,
            'alamat' => $alamat,
            'type_byr' => $type,
            'bukti_byr' => $bukti_by,
            'hp' => $hp,
            'add_service' => $add,
            'total_harga' => $total
        ]);

        if (!$create) {
            $res['message'] = "invalid" ;
            $res['redirect'] = 2;
            return response($res);
        } else {
            $res['message'] = "success" ;
            $res['redirect'] = 1;
            return response($res);
        }
    }

}