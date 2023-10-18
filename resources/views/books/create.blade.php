<x-layout>
    <div class="container">
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
    <label for="image" class="col-4 col-form-label">Image Upload</label>
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
                <label for="image" class="col-4 col-form-label">Link da imagem da Capa</label>
                <div class="col-8">
                    <input type="url" class="form-control" name="image" id="image" placeholder="https://" value="{{old('image')}}">
                </div>
                @error("image")
                <p style="color:crimson">
                    {{$message}}
                </p>



            @enderror
            </div>
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

            <div class="mb-3 row">
                <label for="author" class="col-4 col-form-label">Autor</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="author" id="author" placeholder="Autor" value="{{old('author')}}">
                </div>
                @error("author")
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
    </div>
</x-layout>
