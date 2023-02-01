<x-layout>
    <div class="container">
        <form action="{{ route('book-store')}}" method="post" enctype="multipart/form-data" >
            @csrf
            

            <div class="mb-3 row">
                <label for="image" class="col-4 col-form-label">Reservar até</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="image" id="date" placeholder="" value="{{old('image')}}">
                </div>
            </div>

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