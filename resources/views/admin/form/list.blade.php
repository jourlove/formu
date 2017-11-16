@extends('layouts.backend')

@section('title', "{{ __('admin.form.list') }}")

@section('content')
<div class="container">
  <div class="row">
      @include('admin.sidebar')
      <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">{{ __('admin.form.list') }}</div>
            <div class="panel-body">
              <a href="{{ route('admin::form::new') }}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('admin.com.action.add')}}</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Opration</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($formlist as $form)
                  <tr>
                    <th scope="row"><a href="{{ route('admin::form::update',['id' => $form->id]) }}">#{{ $form->id }}</a></th>
                    <td><a href="{{ route('admin::form::update',['id' => $form->id]) }}">{{ $form->name }}</a></td>
                    <td>
                      <a href="{{ route('admin::form::answers',['id' => $form->id]) }}">Anwsers</a> |
                      <a href="{{ route('admin::form::analyzerlist',['id' => $form->id]) }}">Analyzers</a>
                    </td>
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


