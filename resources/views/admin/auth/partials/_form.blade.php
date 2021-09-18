{!! Form::open(['route' => ['admin.auth.login'], 'class' => 'form-horizontal']) !!}
<div class="mb-3">
    {!! Form::label('email', 'Email', ['class' => "form-label"]) !!}
    {!! Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : null), 'placeholder' => 'Seu email']) !!}
    @error('email')
    <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
    @enderror
</div>

<div class="mb-3">
    {!! Form::label('password', 'Password', ['class' => "form-label"]) !!}
    <div class="input-group auth-pass-inputgroup {{ $errors->has('password') ? ' is-invalid' : null }}">
        {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : null), 'placeholder' => 'Sua senha']) !!}
        <button class="btn btn-light " type="button" id="password-addon"><i
                class="mdi mdi-eye-outline"></i></button>
    @error('password')
    <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
    @enderror
    </div>
</div>

<div class="mt-3 d-grid">
    <button class="btn btn-primary waves-effect waves-light" type="submit">Log
        In
    </button>
</div>

<div class="mt-4 text-center">
    @if (Route::has('admin.auth.forgot'))
        <a href="{{ route('admin.auth.forgot') }}" class="text-muted"><i
                class="mdi mdi-lock me-1"></i> Esqueceu a senha?</a>
    @endif

</div>
{!! Form::close() !!}
