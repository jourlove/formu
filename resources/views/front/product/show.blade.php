@extends('layouts.app')

@section('title', 'Form')

@section('content')



<div class="container">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Test</a></li>
        <li class="breadcrumb-item"><a href="#">Test</a></li>
        <li class="breadcrumb-item"><a href="#">Test</a></li>
        <li class="breadcrumb-item active">{{ $product->name }}</li>
    </ol>
    <div class="col-sm-5">

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($product->attachments as $key=>$attache)
            <li data-target="#carousel-example-generic" data-slide-to="{{$key}}" class="{{ ($key==0 ? 'active' : '') }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach($product->attachments as $key=>$attache)
            <div class="item {{ ($key==0 ? 'active' : '') }}">
                <img data-src="holder.js/1140x500/auto/#777:#555/text:First slide" alt="{{$product->name}}" src="{{ $attache->url }}" data-holder-rendered="true">
            </div>
            @endforeach
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>    
    </div>    

    <div class="col-sm-7 product-detail-right">
        <h1 id="product-title">{{$product->name}}
            <span id="product-option-title">$96.39</span>
        </h1>
        <div class="product-detail-description">
            <p>{!! nl2br($product->description) !!}</p>
        </div>
        
        <div>
            <form data-request="onAddToBasket" id="form-add-to-basket">
                <input name="id" value="17" type="hidden">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to Cart</button>
            </form>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-sm-12">
            <h3>Comments</h3>
        </div>
        <div class="clearfix"></div>    
    </div>

</div>

@endsection

@section('javascript')
<script>

</script>
@endsection


