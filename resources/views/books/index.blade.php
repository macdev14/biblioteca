
<x-layout>

<div class="row justify-content-center align-items-center g-2">
    <h2 class="">Livro(s)</h2>
</div>

<div class="row align-items-center mt-5">
@foreach($books as $book)

   
      <x-bookcard :book="$book"/>


    
    

@endforeach 
</div>
<div class="row mt-2">

    {{ $books->links() }}

</div>
</x-layout>
