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
@if(isset($order))
    @foreach($order->products as $key=>$product)
    <div class="entry col-md-10 col-md-offset-2 form-inline">
        <select class="form-control" required="required" name="pid[]">
            @foreach($options['products'] as $pid=>$pname)
            <option value="{{$pid}}" {{ ($pid==$product->id ? 'selected="selected"' : '') }}>{{$pname}}</option>
            @endforeach
        </select>
        <input class="form-control price" name="prices[]" type="number" placeholder="Price" required="true" value="{{$product->pivot->price}}">
        <input class="form-control" name="amounts[]" type="number" placeholder="Amount" required="true" value="{{$product->pivot->amount}}">
        @if($key==count($order->products)-1)
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
        <select class="form-control" required="required" name="pid[]">
            @foreach($options['products'] as $pid=>$pname)
            <option value="{{$pid}}" >{{$pname}}</option>
            @endforeach
        </select>
        <input class="form-control" name="prices[]" type="number" placeholder="Price" required="true">
        <input class="form-control" name="amounts[]" type="number" placeholder="Amount" required="true">
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
<div class="form-group {{ $errors->has('postage') ? 'has-error' : ''}}">
{!! Form::label('postage', 'Postage', ['class' => 'col-md-2 control-label']) !!}
<div class="col-md-3">
    {!! Form::number('postage', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('postage', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

