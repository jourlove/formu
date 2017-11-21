@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Product {{ $product->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/products') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/products/' . $product->id . '/edit') }}" title="Edit Product"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/products', $product->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Product',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $product->id }}</td>
                                    </tr>
                                    <tr><th> Category</th><td> {{ $product->category->fullName }} </td></tr>
                                    <tr><th> JAN </th><td> {{ $product->jan }} </td></tr>
                                    <tr><th> Name </th><td> {{ $product->name }} </td></tr>
                                    <tr><th> Description </th><td> {{ $product->description }} </td></tr>
                                    <tr>
                                        <th> Images </th>
                                        <td>
                                            @foreach($product->attachments as $image)
                                            <img src="{{$image->url}}">
                                            @endforeach                                           
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
