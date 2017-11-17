<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Form;
use App\FormAnswer;
use App\Analyzers\AnalyzerService;

class FormController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth:admin');
    }    

    //show forms
    public function index() 
    {
        $forms = Form::all();
        return view('user.form.index',['formlist'=>$forms]);
    }
    
    //show form by id
    public function show($id) 
    {
        $form = Form::find($id);
        return view('user.form.show', ['form' => $form]);
    }

     //form create
     public function create(Request $request) 
     {

        $answer = $request->input();
        if (isset($answer['_token'])) {
            unset($answer['_token']);
        };
        unset($answer['form_id']);
        $answer_json = json_encode($answer);

        $form = Form::find($request->input('form_id'));
        $formAnalyzer = $form->analyzers->get(0);

        $report = AnalyzerService::run($formAnalyzer, $answer_json);

        $answer = new FormAnswer;
        $answer->form_id = $request->input('form_id');
        $answer->form_analyzer_id = $formAnalyzer->id;
        $answer->user_id = 1;
        $answer->answer = $answer_json;
        $answer->answer_report = $report['report'];
        $answer->answer_report_data = $report['report_data'];
        $answer->save();

        return view('user.form.result', ['form' => $request->input(),'result'=>$report['report']]);
     }   

     //get form answers
    public function answers($form_id)
    {
        $form = Form::find($form_id);
        $formColumns = json_decode($form->columns,true);
        return view('user.form.answers',['form'=>$form,'formColumns'=>$formColumns]);
    }
     
}
