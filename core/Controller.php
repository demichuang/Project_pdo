<?php

class Controller {
    public function model($model) {
        require_once "../Project_pdo/models/$model.php";
        return new $model ();
    }
    
    public function view($view, $data = Array(),$data2 = Array(),$data3 = Array(),$data4 = Array()) {
        require_once "../Project_pdo/views/$view.php";
    }
}


?>