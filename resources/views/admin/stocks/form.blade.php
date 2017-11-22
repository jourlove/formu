<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    {!! Form::label('product_id', 'Product Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('product_id', $options['products'], null, ['class' => 'form-control', 'required' => 'required']); !!}
        {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    {!! Form::label('amount', 'Amount', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('amount', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
