<?php
namespace lib;

class Model
{
    public function model($modelName) {
        $path = "app/model/". $modelName. ".php";
        if(file_exists($path)){
			require $path;
            return new $modelName();
		}
    }
}


?>