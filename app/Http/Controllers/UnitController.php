<?php
/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 24/12/2017
 * Time: 22:33
 */

namespace App\Http\Controllers;

use App\Pesanan;
use App\Unit;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image;

//use Intervention\Image\Facades\Image;


class UnitController extends Controller
{
//    public function __construct()
//    {
//        //
//    }

    public function index(Request $request, Response $response){
        $unit = Unit::where('status',1)->get();
        $data = array("units" =>$unit);

        return response()->json($data,200,['Content-type'=> 'application/json; charset=utf-8'],JSON_PRETTY_PRINT);

    }

    public function show($id){
        $unit = Unit::where('id_unit',$id)->get();

        return response()->json($unit);
    }
    public function store(Request $request){
        $unit = new Unit;
        $unit->id_unit = $request->input('id_unit');
        $unit->nama_unit = $request->input('nama_unit');
        $unit->type = $request->input('type');
        if ($request->hasFile('gambar')){
            $gambar = $request->file('gambar');
            //$basepath = 'http://great.lov/api-aero/public/uploads/';
            $destPath = public_path('/uploads');
            $filename = time().'.'.$gambar->getClientOriginalExtension();
            $gambar->move($destPath, $filename);
            $unit->gambar = $filename;
        }
        $unit->harga = $request->get('harga');
        $unit->capacity = $request->get('capacity');
        $unit->info = $request->get('info');
        $unit->alamat = $request->get('alamat');
        //$unit->area = $request->get('area');
        //$unit->status = $request->get('status');
        $unit->save();
        return response()->json($unit);
    }
    public function delete($id){
        $unit = Unit::findOrfail($id);
        $unit->delete();

        return response()->json('Unit Deleted',200,['Content-type'=> 'application/json; charset=utf-8'], JSON_PRETTY_PRINT);
    }
    public function update(Request $request, $id){

        $input = Unit::findOrFail($id);
        $unit = $request->all();
        $input->fill($unit);
        $input->save();

        return response()->json(['status' => 'success']);
        //return response()->json($input);
    }
}