<?php
namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\PrivilegeModel;
use App\Providers\View;
use App\Providers\Auth;
use App\Providers\Validator;

class EmployeeController{

    public function create(){
        if ($_SESSION['idPrivilege'] == 1) {
            $privilege = new PrivilegeModel;
            $privileges = $privilege->select('privilege');
            return View::render('employee/create', ['privileges' => $privileges]);
        }else{
            return View::render('error');
        }
    }

    public function store($data){

        if ($_SESSION['idPrivilege'] == 1) {
            $validator = new Validator;
            $validator->field('name', $data['name'])->min(2)->max(50);
            $validator->field('password', $data['password'])->min(6)->max(20);
            $validator->field('email', $data['email'])->required()->max(100)->email()->unique('EmployeeModel');
            $validator->field('idPrivilege', $data['idPrivilege'], 'Privilege')->required();


            if($validator->isSuccess()){
                $employee = new EmployeeModel;

                $data['password'] = $employee->hashPassword($data['password']);

                //Si je veux éviter la répétition de code
                //$data['email'] = $data['username']);

                $insert = $employee->insert($data);
                if($insert){
                    return View::redirect('login');
                }else{
                    return View::render('error');
                }

            }else{
                $errors = $validator->getErrors();
                $privilege = new PrivilegeModel;
                $privileges = $privilege->select('privilege');
                return View::render('employee/create', ['errors'=>$errors, 'employee'=>$data, 'privileges' => $privileges]);
            }

        }else{
            return View::render('error');
        }
    }
}