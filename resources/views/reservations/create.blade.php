<x-layout>
    <div class="container">
        <form action="{{ route('reservation.store')}}" method="post" >
            @csrf
            

            <div class="mb-3">
                <label for="role" class="form-label">Usuário</label>
                <select class="form-control" 
                    name="user" required>
                    <option value="">Selecionar Usuário</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            @if ($userReserved ?? false)
                            {{ in_array($user->name, $userReserved) 
                                ? 'selected'
                                : '' }}>{{ $user->name }}
                            @else
                            {{ $user->name }}
                             @endif
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('usuario'))
                    <span class="text-danger text-left">{{ $errors->first('usuario') }}</span>
                @endif
            </div>


            <div class="mb-3">
                <label for="role" class="form-label">Livro</label>
                <select class="form-control" 
                    name="book" required>
                    <option value="">Selecionar Livro</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}">
                            @if ($userBook ?? false)
                            {{ in_array($book->title, $userBook) 
                                ? 'selected'
                                : '' }}>{{ $book->title }}
                            @else
                            {{ $book->title }}
                             @endif
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('usuario'))
                    <span class="text-danger text-left">{{ $errors->first('usuario') }}</span>
                @endif
            </div>

            
           
            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">Reservar</button>
                </div>
            </div>
        </form>
    </div>
</x-layout>