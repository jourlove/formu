@extends('layouts.app')

@section('title', 'Form Answers')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Date</th>
                @foreach ($formColumns as $col)
                <th scope="col">{{ $col }}</th>
                @endforeach
                <th scope="col">{{ __('admin.com.report') }}</th>
                <th scope="col">{{ __('admin.com.reportdata') }}</th>              
              </tr>
            </thead>
            <tbody>
              @foreach ($form->answers as $answer)
              <tr>
                <th scope="row">{{ $answer->created_at }}</a></th>
                @foreach ($formColumns as $key=>$col)
                <td>{{ json_decode($answer->answer)->$key }}</td>
                @endforeach
                <td scope="row">{{ $answer->answer_report }}</td>
                <td scope="row">{{ $answer->answer_report_data }}</td>              
              </tr>
              @endforeach
              </tbody>
          </table>
        </div>
  </div>
</div>
@endsection


