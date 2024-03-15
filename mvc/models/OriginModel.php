<?php 
namespace App\Models; 
use App\Models\CRUD;


class OriginModel extends CRUD{

    protected $table = 'origin';
    protected $pkey = 'id';
    protected $fillable = ['pays'];

    
}











?>