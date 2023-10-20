<x-layout>

    <div class="col-md-6 col-xl-4 mt-5 mb-5">
        <img width="200px" height="300"  src="{{ $book->image ? Storage::disk('s3')->url($book->image) : 'https://via.placeholder.com/200x300' }}" alt="">
    </div>

    <div class="row align-items-center">

        <style>
            .pdf {
                display: flex; height: 100%;flex-wrap: nowrap;position: relative;
            }
            .wrap
{
    /* width: 100%;
    height: 100%; */
    /* padding: 0;
    overflow: hidden; */
}

.frame
{

    border: 0;

    /* -ms-transform: scale(0.75);
    -moz-transform: scale(0.75);
    -o-transform: scale(0.75);
    -webkit-transform: scale(0.75);
    transform: scale(0.75);

    -ms-transform-origin: 0 0;
    -moz-transform-origin: 0 0;
    -o-transform-origin: 0 0;
    -webkit-transform-origin: 0 0;
    transform-origin: 0 0; */
}
            </style>



    <h2>Título:</h2>    <p> <span class="align-middle">  {{ $book->title }} </span> </p>
    <h2>Autores:</h2>    @foreach ($book->reservations as $reservation)
    <h5>   {{$reservation->user->name." - ".$reservation->user->email }} </h5>
        @endforeach
    @auth
    @if ($book->user_id == auth()->user()->id || auth()->user()->isAdmin())


    <div class="col-md-6 col-xl-4 mt-5 mb-5">
        <a name="" id="" class="btn btn-outline-primary" href="{{ route('book-edit', $book->id) }}" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
              </svg>
            Editar</a>

        <form action="{{ route('book-update', $book->id) }}" method="post" class="mt-4">
        @csrf
        @method('DELETE')


        <button class="btn btn-outline-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
</svg>
            Excluir
          </button>
        </form>

    </div>
    @endif
    @endauth


    </div>
    <div id="pspdfkit" style="height: 100vh"></div>
    {{-- <canvas id="the-canvas" style="border:1px solid black;"/> --}}
    {{-- <object data="{{ $book->image ? Storage::disk('s3')->url($book->image) : 'https://via.placeholder.com/200x300' }}" type="application/pdf" height="100vh" width="100%"> --}}
    {{-- <div class="box document">



 </div> --}}
    {{-- </object> --}}

        {{-- <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Documento</h3>
            </div>
            <div class="panel-body wrap">
                <iframe class="frame" width="100%" style="position: absolute" height="100%" src="{{ $book->image ? Storage::disk('s3')->url($book->image) : 'https://via.placeholder.com/200x300' }}"  frameborder="0" ></iframe>
            </div>
        </div> --}}
</div>
<script>
	PSPDFKit.load({
		container: "#pspdfkit",
  		document: "{{ $book->file ? Storage::disk('s3')->url($book->file) : 'https://via.placeholder.com/200x300' }}" // Add the path to your document here.
	})
	.then(function(instance) {
		console.log("PSPDFKit loaded", instance);
	})
	.catch(function(error) {
		console.error(error.message);
	});
</script>
<script>
    pdfjsLib.getDocument("{{ $book->file ? Storage::disk('s3')->url($book->file) : 'https://via.placeholder.com/200x300' }}").then(function(pdf) {
  pdf.getPage(1).then(function(page) {
    var scale = 1.5;
    var viewport = page.getViewport(scale);

    var canvas = document.getElementById('the-canvas');
    var context = canvas.getContext('2d');
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    var renderContext = {
      canvasContext: context,
      viewport: viewport
    };
    page.render(renderContext);
  });
});
</script>
</x-layout>



