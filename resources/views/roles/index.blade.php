<x-layout>
    <h1 class="mb-3"></h1>

    <div class="bg-light p-4 rounded">
        <h1>Tipos de Usuário</h1>
        <div class="lead">
           <p> Gerencie os tipos de usuário aqui. </p>
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right mb-3">Add Tipo</a>
            <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right mb-3">Add Permissão</a>
        </div>
        
       

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>Nome</th>
             <th width="3%" colspan="3">Ação</th>
          </tr>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Ver</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Editar</a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </table>

        <div class="d-flex">
            {!! $roles->links() !!}
        </div>

    </div>
</x-layout>