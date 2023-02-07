@props(['reservation'])
<div class="col-md-6 col-xl-4 mt-2 mb-2">
<a href={{ route('reservation.edit', $reservation->id) }} style="text-decoration: none; color:black">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top"  
        src="{{ $reservation->book->image ? $reservation->book->image : 'https://via.placeholder.com/200x300' }}" alt="">
        <div class="card-body">
            <h5 class="card-title">
                 {{ $reservation->book->title }}
            </h5>
            <p class="card-body">
                {{ $reservation->book->author }}
            </p>
            <p class="card-body">
                Reservado por:  <a href="{{ route('users.edit', $reservation->user->id) }}" target="_blank" rel="noopener noreferrer">{{ $reservation->user->name }}</a> 
            </p>
            @auth
            @if (auth()->user()->isAdmin() || $reservation->book->user_id == auth()->user()->id)
            <a href="{{ route('book-edit', $reservation->book->id) }}"  class="btn btn-primary">Editar Livro</a>
            <form action="{{ route('book-destroy', $reservation->book->id) }}" method="post" class="mt-4">
                @csrf
                @method('DELETE')
                
        
                <button class="btn btn-outline-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
        </svg>
                    Excluir Livro
                  </button>
                </form>

                

            @endif
            @if ($reservation->book->reserved())
                <x-unreserve  :book="$reservation->book"/>
                @endif
            @endauth
                    <a href="{{ route('book-show', $reservation->book->id ) }}">
                        <button class="btn btn-outline-primary mt-3">
                         
                            Ver Livro
                          </button>
                    </a>

        </div>

     </div>
    </a>
</div>