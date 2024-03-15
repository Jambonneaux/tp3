<?php
namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\TrackerModel;
use App\Providers\View;
use App\Providers\Validator;

class AuthController {
    
    public function index(){
        
        return View::render('auth/index');
    }   

    public function store($data){

        $validator = new Validator;
        
        $validator->field('email', $data['email'])->min(2)->max(50)->email();
        $validator->field('password', $data['password'])->min(6)->max(20);
        


        if($validator->isSuccess()){
            $employee = new EmployeeModel();

            $checkUser = $employee->checkUser($data['email'], $data['password']);
            if($checkUser){
               return View::redirect('meat');
            }else {
                $errors['message'] = 'Invalid credentials';
                return View::render('auth/index', ['errors' => $errors, 'employee' => $data]);
            }
        }else{
            $errors = $validator->getErrors();
            return View::render('auth/index', ['errors' => $errors, 'employee' => $data]);
        }
        
    }

    public function delete(){
        session_destroy();
        return View::redirect('login');
    }
}