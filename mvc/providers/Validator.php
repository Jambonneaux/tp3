<?php 
namespace App\Providers;


class Validator {
    private $errors = array();
    private $key;
    private $value;
    private $name;

    public function field($key, $value, $name = null){
        $this->key = $key;
        $this->value = $value;
        if ($name == null) {
            $this->name = ucfirst($key);

        }else{
            $this->name = ucfirst($name);

        }
        //return this pour pouvoir faire des functions à la suite ie: field('name', $data['name'], 'This field is required')->required()->format();
        return $this;
    }
////////////////////////////////////////////////// VALIDATION RULES /////////////////////////////////////////////

    public function required(){
        if (empty($this->value)) {
            //Push l'erreur dans un tableau vide
            $this->errors[$this->key]="$this->name est obligatoire.";

        }

        return $this;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Ajouter ici autant de function de validation que l'on veux et call à la suite ie : field()->require()->max()->email()

    public function number() {
        if (!empty($this->value) && !is_numeric($this->value)) {
            $this->errors[$this->key]="$this->name must be a number.";
        }
        return $this;
    }

    public function unique($model){
        $model = 'App\\Models\\'.$model;
        $model = new $model;
        $unique = $model->unique($this->key, $this->value);
        if ($unique) {
            $this->errors[$this->key]="$this->name éxiste déja";
        }
        return $this;
    }

    public function max($length){
        if(strlen($this->value) > $length){
            $this->errors[$this->key]="$this->name must be less than $length characters";
        }
        return $this;
    }

    public function min($length){
        if(strlen($this->value) < $length){
            $this->errors[$this->key]="$this->name must be bigger than $length characters";
        }
        return $this;
    }

    public function email() {
        if(!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)){
            $this->errors[$this->key] = "Invalid $this->name format";
        }
        return $this;
    }












////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function isSuccess(){
        if(empty($this->errors)) return true;
    }

    public function getErrors(){
        if (!$this->isSuccess()) {
            return $this->errors;
        }
    }

}























?>