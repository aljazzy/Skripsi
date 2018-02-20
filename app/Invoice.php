<?php
/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 08/01/2018
 * Time: 1:31
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model {
    use SoftDeletes;

    protected $table = 'invoices';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id_invoices','id_pesanan','nm_tamu','alamat','type_byr','bukti_byr','hp','add_service','total_harga'
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];

    public function  pesanans() {
        return $this->hasMany(Pesanan::class,'id_pesanan','id_pesanan');
    }
    public function  units() {
        return $this->belongsTo(Unit::class,'pesanans.id_unit','id_unit');
    }


}