@extends('layouts.forms')

@section('title', 'Form')

@section('content')
<h1>RESULT</h1>
<div class="alert alert-danger" role="alert">
  {{ $result }}
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/app.js') }}"></script>
@endsection


