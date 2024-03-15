<?php 
namespace App\Models;


abstract class CRUD extends \PDO{

    final public function __construct(){
        
        parent::__construct('mysql:host=localhost; dbname=meatmarket; port=3306; charset=utf8', 'root', '');
      
    }


    //Select All

    final public function select($pkey = null, $order = 'asc'){

        if ($pkey == null) {

            $pkey = $this->pkey;

        }

        $sql = "SELECT * FROM $this->table ORDER BY $pkey $order";

        if ($stmt = $this->query($sql)) {

            return $stmt->fetchAll();

        }else {

            return false;

        }
        

    }


    //selectId

    final public function selectId($value){

        $sql = "SELECT * FROM $this->table WHERE $this->pkey = :$this->pkey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->pkey", $value);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count == 1) {

            return $stmt->fetch();

        }else{

            return false;

        }

    }


    //Insert

    public function insert($data){

        $data_keys = array_fill_keys($this->fillable, '');
        $data = array_intersect_key($data, $data_keys);

        //return $data_keys;

        $fieldName = implode(', ', array_keys($data));
        $fieldValue = ":" . implode(', :', array_keys($data));

        $sql = "INSERT INTO $this->table ($fieldName) VALUES ($fieldValue)";

        //return $sql;

        $stmt = $this->prepare($sql);

        foreach ($data as $key => $value){

            $stmt->bindValue(":$key", $value);

        }
        if($stmt->execute()){

            return $this->lastInsertId();

        }else{

            return false;

        }
    }


    //Update

    //$data si plusieurs valeurs
    
    public function update($data, $id){
        if ($this->selectId($id)) {
            
        

            $data_keys = array_fill_keys($this->fillable, '');
            $data = array_intersect_key($data, $data_keys);

            //return $data_keys;

            $fieldName = null;
            foreach($data as $key=>$value){
                $fieldName .= "$key = :$key, ";
            }
            $fieldName = rtrim($fieldName, ', ');

            $sql = "UPDATE $this->table SET $fieldName WHERE $this->pkey = :$this->pkey;";

            //Return $sql ici pour tester si la requête est bonne.
            
            $stmt = $this->prepare($sql);

            //Deux façon différente même résultat
            //$stmt->bindValue("$this->pkey", $id);
            $data[$this->pkey] = $id;

            foreach( $data as $key => $value ){
                $stmt->bindValue(":$key", $value);

            }
            
            $stmt->execute();

            $count = $stmt->rowCount();
            if($count == 1){
                return true;
            }else{
                return false;
            }
            
        }else{
            return false;
        }

    }


    //Delete

    public function delete($id){

        if ($this->selectId($id)) {
            
            $sql = "DELETE FROM $this->table WHERE $this->pkey = :$this->pkey";
    
            $stmt = $this->prepare($sql);
            $stmt->bindValue(":$this->pkey", $id);
    
            if($stmt->execute()){
    
                return true;
    
            }else{
    
                return false;
    
            }
        }else{

            return false;

        }      
    }

    public function unique($field, $value){

        $sql = "SELECT * FROM $this->table WHERE $field = :$field";

        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count == 1) {

            return $stmt->fetch();

        }else{

            return false;
            
        }
    }

}





?>