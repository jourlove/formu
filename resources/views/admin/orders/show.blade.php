@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Order {{ $order->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/orders') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/orders/' . $order->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/orders', $order->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Order',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $order->id }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $order->code }} </td></tr><tr><th> Weight </th><td> {{ $order->weight }} </td></tr><tr><th> Postage </th><td> {{ $order->postage }} </td></tr>
                                    <tr><th> Status </th><td> {{ $order->statusStr }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>JAN</th><th>Name</th><th>Price</th><th>Amount</th>
                                    </tr>
                                </thead>                            
                                <tbody>
                                    @foreach($order->products as $product)
                                    <tr><td>{{$product->jan}}</td><td><a href="{{url('admin/products',['id'=>$product->id])}}" target="_blank">{{$product->name}}</a></td>
                                    <td>{{$product->pivot->price}}</td>
                                    <td>{{$product->pivot->amount}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <a href="{{ route('admin::orders::delivering',['id'=>$order->id]) }}" class="btn btn-danger btn-sm" title="Delivering">
                            <i class="fa fa-plus" aria-hidden="true"></i> {{ __('admin.com.action.delivering')}}
                        </a>

                        <a href="{{ route('admin::orders::received',['id'=>$order->id]) }}" class="btn btn-success btn-sm" title="Received Deliver">
                            <i class="fa fa-plus" aria-hidden="true"></i> {{ __('admin.com.action.received')}}
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
