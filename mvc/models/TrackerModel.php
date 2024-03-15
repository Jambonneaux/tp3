<?php
namespace App\Models;
use App\Models\CRUD;

class TrackerModel extends CRUD{
    protected $table = "tracker";
    protected $primaryKey = "id";
    protected $fillable = ['ip', 'name', 'visited', 'idEmployee', 'date'];       
    
}