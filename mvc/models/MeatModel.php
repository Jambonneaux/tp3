<?php 
namespace App\Models; 
use App\Models\CRUD;


class MeatModel extends CRUD{

    protected $table = 'meat';
    protected $pkey = 'id';
    protected $fillable = ['quantity', 'idSupplier', 'arrival', 'idType', 'idOrigin', 'idQuality'];

    
}











?>