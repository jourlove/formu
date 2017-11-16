@extends('layouts.backend')

@section('title', __('admin.form.new'))

@section('content')
<div class="container">
  <div class="row">
      @include('admin.sidebar')
      <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">{{ __('admin.com.action.add') }}</div>
            <div class="panel-body">
                <form>
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">{{__('admin.form.column.name') }}</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="{{__('admin.form.column.name') }}">
                    </div>
                </div>
                </form>
                <div id="fb-editor"></div>
            </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/form-builder.min.js') }}"></script>
<script>
$(function($) {
    var options = {
        i18n: {
            locale: 'en-US'
        },
        disabledActionButtons: ['data'],
        onSave: function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });            
            $.ajax({
                url: '{{ route("admin::form::save") }}', 
                type: 'POST',
                data: {formStructure: JSON.stringify( fb.actions.getData('json') ),formName: $('#inputName').val()},
                dataType: 'json',
                success: function( response ){
                    alert(response['msg']);
                    window.location="{{ route('admin::forms') }}";
                },
                error: function( jqXHR ){
                    console.log( 'Error saving the form (details below)' );
                    console.log( jqXHR );
                }

            });
        },              
    };         
    var fb = $(document.getElementById('fb-editor')).formBuilder(options);
});    
</script>
@endsection


