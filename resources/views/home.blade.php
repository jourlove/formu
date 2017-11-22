@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <a href="{{ route('forms') }}" class="btn btn-success">Forms</a>
            <a href="{{ route('products') }}" class="btn btn-success">Products</a>
        </div>
    </div>
</div>
@endsection
