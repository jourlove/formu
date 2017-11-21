@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Deliver</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/delivers') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/delivers', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin.delivers.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();

                var tableFields = $('.table-fields'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(tableFields);

                newEntry.find('input').val('');
                tableFields.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="glyphicon glyphicon-minus"></span>');
            }).on('click', '.btn-remove', function(e) {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });

        });

        function setName(obj) {
            jan = $(obj).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });            
            $.ajax({
                url: '{{ url("admin/product/ajax/") }}/'+jan, 
                type: 'GET',
                success: function( response ){
                    if (response!='') {
                        product = JSON.parse(response);
                        $(obj).nextAll('.name:first').val( product.name );
                        $(obj).nextAll('.pid:first').val( product.id );
                    }
                    
                },
                error: function( jqXHR ){
                    console.log( 'Error saving the form (details below)' );
                    console.log( jqXHR );
                }

            });                        

        }
    </script>
@endsection
