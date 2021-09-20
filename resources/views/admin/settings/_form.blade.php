<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            {!! Form::label('title', 'Título', ['class' => "form-label", 'for' => 'title']) !!}
            {!! Form::text('title', old('title'), ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : null)]) !!}
            @error('title')
            <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            {!! Form::label('key', 'Chave', ['class' => 'form-label']) !!}
            {!! Form::text('key', old('key'), ['class' => 'form-control' . ($errors->has('key') ? ' is-invalid' : null)]) !!}
            @error('key')
            <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            {!! Form::label('value', 'Valor', ['class' => "form-label", 'for' => 'value']) !!}
            {!! Form::text('value', old('value'), ['class' => 'form-control' . ($errors->has('value') ? ' is-invalid' : null)]) !!}
            @error('value')
            <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

