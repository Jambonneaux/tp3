<?php
namespace App\Controllers;

use App\Models\TrackerModel;
use App\Providers\View;
use App\Providers\Auth;
use App\Providers\Validator;

class TrackerController{

    public function index(){
        if ($_SESSION['idPrivilege'] == 1) {
            $tracker = new TrackerModel;
            $trackerSelect = $tracker->select();

            if ($trackerSelect) {

                return View::render('tracker/index', ['tracks' => $trackerSelect]);


            }else{

                return View::render('error', ['msg' => 'An error as occured']);

            }
        }else{
            return View::render('error');
        }
    }

    public function store(){
        $track = new TrackerModel;

        $ip = $_SESSION['tracker_ip'];
        $date = $_SESSION['tracker_date'];
        $visited = $_SESSION['tracker_visited'];
        $idEmployee = $_SESSION['employee_id'];
        $name = $_SESSION['employee_name'];

        $data = [$ip, $date, $visited, $idEmployee, $name];
        $track->insert($data);
    }
}