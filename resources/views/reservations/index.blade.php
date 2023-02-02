
<x-layout>

    <div class="row justify-content-center align-items-center g-2">
        <h2 class="">Livro(s) Reservado</h2>
    </div>
    
    <div class="row align-items-center mt-5">
    @foreach($reservations as $reservation)
    
       
          <x-bookcard :book="$reservation->book"/>
    
    
        
        
    
    @endforeach 
    </div>
    <div class="row mt-2">
    
    
    
    </div>
    </x-layout>
    