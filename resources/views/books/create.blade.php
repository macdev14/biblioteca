<x-layout>

        <form action="{{ route('book-store')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="mb-3 row">
                <label for="title" class="col-4 col-form-label">Título</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Título" value="{{old('title')}}">
                </div>
            </div>
            @error("title")
            <p style="color:crimson">
                {{$message}}
        </p>
            @enderror

            <div class="mb-3 row">
                <label for="image" class="col-4 col-form-label">Upload da Publicação</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                @error("image")
                <p style="color: crimson">
                    {{ $message }}
                </p>
                @enderror
            </div>




            <div class="mb-3 row">
                <label for="author" class="col-4 col-form-label">Selecionar Autores/Usuários</label>
                <div class="col-8">
                    <select class="form-control"
                    name="books_id" required multiple>

                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                                {{ $user->name.' - '.$user->email }}
                        </option>
                    @endforeach
                </select>
                </div>
                @error("reservations")
                <p style="color:crimson">
                    {{$message}}
                </p>
            @enderror
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>

</x-layout>
