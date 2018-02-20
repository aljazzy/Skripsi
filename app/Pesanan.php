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

class Pesanan extends Model {

    use SoftDeletes;

    public $table = 'pesanans';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id_pesanan',
        'id_user',
        'id_unit',
        'jml_tamu',
        'lama_sewa',
        'start_date',
        'end_date',
        'is_paid',
        'total'
    ];
    protected $hidden = [
        'created_at','updated_at',
    ];

//    public function units(){
//        return $this->hasMany(Unit::class,'id_unit','id_unit' );
//    }
//    public function users(){
//        return $this->hasOne(User::class,'id_user','id_user');
//    }

    public function invoices(){
        return $this->belongsTo(Invoice::class ,'id_pesanan','id_pesanan');
    }
}