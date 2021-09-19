@extends('admin.layouts.app')

@section('css')

    {!! Html::style('/admin/libs/sweetalert2/sweetalert2.min.css') !!}

@endsection

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title">Permissões</h4>
                    <p class="card-title-desc">Total: {{ $results->total() }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.dashboard.index') }}"
                       class="btn btn-danger chat-send w-md waves-effect waves-light"><span
                            class="d-none d-sm-inline-block me-2">Voltar</span> <i class="mdi mdi-backspace"></i></a>
                    @can('add_permissions')
                        <a href="{{ route('admin.permissions.create') }}"
                           class="btn btn-success chat-send w-md waves-effect waves-light"><span
                                class="d-none d-sm-inline-block me-2">Adicionar</span> <i class="mdi mdi-plus-box"></i></a>
                    @endcan
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped mb-0" id="users-table">

                    <thead>
                    <tr>
                        <th>Permissão</th>
                        <th>Chave</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results as $result)
                        <tr id="result-{{ $result->id }}">
                            <td>{{ $result->details }}</td>
                            <td>{{ $result->name }}</td>
                            <td style="width: 90px;">
                                <div>
                                    <ul class="list-inline mb-0 font-size-16">
                                        @can('edit_permissions')
                                            <li class="list-inline-item">
                                                <a href="{{ route('admin.permissions.edit', ['id' => $result->id]) }}"><i
                                                        class="bx bxs-edit-alt"></i></a>
                                            </li>
                                        @endcan
                                        @can('delete_permissions')
                                            <li class="list-inline-item">
                                                <a href="{{ route('admin.permissions.destroy', ['id' => $result->id]) }}"
                                                   data-target="#result-{{ $result->id }}"
                                                   class="delete-data"
                                                   title="{{ $result->details }}">
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

@section('script')

    <script>

        $('.delete-data').click(function (event){
            event.preventDefault();

            var me = $(this),
                url = me.attr('href'),
                title = me.attr('title'),
                csrf_token = $('meta[name="csrf-token"]').attr('content');
                id = me.attr('data-target')

            Swal.fire({
                title: 'Tem certeza que deseja excluir ?',
                text: 'Isso não poderá ser reverdito!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if(result.value) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_method': 'DELETE',
                            '_token': csrf_token
                        },
                        success: function (response) {

                            if (response.success === true) {
                                Swal.fire("Done!", response.message, "success");

                                $(id).fadeOut(1000);
                                setTimeout(function(){
                                    $(id).remove()
                                }, 1000);

                            } else {
                                Swal.fire("Error!", response.message, "error");
                            }
                        },
                        error: function (response) {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops..',
                                text: 'Erro ao excluir',
                            });
                        }
                    });
                }
            });
        });

    </script>

@endsection
