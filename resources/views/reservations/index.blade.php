
<x-layout>

    <div class="row justify-content-center align-items-center g-2">
        <h2 class="">Publicação e seu seguinte Autor</h2>
    </div>

    <div class="row align-items-center mt-5">
        @if($reservations->isEmpty())
        <h3 class="">Nenhuma Publicação com seu seguinte Autor</h3>
        @else
    @foreach($reservations as $reservation)


          <x-bookcard :book="$reservation->book"/>





    @endforeach
    @endif



    </div>
    <div class="row mt-2">



    </div>
    </x-layout>
