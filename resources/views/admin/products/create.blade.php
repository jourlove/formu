@extends('layouts.backend')

@section('css')
    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Product</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/products') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/products', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin.products.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script>
    $(function($) {  
    }); 
</script>
@endsection
