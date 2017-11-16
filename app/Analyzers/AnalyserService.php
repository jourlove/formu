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
    public static function run(FormAnalyzer $formAnalyser, $answer_json, $type='report') {
        $analyzer = $formAnalyser->analyzer;
        $reflector_parameter = new \ReflectionClass("\App\Analyzers\\".$analyzer."\Parameter");
        $parameter_instance = $reflector_parameter->newInstance();
        $properties = $reflector_parameter->getProperties();
        $answer = json_decode($answer_json);
        $paramters_map = json_decode($formAnalyser->paramters_map,true);
        $maps = [];
        foreach($paramters_map as $answer_option=>$property) {
            $maps[$property] = $answer_option;
        }
        foreach($properties as $prop) {
            $property = $prop->name;
            $answer_option = $maps[$property];
            $parameter_instance->$property = $answer->$answer_option;
        } 
        $reflector_analyzer = new \ReflectionClass("\App\Analyzers\\".$analyzer."\Analyzer");
        $analyzer_instance = $reflector_analyzer->newInstance();
        return ($type=='report' ? $analyzer_instance->report($parameter_instance) : $analyzer_instance->data($parameter_instance));
    }

}
