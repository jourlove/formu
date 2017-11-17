@extends('layouts.app')

@section('title', 'Form')

@section('content')
<div class="container">
  <h1>RESULT</h1>
  <div class="alert alert-danger" role="alert">
    {{  $result }}
  </div>
  {!! $result !!}
</div>
@endsection


