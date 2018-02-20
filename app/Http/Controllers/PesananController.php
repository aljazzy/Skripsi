<?php
/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 08/01/2018
 * Time: 0:23
 */

namespace App\Http\Controllers;

use App\Invoice;
use App\Pesanan;
use App\Unit;
use FastRoute\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PesananController extends Controller {

    public function index()
    {
        $pesanan = Pesanan::all();
        $data = array("pesanans" =>$pesanan);

        return response()->json($data,200,['Content-type'=> 'application/json; charset=utf-8'],JSON_PRETTY_PRINT);

    }
    public function byuser($user)
    {
        $pesanan = Pesanan::where('id_user',$user)->get();
        $data = array("pesanans" =>$pesanan);

        return response()->json($data,200,['Content-type'=> 'application/json; charset=utf-8'],JSON_PRETTY_PRINT);

    }
    public function query($user,$id){
        $pesanan = Pesanan::where('id_user',$user)
                            ->where('id_pesanan',$id)->get();
        $data = array("pesanans" =>$pesanan);

        return response()->json($data,200,['Content-type'=> 'application/json; charset=utf-8'],JSON_PRETTY_PRINT);
    }

    public function sendParams($id){
//        $date = Carbon::now()->format('dmy');
//        $inv = "INV-".$date.'/'.time();
//        $id_pes = $id;
//
//        $invoice = Invoice::with(['pesanans','pesanans.units'])->where("id_pesanan", $id)->get();
//        dd($invoice);
//        $harga = $invoice[0]->pesanans->units[0]->harga ;
//        $lama_sewa = $invoice[0]->pesanans->lama_sewa ;
//
//        $date = Carbon::now()->format('dmy');
//        $total = $harga * $lama_sewa;
//
//
////        $create = Invoice::create([
////            'id_invoices' => $inv,
////            'id_pesanan' => $id_pes,
////            'total_harga' => $total
////        ]);
//        return $total;

    }
    public function create(Request $request){



        $pesanan = rand(100,999);
        $unit = $request->input('id_unit');
        $user = $request->input('id_user');
        $jml = $request->input('jml_tamu');
        $lm_sewa = $request->input('lama_sewa');
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $paid = $request->input('is_paid');
        $total = $request->input('total');
        $redirect = 1;


        /*------ Create Pesanan  -----*/

        $book = Pesanan::create([
            'id_pesanan' => $pesanan,
            'id_user' => $user,
            'id_unit' => $unit,
            'jml_tamu' => $jml,
            'lama_sewa' => $lm_sewa,
            'start_date' => $start,
            'end_date' => $end,
            'is_paid' => $paid,
            'total' => $total
        ]);

        if ($book) {
            $res['error'] = false;
            $res['message'] = 'Pesan Unit Berhasil!';
            $res['redirect'] = $redirect;
            $res['id_pesanan'] = $pesanan;
            $res['total'] = $total;

//            $coba = $this->test($pesanan);

            return response($res);
        }

        /*------ Create Invoice Simulation -----*/



    }




    public function show($id){
        $book = Pesanan::find('id_pesanan',$id)->get();

        return response()->json($book,200);
    }

    public function destroy($id){
        $book = Pesanan::where('id_pesanan',$id);

            if ($book->delete()){
                $res['error'] = false;
                $res['message'] = "Berhasil Dihapus";

                return response($res);
            };

    }

}