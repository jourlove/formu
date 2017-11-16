@extends('layouts.forms')

@section('title', 'Form Answers')

@section('content')
<div class="row">
    <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Date</th>
              @foreach ($formColumns as $col)
              <th scope="col">{{ $col }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($form->answers as $answer)
            <tr>
              <th scope="row">{{ $answer->created_at }}</a></th>
              @foreach ($formColumns as $key=>$col)
              <td>{{ json_decode($answer->answer)->$key }}</td>
              @endforeach
            </tr>
            @endforeach
            </tbody>
        </table>
      </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/app.js') }}"></script>
@endsection


