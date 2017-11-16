@extends('layouts.forms')

@section('title', 'Form')

@section('content')
<h1>RESULT</h1>
<div class="alert alert-danger" role="alert">
  高ストレスチ
</div>
<table class="table">
    <thead>
        <tr>
        <th scope="col">#KEY</th>
        <th scope="col">VALUE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($form as $key=>$field)
        <tr>
        <th scope="row">{{ $key }}</a></th>
        <td>{{ $field }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('javascript')
<script src="{{ asset('js/app.js') }}"></script>
@endsection


