@extends('admin.layouts.app')
@section('content')
    <section>
        {!! Form::model($result, ['method' => 'PUT', 'route' => ['admin.settings.update',  'id' => $result->id], 'class' => 'form -default']) !!}
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Editar Configuração</h4>
                    </div>
                    <div>
                        <a href="{{ route('admin.settings.index') }}"
                           class="btn btn-danger chat-send w-md waves-effect waves-light"><span
                                class="d-none d-sm-inline-block me-2">Voltar</span> <i
                                class="mdi mdi-backspace"></i></a>
                        @can('add_settings')
                            <button type="submit" href="{{ route('admin.settings.store') }}"
                                    class="btn btn-success chat-send w-md waves-effect waves-light"><span
                                    class="d-none d-sm-inline-block me-2">Salvar</span> <i
                                    class="mdi mdi-content-save"></i>
                            </button>
                        @endcan
                    </div>
                </div>

                <div class="form-check form-switch form-switch-md mb-3 mt-3" dir="ltr">
                    <label class="form-check-label">Ativo?</label>
                    {{ Form::checkbox('active', null, null, ['class' => 'form-check-input']) }}
                </div>

                <div class="mt-4">
                    @include('admin.settings._form')
                </div>

            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
