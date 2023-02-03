<x-layout>
    <div class="container">
        <form action="{{ route('reservation.update', $reservation->id)}}" method="post" >
            @method('PUT')
            @csrf

            

            <div class="mb-3 col-xl-10">
                <label for="role" class="form-label">Usuário</label>
                <select class="form-control" 
                    name="user_id" required>
                    <option value="">Selecionar Usuário</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            {{  $user->id == $reservation->user->id
                                ? 'selected'
                                : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('usuario'))
                    <span class="text-danger text-left">{{ $errors->first('usuario') }}</span>
                @endif
            </div>


            <div class="mb-3 col-xl-10">
                <label for="role" class="form-label">Livro</label>
                <select class="form-control" 
                    name="books_id" required>
                    <option value="">Selecionar Livro</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}"
                          
                            {{  $book->id == $reservation->book->id
                                ? 'selected'
                                : '' }}>
                                {{ $book->title }}
                           
                           
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('usuario'))
                    <span class="text-danger text-left">{{ $errors->first('usuario') }}</span>
                @endif
            </div>

            
           
            <div class="mb-3 row">
                <div class="col-xl-10">
                    <button type="submit" class="btn btn-primary">Alterar Reserva</button>
                
                    <a style="float:right" href="{{ route('reservation.destroy', $reservation->id )}}">
                    <button  class="btn btn-danger">Excluir</button>
                </a>
                </div>
            </div>
        </form>
    </div>
</x-layout>