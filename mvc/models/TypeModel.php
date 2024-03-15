<?php 
namespace App\Models; 
use App\Models\CRUD;


class TypeModel extends CRUD{

    protected $table = 'type';
    protected $pkey = 'id';
    protected $fillable = ['type'];

    
}











?>