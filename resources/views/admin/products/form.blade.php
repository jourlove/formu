<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    {!! Form::label('category_id', 'Category Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('category_id', $options['categories'], null, ['class' => 'form-control', 'required' => 'required']); !!}
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('color') ? 'has-error' : ''}}">
    {!! Form::label('color', 'Color', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('color', $options['colors'], null, ['class' => 'form-control', 'required' => 'required']); !!}
        {!! $errors->first('color', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('size') ? 'has-error' : ''}}">
    {!! Form::label('size', 'Size', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('size', $options['size'], null, ['class' => 'form-control', 'required' => 'required']); !!}
        {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('suitable_age') ? 'has-error' : ''}}">
    {!! Form::label('suitable_age', 'Suitable Age', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('suitable_age', $options['age'], null, ['class' => 'form-control', 'required' => 'required']); !!}
        {!! $errors->first('suitable_age', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('suitable_gender') ? 'has-error' : ''}}">
    {!! Form::label('suitable_gender', 'Suitable Gender', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('suitable_gender', $options['gender'], null, ['class' => 'form-control', 'required' => 'required']); !!}
        {!! $errors->first('suitable_gender', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('material') ? 'has-error' : ''}}">
    {!! Form::label('material', 'Material', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('material', null, ['class' => 'form-control']) !!}
        {!! $errors->first('material', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
    {!! Form::label('images', 'Images', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('images[]', ['multiple' => 'multiple']) !!}
        {!! $errors->first('images', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
