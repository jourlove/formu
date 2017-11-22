<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', 'Code', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-3">
        {!! Form::text('code', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<hr>
<div class="form-group table-fields">
<p class="help col-md-10 col-md-offset-2">Add Products.</p>
@if(isset($deliver))
    @foreach($deliver->products as $key=>$product)
    <div class="entry col-md-10 col-md-offset-2 form-inline">
        <input class="form-control jan" name="jans[]" type="text" placeholder="JAN" required="true" onblur="setName(this)" value="{{$product->jan}}">
        <input class="form-control name" name="names[]" type="text" placeholder="Name" required="true" value="{{$product->name}}">
        <input class="form-control price" name="prices[]" type="number" placeholder="Price" required="true" value="{{$product->pivot->price}}">
        <input class="form-control pid" name="pid[]" type="hidden" placeholder="Name" required="true" value="{{$product->id}}">        
        @if($key==count($deliver->products)-1)
        <button class="btn btn-success btn-add inline" type="button">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        @else
        <button class="btn btn-danger btn-remove inline" type="button">
            <span class="glyphicon glyphicon-minus"></span>
        </button>
        @endif
        <br>
    </div>    
    @endforeach
@else
    <div class="entry col-md-10 col-md-offset-2 form-inline">

        <input class="form-control jan" name="jans[]" type="text" placeholder="JAN" required="true" onblur="setName(this)">
        <input class="form-control name" name="names[]" type="text" placeholder="Name" required="true">
        <input class="form-control price" name="prices[]" type="number" placeholder="Price" required="true">
        <input class="form-control pid" name="pid[]" type="hidden" placeholder="Name" required="true">
        <button class="btn btn-success btn-add inline" type="button">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        <br>
    </div>
@endif
</div>
<hr>
<div class="form-group {{ $errors->has('weight') ? 'has-error' : ''}}">
    {!! Form::label('weight', 'Weight', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-3">
        {!! Form::number('weight', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('weight', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-3">
        {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
