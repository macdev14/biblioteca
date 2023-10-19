@props(['book'])
<form action="{{ route('book-show', $book->id) }}" method="post" class="mt-4">
    {{-- @csrf --}}
    @method('GET')
    <button class="btn btn-outline-success">
      Você está participando desta publicação.
      </button>
    </form>

