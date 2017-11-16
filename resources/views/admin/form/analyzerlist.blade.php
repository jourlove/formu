@extends('layouts.backend')

@section('title', '{{ __("admin.analyzer.list") }}')

@section('content')
<div class="container">
  <div class="row">
      @include('admin.sidebar')
      <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">{{ __('admin.analyzer.list') }}</div>
            <div class="panel-body">
            <a title="Back" href="{{route('admin::forms')}}"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>            
              <a href="{{ route('admin::form::analyzer',['id'=>$form->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('admin.com.action.add')}}</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($form->analyzers as $analyzer)
                  <tr>
                    <th scope="row">#{{ $analyzer->id }}</a></th>
                    <td>{{ $analyzer->analyzer }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/app.js') }}"></script>
@endsection


