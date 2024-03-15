<?php 
namespace App\Models; 
use App\Models\CRUD;


class QualityModel extends CRUD{

    protected $table = 'quality';
    protected $pkey = 'id';
    protected $fillable = ['quality'];

    
}











?>