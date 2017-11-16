<?php

namespace App\FormAnalyzer;

class AnalyserService
{    
    public static function list() {
        $results = [];
        $dir = app_path().'\FormAnalyzer';
        $files = scandir( $dir );
        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if($value != "." && $value != ".." && is_dir($path)) {
                if (file_exists($path.DIRECTORY_SEPARATOR.'Parameter.php')) {
                    $reflector = new \ReflectionClass("\App\FormAnalyzer\\".$value."\Parameter");
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

}
