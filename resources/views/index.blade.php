@extends('layouts.base')

@section('content')

<div class="row">
    <div class="col-12">
        <div>
            <h2 class="mt-4">Registros de Tareas</h2>
        </div>
        <div>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary mt-4">Crear tarea</a>
        </div>
    </div>

    @if (Session::get('success'))
    <div class="alert alert-success mt-2">
        <strong>{{ Session::get('success') }}<br>
    </div>
        
    @endif

    <div class="col-12 mt-4">
        <table class="table table-bordered text-black">
            <tr class="text" style="text-align: center;">
                <th class="bgcolor">Tarea</th>
                <th class="bgcolor">Descripción</th>
                <th class="bgcolor">Fecha</th>
                <th class="bgcolor">Estado</th>
                <th class="bgcolor">Acción</th>
            </tr>
            @foreach ( $tasks as $task )
                <tr>
                    <td class="bgtdcolor">{{ $task->title }}</td>
                    <td >{{ $task->description }}</td>
                    <td >
                        {{ $task->due_date }}
                    </td>
                    <td>
                        <span class="badge text-bg-success fs-6" style="margin-top: 5px;">{{ $task->status }}</span>
                    </td>
                    <td >
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning" style="margin-right: 20px;"  >Editar</a>

                        <form id="deleteForm-{{$task->id}}" action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" style="margin-right: -30px;"  onclick="confirmDelete({{$task->id}})">Eliminar</button>
                        </form>
                        
                        <script>
                            function confirmDelete(taskId) {
                                if (confirm('¿Estás seguro de que deseas eliminar esta tarea?')) {
                                    document.getElementById('deleteForm-' + taskId).submit();
                                }
                            }
                        </script>
                        
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $tasks->links()}} <!--paginador -->
    </div>
</div>
@endsection