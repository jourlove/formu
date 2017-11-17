@extends('layouts.app')

@section('title', 'Form')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#ID</th>
                <th scope="col">Name</th>
                <th scope="col">Answer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formlist as $form)
                <tr>
                <th scope="row"><a href="{{ route('form',['id' => $form->id]) }}">{{ $form->id }}</a></th>
                <td><a href="{{ route('form',['id' => $form->id]) }}">{{ $form->name }}</a></td>
                <td><a href="{{ route('form::answers',['id' => $form->id]) }}">Answers</a></td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>

jQuery(function($) {  
    $('#fb-result').formRender({
        dataType: 'json',
        formData: '{!! $form->fields !!}',
    });
});  
</script>
@endsection


