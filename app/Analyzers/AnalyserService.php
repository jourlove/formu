<?php

namespace App\Analyzers;

use App\FormAnalyzer;

class AnalyserService
{    
    //Analyzer list
    public static function list() {
        $results = [];
        $dir = app_path().'\Analyzers';
        $files = scandir( $dir );
        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if($value != "." && $value != ".." && is_dir($path)) {
                if (file_exists($path.DIRECTORY_SEPARATOR.'Parameter.php')) {
                    $reflector = new \ReflectionClass("\App\Analyzers\\".$value."\Parameter");
                    $properties = $reflector->getProperties();
                    $params = [];
                    foreach($properties as $prop) {
                        $params[] = $prop->name;
                    } 
                    $results[$value] = $params;
                }
            }
        }
        return $results;
    }

    //Handle analyzer
    public static function run($type,FormAnalyzer $formAnalyser, $data) {
        return "RESULT OK".$data;
    }

}
