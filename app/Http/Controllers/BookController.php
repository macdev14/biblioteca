<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    // Show all listings
    public function index()
    {

        return view('books.index', [
            'heading' => 'LATEST BOOKS',
            'books' => Book::latest()->filter(request(['title', 'search']))->paginate(6)
        ]);
    }

    public function show(Book $book)
    {

        return view('books.show', [
            'book' => $book,
            'users'=>User::all()
        ]);
    }
    public function create()
    {
        return view('books.create', ['users'=>User::all()]);
    }

    public function store()
    {
        $temAutor = request()->has('author');
        $formFields = request()->validate(
            [
                'title' => 'required',
                // 'author' => 'required',
                'image' => 'required'
            ],
            [
                'title.required' => 'Favor inserir título',
                // 'author.required' => 'Favor inserir autor',
                'image.required' => 'Favor inserir imagem'
            ]

        );

        $formFieldCopy = $formFields;
        $temArquivo = request()->hasFile('image');

        if ($temArquivo) {
            $uploadedFile = request()->file('image');
            $filename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $uploadedFile->getClientOriginalExtension();
            $newFilename = $filename . '_' . uniqid() . '.' . $extension;
            // Store the new image in S3
            $awsPath = 'images/' . $newFilename;
            Storage::disk('s3')->put($awsPath, file_get_contents($uploadedFile));

            $formFieldCopy['image'] = $awsPath;
        }
        $formFieldCopy['user_id'] =  auth()->id();
        $formFieldCopy['author'] = auth()->id();
        $book = Book::create($formFieldCopy);
        if($temAutor){
            foreach(request()->get('author') as $autor){
                Reservation::create([
                    'user_id' => $autor,
                    'books_id' => $book->id,
                ]);
            }
        }
        Session::flash('message', 'Livro adicionado com sucesso!');
        return redirect('/');
    }

    public function edit(Book $book)
    {

        $ehDonoOuAdmin = auth()->id() == $book->user->id || auth()->user()->isAdmin();
        if ($ehDonoOuAdmin) {
            return view('books.edit', ['book' => $book, 'users'=>User::all()]);
        } else {
            Session::flash('message', 'Livro adicionado por outro usuário!');
            return redirect()->route('index');
        }
    }

    // Atualizar dados do livro

    public function update(Book $book)
    {

        $ehDonoOuAdmin = auth()->id() == $book->user->id || auth()->user()->isAdmin();
        $temAutor = request()->has('author');

        if ($ehDonoOuAdmin) {

            $formFields = request()->validate([
                'title' => 'required',
                // 'author' => 'required',
                'image' => 'required' // You can add image validation rules
            ], [
                'title.required' => 'Favor inserir título',
                // 'author.required' => 'Favor inserir autor',
                'image.required' => 'Favor inserir link da imagem do livro',
            ]);

            $formFieldCopy = $formFields;
            $temArquivo = request()->hasFile('image');

            if ($temArquivo) {
                $uploadedFile = request()->file('image');
                $filename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $uploadedFile->getClientOriginalExtension();
                $newFilename = $filename . '_' . uniqid() . '.' . $extension;

                $arquivoJaExiste = $book->image != null && Storage::disk('s3')->exists($book->image);

                if ($arquivoJaExiste) {
                    Storage::disk('s3')->delete($book->image);
                }

                // Store the new image in S3
                $awsPath = 'images/' . $newFilename;
                Storage::disk('s3')->put($awsPath, file_get_contents($uploadedFile));

                $formFieldCopy['image'] = $awsPath;
            }

            if($temAutor){

                Reservation::where('books_id',$book->id)->delete();
                foreach(request()->get('author') as $autor){
                    Reservation::create([
                        'user_id' => $autor,
                        'books_id' => $book->id,
                    ]);
                }
            }
            $book->update($formFieldCopy);
            Session::flash('message', 'Livro editado com sucesso!');
            return back();
        } else {
            Session::flash('message', 'Livro adicionado por outro usuário!');
            return redirect()->route('index');
        }
    }


    public function destroy(Book $book)
    {
        $ehDonoOuAdmin = auth()->id() == $book->user->id || auth()->user()->isAdmin();
        if ($ehDonoOuAdmin) {
            Storage::disk('s3')->delete($book->image);
            $book->delete();
            Session::flash('message', 'Livro excluído com sucesso!');
            return redirect('/');
        } else {
            Session::flash('message', 'Livro adicionado por outro usuário!');
            return redirect()->route('index');
        }
    }

    public function manage()
    {
        return view(
            'books.manage',
            [
                'books' => auth()->user()->books
            ]
        );
    }
}
