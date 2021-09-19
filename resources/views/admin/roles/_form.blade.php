<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {!! Form::label('details', 'Grupo', ['class' => "form-label", 'for' => 'details']) !!}
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


<h4 class="card-title mt-4">Atribuir a permissão</h4>

<div class="row">
    <div class="col-md-6 mt-4">
        @foreach($permissions as $permission)
            @can($permission->name)
                <div class="form-check mb-3">
                    {!! Form::checkbox('permissions[]', $permission->name, isset($result) ? $result->hasPermissionTo($permission->name) : false, ['id' => $permission->name, 'class' => 'form-check-input']) !!}
                    {!! Form::label($permission->name, $permission->details, ['class' => 'form-check-label' . ($errors->has('permissions') ? ' is-invalid' : null), 'for' => $permission->name]) !!}
                    @error('permissions')
                    <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            @endcan
        @endforeach
    </div>
</div>

