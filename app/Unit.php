<?php
/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 24/12/2017
 * Time: 22:06
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model {

    use SoftDeletes;

    public $table = 'units';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id_unit',
        'nama_unit',
        'type',
        'gambar',
        'harga',
        'capacity',
        'info',
        'alamat',
    ];
    protected $hidden = [
        'created_at','updated_at',
    ];

//    public function pesanans(){
//        return $this->belongsTo(Pesanan::class,'id_unit','id_unit');
//    }

//    public function invoices(){
//        return $this->hasMany(Invoice::class,'id_unit','id_unit');
//    }

}