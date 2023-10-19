<x-layout>
    {{-- <div class="mb-3 row"> <b>Editar</b> {{ $book->title}}</div> --}}
    <div class="container">
        <form action="{{ route('book-update', $book->id) }}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <div class="mb-3 row">
                <label for="title" class="col-4 col-form-label">Título</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Título" value="{{  $book->title  }}">
                </div>
            </div>
            @error("title")
            <p style="color:crimson">
                {{$message}}
        </p>
            @enderror

            <div class="mb-3 row">
                <label for="image" class="col-4 col-form-label">Upload de Arquivo</label>
                <div class="col-md-6 col-xl-4 mt-5 mb-5">
                    <img width="200px" height="300" src="{{ $book->image ? Storage::disk('s3')->url($book->image) : 'https://via.placeholder.com/200x300' }}" alt="">
                    <div class="col-8">
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
            </div>
                @error("image")
                <p style="color:crimson">
                    {{$message}}
                </p>



            @enderror
            </div>

            <div class="mb-3 row">
                <label for="author" class="col-4 col-form-label">Selecionar Autores/Usuários</label>
                <div class="col-8">
                    <select class="form-control"
                    name="books_id" required multiple>

                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                                {{$book->reservations->where('user_id', $user->id)->count()==1 ? 'selected': '' }}
                            >
                                {{ $user->name }}
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
>


            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </div>
        </form>
    </div>
</x-layout>
