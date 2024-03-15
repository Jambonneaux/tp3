<?php 
namespace App\Models; 
use App\Models\CRUD;


class SupplierModel extends CRUD{

    protected $table = 'supplier';
    protected $pkey = 'id';
    protected $fillable = ['name', 'phone', 'email'];

    
}











?>