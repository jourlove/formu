<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Form;
use App\FormAnalyzer;
use App\FormAnalyzer\AnalyserService;

class FormController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $forms = Form::all();
        return view('admin.form.list',['formlist'=>$forms]);
    }

    public function new()
    {
        return view('admin.form.new');
    }

    public function update($id)
    {
        $form = Form::find($id);
        return view('admin.form.update',['form'=>$form]);
    }

    public function delete($id)
    {
        Form::destroy($id);
        return redirect()->route('admin::forms');
    }

    //save form
    public function save(Request $request)
    {

        $formid = $request->input('formid');        
        $form = ($formid ? Form::find($formid) : new Form);
        $form->name = $request->input('formName');
        $form->fields = json_decode($request->input('formStructure'));
        $columns = [];
        foreach(json_decode($form->fields,true) as $field) {
            //Log::info('field '.$field);
            $columns[$field['name']] = strip_tags($field['label']);
        };
        $form->columns = json_encode($columns);
        $form->save();

        $msg = ($formid ? __("admin.com.msg.update_success") : __("admin.com.msg.save_success"));

        return ['msg'=>$msg];
    }

    //get form answers
    public function answers($form_id)
    {
        $form = Form::find($form_id);
        $formColumns = json_decode($form->columns,true);
        return view('admin.form.answers',['form'=>$form,'formColumns'=>$formColumns]);
    }

    //set form analyzer
    public function analyzerlist($form_id)
    {
        $form = Form::find($form_id);
        return view('admin.form.analyzerlist',['form'=>$form]);
    }

    //set form analyzer
    public function analyzer($form_id)
    {
        $form = Form::find($form_id);
        $formColumns = json_decode($form->columns,true);
        $analysers = AnalyserService::list();
        $available_analysers = [];
        foreach($form->analyzers as $form_analyzer) {
            if (array_key_exists($form_analyzer->analyzer,$analysers)) {
                unset($analysers[$form_analyzer->analyzer]);
            } 
        }
        return view('admin.form.analyzer',['form_id'=>$form_id,'formColumns'=>$formColumns,'analysers'=>$analysers]);
    }
    
    //save form analyzer
    public function analyzerSave(Request $request)
    {
        $analyzer = new FormAnalyzer();
        $analyzer->form_id = $request->input('form_id');
        $analyzer->paramters_map = json_encode($request->input());
        $analyzer->analyzer = $request->input('analyzer');
        $analyzer->save();
        return redirect()->route('admin::forms');
    }
    

}
