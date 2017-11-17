<?php

namespace App\Analyzers;

use App\FormAnalyzer;

class AnalyzerService
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
    public static function run(FormAnalyzer $formAnalyzer, $answer_json) {
        $analyzer = $formAnalyzer->analyzer;
        $reflector_parameter = new \ReflectionClass("\App\Analyzers\\".$analyzer."\Parameter");
        $parameter_instance = $reflector_parameter->newInstance();
        $properties = $reflector_parameter->getProperties();
        $answer = json_decode($answer_json);
        $paramters_map = json_decode($formAnalyzer->paramters_map,true);
        foreach($properties as $prop) {
            $property = $prop->name;
            $answer_option = $paramters_map[$property];
            $parameter_instance->$property = $answer->$answer_option;
        } 
        $reflector_analyzer = new \ReflectionClass("\App\Analyzers\\".$analyzer."\Analyzer");
        $analyzer_instance = $reflector_analyzer->newInstance();
        return $analyzer_instance->run($parameter_instance);
    }

}
