@extends('layouts.app')

@section('title', 'Form')

@section('content')
<div class="container">
    <h2>Thumbnails</h2>
    @foreach($products as $product)
        @if(count($product->attachments)>0)        
        <img class="img-thumbnail" style="width: 200px; height: 200px;" alt="200x200" src="{{ $product->attachments->get(0)->url }}" data-src="holder.js/200x200" data-holder-rendered="true">
        @endif
    @endforeach
</div>

@endsection

@section('javascript')
<script>

</script>
@endsection


