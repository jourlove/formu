@extends('layouts.backend')

@section('title', 'Forms')

@section('content')
<div class="container">
  <div class="row">
      @include('admin.sidebar')
      <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">Froms</div>
            <div class="panel-body">
              <a title="Back" href="{{route('admin::forms')}}"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#ID</th>
                    @foreach ($formColumns as $col)
                    <th scope="col">{{ $col }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach ($form->answers as $answer)
                  <tr>
                    <th scope="row">#{{ $answer->id }}</a></th>
                    @foreach ($formColumns as $key=>$col)
                    <td>{{ json_decode($answer->answer)->$key }}</td>
                    @endforeach
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


