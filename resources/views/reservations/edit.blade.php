<x-layout>
    <div class="container">
        <form action="{{ route('reservation.store')}}" method="post" >
            @method('PUT')
            @csrf
            

            <div class="mb-3 row">
                <label for="image" class="col-4 col-form-label">Reservar até</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="image" id="date" placeholder="" value="{{old('image')}}">
                </div>
            </div>

            
           
            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">Reservar</button>
                </div>
            </div>
        </form>
    </div>
</x-layout>