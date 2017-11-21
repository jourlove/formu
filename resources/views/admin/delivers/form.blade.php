<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', 'Code', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('code', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('weight') ? 'has-error' : ''}}">
    {!! Form::label('weight', 'Weight', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('weight', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('weight', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('status', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<hr>
<div class="form-group table-fields">
    <div class="entry col-md-10 col-md-offset-2 form-inline">
        <label>JAN：</label>
        <input class="form-control" name="jans[]" type="text" placeholder="JAN" required="true">
        <label>NAME：</label>
        <input class="form-control" name="names[]" type="text" placeholder="Name" required="true">
        <label>AMOUNT：</label>
        <select name="amount[]" class="form-control">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>

        <button class="btn btn-success btn-add inline" type="button">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        <br>
    </div>
</div>
<br>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
