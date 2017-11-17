@extends('layouts.app')

@section('title', 'Form')

@section('content')
<div class="container">
    <form action="{{ route('form::save') }}" method="post">
    {{ csrf_field() }}
    <div id="fb-result"></div>
    <input type="hidden" name="form_id" value="{{ $form->id }}">
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/form-render.min.js') }}"></script>
<script>

jQuery(function($) {  
    $('#fb-result').formRender({
        dataType: 'json',
        formData: '{!! $form->fields !!}',
    });
}); 
</script>
@endsection


