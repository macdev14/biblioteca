<x-layout>
    <div class="container">

        <div class="row m-5 col-6">
            <h1>Cadastro de Usuário</h1>
        </div>

        <form action="{{route('user-store')}}" method="post" >
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col-4 col-form-label">Nome</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nome" value="{{old('name')}}">
                </div>
            </div>
            @error("title")
            <p style="color:crimson">
                {{$message}}
        </p>
            @enderror

            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{old('email')}}">
                </div>
                @error("email")
                <p style="color:crimson">
                    {{$message}}
                </p>
                   
                 
            
            @enderror
            </div>

            <div class="mb-3 row">
                <label for="password" class="col-4 col-form-label">Senha</label>
                <div class="col-8">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Senha" value="{{old('password')}}">
                </div>
                @error("password")
                <p style="color:crimson">
                    {{$message}}
                </p>
                   
                 
            
            @enderror
            </div>

            <div class="mb-3 row">
                <label for="password_confirmation" class="col-4 col-form-label">Confirmar Senha</label>
                <div class="col-8">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmar Senha" value="{{old('password_confirmation')}}">
                </div>
                @error("password_confirmation")
                <p style="color:crimson">
                    {{$message}}
                </p>
                   
                 
            
            @enderror
            </div>

          
           
            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</x-layout>