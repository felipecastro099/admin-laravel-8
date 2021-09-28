@extends('admin.layouts.app')
@section('content')
    <section>
        {!! Form::open(['route' => ['admin.users.store'], 'class' => 'form', 'files' => true]) !!}
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Novo Usuário</h4>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.index') }}"
                           class="btn btn-danger chat-send w-md waves-effect waves-light"><span
                                class="d-none d-sm-inline-block me-2">Voltar</span> <i
                                class="mdi mdi-backspace"></i></a>
                        @can('add_users')
                            <button type="submit" href="{{ route('admin.users.store') }}"
                                    class="btn btn-success chat-send w-md waves-effect waves-light"><span
                                    class="d-none d-sm-inline-block me-2">Salvar</span> <i
                                    class="mdi mdi-content-save"></i>
                            </button>
                        @endcan
                    </div>
                </div>

                <div class="mt-4">
                    @include('admin.users._form')
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
