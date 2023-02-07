
<!doctype html>
<html lang="en">

<head>
  <title>Biblioteca</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{url('/')}}">Biblioteca</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
              @auth
              
              
            
              
              @can('permissions.index')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('permissions.index') }}">Permissões</a>
               
              </li>
              @endcan
              @can('roles.index')
              <li class="nav-item">
                <a class="nav-link" href="{{route('roles.index')}}">Tipo de Usuário</a>
              </li>
              @endcan
              @can('users.index')
              <li class="nav-item">
                <a class="nav-link" href="{{route('users.index')}}">Usuários</a>
              </li>
              @endcan
              @can('reservation.manage')
              <li class="nav-item">
                <a class="nav-link" href="{{route('reservation.manage')}}">Reservas de Usuários</a>
              </li>
              @endcan
              @can('book-create')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('book-create') }}">Cadastrar Livros</a>
              </li>
              @endcan
              @can('book-manage')
              <li class="nav-item">
                <a class="nav-link" href="{{route('book-manage')}}">Meus Livros</a>
              </li>
              @endcan
              @can('reservation.index')
              <li class="nav-item">
                <a class="nav-link" href="{{route('reservation.index')}}">Minhas Reservas</a>
              </li>
              @endcan



              
              @endauth
              @guest
              <li class="nav-item">
                <a class="nav-link " href="{{ route('login') }}">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('user-create') }}">Cadastro</a>
              </li>
              @endguest
            </ul>
            @auth
            <li class="nav-item" style="list-style-type: none;">
              <a class="nav-link float-right">Olá, {{ auth()->user()->name }}</a>
            </li>
           
          
            @can('logout')
              <form method="post" action="{{ route('logout') }}" class="inline" style="margin-right:20px; margin-left:20px" >
              @csrf
              <button class="btn btn-danger" type="submit">Sair</button>
              </form>
            @endcan
         
            @endauth
            <form action="{{route('index')}}" class="d-flex" role="search" method="get">
              <input name="search" class="form-control me-2" type="search" placeholder="Buscar Livro" aria-label="Buscar">
              <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
          
          </div>
        </div>
      </nav>
  </header>
  <main>
 
    <div class="container">
      <x-flash-message/>
       {{$slot}}
      
    </div>

    
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="//unpkg.com/alpinejs" defer></script>
 


 
</body>

</html>