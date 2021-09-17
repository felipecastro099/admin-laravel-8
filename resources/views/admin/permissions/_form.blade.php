<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {!! Form::label('details', 'Permissão', ['class' => "form-label", 'for' => 'details']) !!}
            {!! Form::text('details', old('details'), ['class' => 'form-control' . ($errors->has('details') ? ' is-invalid' : null)]) !!}
            @error('details')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {!! Form::label('name', 'Chave', ['class' => 'form-label']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null)]) !!}
            @error('name')
            <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>


<h4 class="card-title mt-4">Atribuir a grupo</h4>

<div class="mt-4">
    @foreach($roles as $role)
        <div class="form-check mb-3">
            {!! Form::checkbox('roles[]', $role->name, isset($result) ? $role->hasPermissionTo($result->name) : false, ['id' => $role->name, 'class' => 'form-check-input']) !!}
            {!! Form::label($role->name, $role->details, ['class' => 'form-check-label' . ($errors->has('roles') ? ' is-invalid' : null), 'for' => $role->name]) !!}
            @error('roles')
            <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endforeach
</div>

