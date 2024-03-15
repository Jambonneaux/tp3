<?php 
namespace App\Controllers;
use App\Models\MeatModel;
use App\Models\OriginModel;
use App\Models\SupplierModel;
use App\Models\TypeModel;
use App\Models\QualityModel;
use App\Providers\View;
use App\Providers\Validator;


class MeatController{

    public function index(){

        $meat = new MeatModel;
        $origin = new OriginModel;
        $supplier = new SupplierModel;
        $type = new TypeModel;
        $quality = new QualityModel;

        $meatSelect = $meat->select();

        foreach ($meatSelect as $key => $meatItem){
            $originSelect = $origin->selectId($meatItem['idOrigin']);
            $meatSelect[$key]['idOrigin'] = $originSelect['pays'];
        }

        foreach ($meatSelect as $key => $meatItem){
            $supplierSelect = $supplier->selectId($meatItem['idSupplier']);
            $meatSelect[$key]['idSupplier'] = $supplierSelect['name'];
        }

        foreach ($meatSelect as $key => $meatItem){
            $typeSelect = $type->selectId($meatItem['idType']);
            $meatSelect[$key]['idType'] = $typeSelect['type'];
        }

        foreach ($meatSelect as $key => $meatItem){
            $qualitySelect = $quality->selectId($meatItem['idQuality']);
            $meatSelect[$key]['idQuality'] = $qualitySelect['quality'];
        }




        if ($meatSelect) {

            return View::render('meat/index', ['meats' => $meatSelect]);

        }else{

            return View::render('error', ['msg' => 'An error as occured']);

        }
        
    }


    public function show($data = []){

        if (isset($data['id']) && $data['id'] !==null){
            
            $meat = new MeatModel;
            $origin = new OriginModel;
            $supplier = new SupplierModel;
            $type = new TypeModel;
            $quality = new QualityModel;

            $selectId = $meat->selectId($data['id']);

            if ($selectId) {

                $qualitySelect = $quality->selectId($selectId['idQuality']);
                if ($qualitySelect) {
                    $selectId['idQuality'] = $qualitySelect['quality'];
                }

                $typeSelect = $type->selectId($selectId['idType']);
                if ($typeSelect) {
                    $selectId['idType'] = $typeSelect['type'];
                }

                $supplierSelect = $supplier->selectId($selectId['idSupplier']);
                if ($supplierSelect) {
                    $selectId['idSupplier'] = $supplierSelect['name'];
                }

                $originSelect = $origin->selectId($selectId['idOrigin']);
                if ($originSelect) {
                    $selectId['idOrigin'] = $originSelect['pays'];
                }
    
                return View::render('meat/show', ['meat' => $selectId]);
    
            }else{
    
                return View::render('error', ['msg' => 'An error as occured']);
    
            }
        }else{

            return View::render('error', ['msg' => 'Cannot enter this way']);

        }
        

    }

    public function create(){

        $meat = new MeatModel;
        $origin = new OriginModel;
        $supplier = new SupplierModel;
        $type = new TypeModel;
        $quality = new QualityModel;

        $originSelect = $origin->select();
        $supplierSelect = $supplier->select();
        $typeSelect = $type->select();
        $qualitySelect = $quality->select();

        
        if ($originSelect && $supplierSelect && $typeSelect && $qualitySelect) {
            return View::render('meat/create', ['origins' => $originSelect, 'types' => $typeSelect, 'suppliers' => $supplierSelect, 'qualitys' => $qualitySelect] );
        }else{

            return View::render('error', ['msg' => 'An error as occured']);

        }

    }


    public function edit($data = []){
       
        if (isset($data['id']) && $data['id'] !==null){
            
            $meat = new MeatModel;
            $origin = new OriginModel;
            $supplier = new SupplierModel;
            $type = new TypeModel;
            $quality = new QualityModel;

            $selectId = $meat->selectId($data['id']);

            $originSelect = $origin->select();
            $supplierSelect = $supplier->select();
            $typeSelect = $type->select();
            $qualitySelect = $quality->select();
    
            if ($selectId) {
    
                return View::render('meat/edit', ['meat' => $selectId, 'origins' => $originSelect, 'types' => $typeSelect, 'suppliers' => $supplierSelect, 'qualitys' => $qualitySelect]);
    
            }else{
    
                return View::render('error', ['msg' => 'An error as occured']);
    
            }
        }else{

            return View::render('error', ['msg' => 'Cannot enter this way']);

        }
    }

    public function store($data){

        //Validation dummy

        $validator = new Validator;

        $validator->field('quantity', $data['quantity'], 'Quantity')->number();


        //l'ordre est important ici(quel table doit être rempli en premier)
        if ($validator->isSuccess()) {
            
            $meat = new MeatModel;
            $insert = $meat->insert($data);
            
            if ($insert) {
                
                return View::redirect('meat');
            
            }else {
            
                return View::render('error', ['msg' => 'An error as occured']);
            
            }
        }else{
            $errors = $validator->getErrors();

            //envoie le tableau que j'ai nommé 'errors' dans le view 'meat/create'
            return View::render('meat/create', ['errors' => $errors, 'meat' => $data]);
        }


    }
    //$get pour récup l'id qui viens du Route
    public function update($data, $get){

        $validator = new Validator;

        $validator->field('quantity', $data['quantity'], 'Quantity')->number();

        //l'ordre est important ici(quel table doit être rempli en premier)
        if ($validator->isSuccess()) {
            
            $meat = new MeatModel;
            $update = $meat->update($data, $get['id']);
            //echo die() $update ici pour voir la requête 

            if ($update) {
                return View::redirect('meat/show?id='.$get['id']);
            }else{
                return View::render('error');
            }

        }else{
            $errors = $validator->getErrors();

            //envoie le tableau que j'ai nommé 'errors' dans le view 'meat/edit'
            return View::render('meat/edit', ['errors' => $errors, 'meat' => $data]);
        }
    }


    public function delete($data){

        $meat = new MeatModel;
        $delete = $meat->delete($data['id']);

        if($delete){

            return View::redirect('meat');

        }else{

            return View::render('error', ['msg' => 'An error as occured']);

        }

    }

}









?>