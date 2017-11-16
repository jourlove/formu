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
            @if (count($analysers))
            <form class="form-horizontal" method="post" action="{{ route('admin::form::analyzer:save') }}">
                {{ csrf_field() }}
                <input type="hidden" name="form_id" value="{{ $form_id }}">
                <div class="form-group">
                    <label for="route" class="col-md-4 control-label">Analyzer</label>
                    <div class="col-md-6">
                        <select name="analyzer" class="form-control" id="analyzer">
                            @foreach ($analysers as $key=>$analyzer) 
                            <option value="{{$key}}" data="{{ json_encode($analyzer) }}">{{$key}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <h4 class="text-center">Form Fields Relation:</h4>
                @foreach ($formColumns as $key=>$col) 
                <div class="form-group">
                  <label for="{{$key}}" class="col-md-4 control-label">{{$col}}({{$key}})</label>
                  <div class="col-md-6">
                      <select name="{{$key}}" class="form-control inputselect" id="analyzer-{{$key}}"></select>
                  </div>
                </div>
                @endforeach
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
    $('.inputselect').each(function() {
      $(this).find('option').remove();
      $ops = $('#analyzer').find(":selected").attr('data');
      $ops_arr = JSON.parse($ops);
      $sel = $(this);
      $.each($ops_arr, function( index, value ) {
        $sel.append('<option value='+value+'>'+value+'</option>');
      });      
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


