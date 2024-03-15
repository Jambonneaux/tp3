<?php
namespace App\Models;
use App\Models\CRUD;

class EmployeeModel extends CRUD{
    protected $table = "employee";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'password', 'email', 'idPrivilege'];

    public function hashPassword($password, $cost = 10){

        //Ajouter le SALT ici et ne pas oublier le SALT dans la validation 
       
        //return password_hash($password."SALT HERE", PASSWORD_BCRYPT, ['cost' => $cost]);
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);
    }

    public function checkUser($email, $password){
        $employee = $this->unique('email', $email);
        if ($employee) {
            if (password_verify($password, $employee['password'])) {

                session_regenerate_id();
                $_SESSION['employee_id'] = $employee['id'];
                $_SESSION['employee_name'] = $employee['name'];
                $_SESSION['idPrivilege'] = $employee['idPrivilege'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                $_SESSION['tracker_ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['tracker_visited'] = '';
                $_SESSION['tracker_date'] = '';

                return true;
            }else {
                return false;
            }

        }else{
            return false;
        }
    }
}

