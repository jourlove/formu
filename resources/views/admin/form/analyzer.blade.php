@extends('layouts.backend')

@section('title', '{{ __("admin.analyzer.name") }}')

@section('content')
<div class="container">
  <div class="row">
      @include('admin.sidebar')
      <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">{{ __("admin.analyzer.name") }}</div>
            <div class="panel-body">
            <a title="Back" href="{{route('admin::forms')}}"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            @if (count($analyzers))
            <form class="form-horizontal" method="post" action="{{ route('admin::form::analyzer:save') }}">
                {{ csrf_field() }}
                <input type="hidden" name="form_id" value="{{ $form_id }}">
                <div class="form-group">
                    <label for="route" class="col-md-4 control-label">Analyzer</label>
                    <div class="col-md-6">
                        <select name="analyzer" class="form-control" id="analyzer">
                            @foreach ($analyzers as $key=>$analyzer) 
                            <option value="{{$key}}" data="{{ json_encode($analyzer) }}">{{$key}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <h4 class="text-center">Form Fields Relation:</h4>
                <div id="prop_option_map">

                </div>
              <p class="help text-center">Form field match analyzer paramter</p>
              <br>
              <div class="form-group">
                  <div class="col-md-offset-4 col-md-4">
                      <button type="submit" class="btn btn-primary">{{ __('admin.com.action.save') }}</button>
                  </div>
              </div>

            </form>
            @else
            <br/>
            <br/>
            <div class="alert alert-danger" role="alert">
              {{ __('admin.com.msg.unavailable') }}
            </div>            
            @endif
            </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script>

  function setSelect($ops)
  {
    $temp  = '<div class="form-group">';
    $temp += '  <label for="KEY" class="col-md-4 control-label">KEY</label>';
    $temp += '  <div class="col-md-6">';
    $temp += '    <select name="KEY" class="form-control inputselect" id="analyzer-KEY">';
    @foreach ($formColumns as $key=>$col) 
    $temp += '      <option value={{$key}}>{{$col}}</option>';
    @endforeach
    $temp += '    </select>';
    $temp += '  </div>';
    $temp += '</div>';
    $('#prop_option_map').find(".form-group").remove();
    $ops = $('#analyzer').find(":selected").attr('data');
    $ops_arr = JSON.parse($ops);
    $.each($ops_arr, function( index, value ) {
      $('#prop_option_map').append($temp.replace(/KEY/g,value));
    });      
  }

  $('#analyzer').on('change', function() {
    setSelect();
  });

  $(function($) {
    setSelect();
  });    

</script>
@endsection


