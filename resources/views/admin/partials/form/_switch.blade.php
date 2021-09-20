<div class="form-check form-switch form-switch-md mb-3 mt-3" dir="ltr">
    {!! Form::hidden($name, 0) !!}
    {!! Form::label($name, $label, ['class' => 'form-check-label']) !!}
    {!! Form::checkbox($name, true, $value, array_merge(['class' => 'form-check-input', 'id' => $name], $attributes)) !!}
</div>
