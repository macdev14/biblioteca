
<x-layout>

    <div class="row justify-content-center align-items-center g-2">
        <h2 class="">Livro(s) Reservado por Usuários</h2>
    </div>

    <div class="row justify-content-center align-items-center g-2">
        <a href="{{ route('reservation.create')}}">
            <button class="btn btn-success">
                 Criar Reserva
            </button>
           
        </a>
    </div>
    
    <div class="row align-items-center mt-5">
    @foreach($reservations as $reservation)
    
       
          <x-reserve-bookcard :reservation="$reservation"/>
    
    
        
        
    
    @endforeach 
    </div>
    <div class="row mt-2">
    
    
    
    </div>
    </x-layout>
    