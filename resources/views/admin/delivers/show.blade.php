@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Deliver {{ $deliver->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/delivers') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/delivers/' . $deliver->id . '/edit') }}" title="Edit Deliver"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/delivers', $deliver->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Deliver',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $deliver->id }}</td>
                                    </tr>
                                    <tr><th> Code </th><td> {{ $deliver->code }} </td></tr>
                                    <tr><th> Weight </th><td> {{ $deliver->weight }} </td></tr>
                                    <tr><th> Price </th><td> {{ $deliver->price }} </td></tr>
                                    <tr><th> Status </th><td> {{ $deliver->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>JAN</th><th>Name</th><th>Price</th>
                                    </tr>
                                </thead>                            
                                <tbody>
                                    @foreach($deliver->products as $product)
                                    <tr><td>{{$product->jan}}</td><td>{{$product->name}}</td><td>{{$product->pivot->price}}</td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
