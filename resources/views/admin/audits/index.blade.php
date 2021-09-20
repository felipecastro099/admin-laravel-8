@extends('admin.layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title">Auditorias</h4>
                    <p class="card-title-desc">Total: {{ $results->total() }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.dashboard.index') }}"
                       class="btn btn-danger chat-send w-md waves-effect waves-light"><span
                            class="d-none d-sm-inline-block me-2">Voltar</span> <i class="mdi mdi-backspace"></i></a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped mb-0">

                    <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Tipo</th>
                        <th>Ação</th>
                        <th>Horário</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result->user->name }}</td>
                            <td>{{ $result->type_name }}</td>
                            <td>{{ $result->action_name }}</td>
                            <td>{{ $result->created_at->format('d/m/Y H:i') }}</td>
                            <td style="width: 90px;">
                                <div>
                                    <ul class="list-inline mb-0 font-size-16">
                                        @can('view_settings')
                                            <li class="list-inline-item">
                                                <a href="{{ route('admin.settings.show', ['id' => $result->id]) }}"><i
                                                        class="bx bx-show-alt"></i></a>
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
