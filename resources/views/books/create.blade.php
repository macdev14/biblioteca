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
                <label for="author" class="col-4 col-form-label">Descrição</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="author" id="author" placeholder="SubTítulo" value="{{  old('author')  }}">
                </div>
            </div>
            @error("author")
            <p style="color:crimson">
                {{$message}}
        </p>
            @enderror

            <div class="mb-3 row">
                <label for="image" class="col-4 col-form-label">Upload da Thumbnail</label>
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
                <label for="file" class="col-4 col-form-label">Upload da Publicação em PDF</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="file" id="file">
                </div>
                @error("file")
                <p style="color: crimson">
                    {{ $message }}
                </p>
                @enderror
            </div>




            <div class="mb-3 row">
                <label for="authors[]" class="col-4 col-form-label">Selecionar Autores</label>
                <div class="col-8">
                    <select class="form-control"
                    name="authors[]" required multiple>

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
