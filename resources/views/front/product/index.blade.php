@extends('layouts.app')

@section('title', 'Form')

@section('content')

<div class="container">

    <div class="row text-center">
        @foreach($products as $product)
            <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                @if(count($product->attachments)>0)        
                <img class="img-thumbnail" style="width: 200px; height: 200px;" alt="200x200" src="{{ $product->attachments->get(0)->url }}" data-src="holder.js/200x200" data-holder-rendered="true">
                @endif
                <div class="card-body">
                <h4 class="card-title">{{ $product->name }}</h4>
                <p class="card-text">{{ $product->description }}</p>
                </div>
                <div class="card-footer">
                <a href="{{ route('product::show',['id'=>$product->id])}}" class="btn btn-primary">More</a>
                </div>
            </div>
            </div>

        @endforeach
    </div>
</div>

@endsection

@section('javascript')
<script>

</script>
@endsection


