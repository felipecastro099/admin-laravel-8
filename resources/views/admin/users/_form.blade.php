<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            {!! Form::label('name', 'Nome', ['class' => "form-label", 'for' => 'name']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null)]) !!}
            @error('name')
            <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            {!! Form::label('email', 'Email', ['class' => "form-label", 'for' => 'email']) !!}
            {!! Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : null)]) !!}
            @error('email')
            <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            {!! Form::label('phone', 'Telefone', ['class' => "form-label", 'for' => 'phone']) !!}
            {!! Form::text('phone', old('phone'), ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : null)]) !!}
            @error('phone')
            <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="avatar" class="form-label">Foto</label>
            <input class="form-control" type="file" id="avatar" name="avatar">
        </div>
    </div>
</div>

