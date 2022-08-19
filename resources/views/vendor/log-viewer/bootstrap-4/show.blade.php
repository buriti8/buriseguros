<?php
/**
 * @var  Arcanedev\LogViewer\Entities\Log            $log
 * @var  Illuminate\Pagination\LengthAwarePaginator  $entries
 * @var  string|null                                 $query
 */
?>

@extends('log-viewer::bootstrap-4._master')

@section('content')
<div class="page-header mb-4">
    <h1>Log [{{ $log->date }}]</h1>
</div>

<div class="row">
    <div class="col-lg-2">
        {{-- Log Menu --}}
        <div class="card mb-4">
            <div class="card-header"><i class="fa fa-fw fa-flag"></i> Niveles</div>
            <div class="list-group list-group-flush log-menu">
                @foreach($log->menu() as $levelKey => $item)
                @if ($item['count'] === 0)
                <a
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                    <span class="level-name">{!! $item['icon'] !!} {{ $item['name'] }}</span>
                    <span class="badge empty">{{ $item['count'] }}</span>
                </a>
                @else
                <a href="{{ $item['url'] }}"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center level-{{ $levelKey }}{{ $level === $levelKey ? ' active' : ''}}">
                    <span class="level-name">{!! $item['icon'] !!} {{ $item['name'] }}</span>
                    <span class="badge badge-level-{{ $levelKey }}">{{ $item['count'] }}</span>
                </a>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-10">
        {{-- Log Details --}}
        <div class="card mb-4">
            <div class="card-header">
                Información de registro:
                <div class="group-btns pull-right">
                    <a href="{{ route('log-viewer::logs.download', [$log->date]) }}" class="btn btn-sm btn-success">
                        <i class="fa fa-download"></i> Descargar
                    </a>
                    @if ($log->date != Carbon\Carbon::now()->toDateString())
                    <a href="#delete-log-modal" class="btn btn-sm btn-danger" data-toggle="modal">
                        <i class="fa fa-trash-o"></i> Eliminar
                    </a>
                    @endif
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-condensed mb-0">
                    <tbody>
                        <tr>
                            <td>Ruta de archivo:</td>
                            <td colspan="7">{{ $log->getPath() }}</td>
                        </tr>
                        <tr>
                            <td>Entradas de registro: </td>
                            <td>
                                <span class="badge badge-primary">{{ $entries->total() }}</span>
                            </td>
                            <td>Tamaño:</td>
                            <td>
                                <span class="badge badge-primary">{{ $log->size() }}</span>
                            </td>
                            <td>Fecha de creación:</td>
                            <td>
                                <span class="badge badge-primary">{{ $log->createdAt() }}</span>
                            </td>
                            <td>Fecha de actualización:</td>
                            <td>
                                <span class="badge badge-primary">{{ $log->updatedAt() }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{-- Search --}}
                <form action="{{ route('log-viewer::logs.search', [$log->date, $level]) }}" method="GET">
                    <div class=form-group">
                        <div class="input-group">
                            <input id="query" name="query" class="form-control" value="{!! $query !!}"
                                placeholder="Escriba aquí para buscar">
                            <div class="input-group-append">
                                @unless (is_null($query))
                                <a href="{{ route('log-viewer::logs.show', [$log->date]) }}" class="btn btn-secondary">
                                    ({{ $entries->count() }} results) <i class="fa fa-fw fa-times"></i>
                                </a>
                                @endunless
                                <button id="search-btn" class="btn btn-primary">
                                    <span class="fa fa-fw fa-search"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Log Entries --}}
        <div class="card mb-4">
            @if ($entries->hasPages())
            <div class="card-header">
                <span class="badge badge-info float-right">
                    Página {{ $entries->currentPage() }} de {{ $entries->lastPage() }}
                </span>
            </div>
            @endif

            <div class="table-responsive">
                <table id="entries" class="table mb-0">
                    <thead class="thead-gray">
                        <tr>
                            <th>Contexto</th>
                            <th style="width: 120px;">Nivel</th>
                            <th style="width: 65px;">Fecha</th>
                            <th>Contenido</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entries as $key => $entry)
                        <?php /** @var  Arcanedev\LogViewer\Entities\LogEntry  $entry */ ?>
                        <tr>
                            <td>
                                <span class="badge badge-env">{{ $entry->env }}</span>
                            </td>
                            <td>
                                <span class="badge badge-level-{{ $entry->level }}">
                                    {!! $entry->level() !!}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-secondary">
                                    {{ $entry->datetime->format('H:i:s') }}
                                </span>
                            </td>
                            <td>
                                {{ $entry->header }}
                            </td>
                            <td class="text-right">
                                @if ($entry->hasStack())
                                <a class="btn btn-sm btn-light" role="button" data-toggle="collapse"
                                    href="#log-stack-{{ $key }}" aria-expanded="false"
                                    aria-controls="log-stack-{{ $key }}">
                                    <i class="fa fa-toggle-on"></i> Desplegar
                                </a>
                                @endif
                            </td>
                        </tr>
                        @if ($entry->hasStack())
                        <tr>
                            <td colspan="5" class="stack py-0">
                                <div class="stack-content collapse" id="log-stack-{{ $key }}">
                                    {!! $entry->stack() !!}
                                </div>
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <span class="badge badge-secondary">{{ trans('log-viewer::general.empty-logs') }}</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {!! $entries->render() !!}
    </div>
</div>
@endsection

@section('modals')
{{-- DELETE MODAL --}}
<div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="date" value="{{ $log->date }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar archivo de Log</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Está seguro de que desea <span class="badge badge-danger">Eliminar</span> este archivo de Log
                        <span class="badge badge-primary">{{ $log->date }}</span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">Eliminar
                        archivo</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.replace("{{ route('log-viewer::logs.list') }}");
                        }
                        else {
                            alert('OOPS ! This is a lack of coffee exception !')
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            
        });
</script>
@endsection