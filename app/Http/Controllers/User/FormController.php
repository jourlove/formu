<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Form;
use App\FormAnswer;
use App\Analyzers\AnalyserService;

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

        $form = Form::find($request->input('form_id'));
        $formAnalyzer = $form->analyzers->get(0);
        $result = AnalyserService::run(1, $formAnalyzer, json_encode($request->input()));

        $answer = new FormAnswer;
        $answer->form_id = $request->input('form_id');
        $answer->user_id = 1;
        $answer->answer = json_encode($request->input());
        $answer->save();
        
        return view('user.form.result', ['form' => $request->input(),'result'=>$result]);
     }   

     //get form answers
    public function answers($form_id)
    {
        $form = Form::find($form_id);
        $formColumns = json_decode($form->columns,true);
        return view('user.form.answers',['form'=>$form,'formColumns'=>$formColumns]);
    }
     
}
