@extends('admin.layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title">Configurações</h4>
                    <p class="card-title-desc">Total: {{ $results->total() }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.dashboard.index') }}"
                       class="btn btn-danger chat-send w-md waves-effect waves-light"><span
                            class="d-none d-sm-inline-block me-2">Voltar</span> <i class="mdi mdi-backspace"></i></a>
                    @can('add_settings')
                        <a href="{{ route('admin.settings.create') }}"
                           class="btn btn-success chat-send w-md waves-effect waves-light"><span
                                class="d-none d-sm-inline-block me-2">Adicionar</span> <i class="mdi mdi-plus-box"></i></a>
                    @endcan
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped mb-0">

                    <thead>
                    <tr>
                        <th>Configuração</th>
                        <th>Chave</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result->title }}</td>
                            <td>{{ $result->key }}</td>
                            <td>{{ $result->value }}</td>
                            <td>{!! isActive($result->active) !!}</td>
                            <td style="width: 90px;">
                                <div>
                                    <ul class="list-inline mb-0 font-size-16">
                                        @can('edit_settings')
                                            <li class="list-inline-item">
                                                <a href="{{ route('admin.settings.edit', ['id' => $result->id]) }}"><i
                                                        class="bx bxs-edit-alt"></i></a>
                                            </li>
                                        @endcan
                                        @can('delete_settings')
                                                <li class="list-inline-item">
                                                    <a href="{{ route('admin.settings.destroy', ['id' => $result->id]) }}"
                                                       data-target="#result-{{ $result->id }}"
                                                       class="delete-data"
                                                       title="Deseja excluir a configuração {{ $result->title }}?">
                                                        <i class="bx bxs-trash"></i>
                                                    </a>
                                                </li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{ $results->render('admin.partials._pagination') }}
@endsection
