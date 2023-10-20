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
        $temAutor = request()->has('authors');
        $formFields = request()->validate(
            [
                'title' => 'required',
                'author' => 'required',
                'authors' => 'required',
                'file' => 'required'
            ],
            [
                'title.required' => 'Favor inserir título',
                'author.required' => 'Favor inserir subtitulo',
                'authors.required' => 'Favor selecionar autores',
                'file.required' => 'Favor inserir publicacao'
            ]

        );

        $formFieldCopy = $formFields;
        $temArquivo = request()->hasFile('image');
        $temArquivoPDF = request()->hasFile('file');

        if ($temArquivo) {
            $uploadedFile = request()->file('image');
            $filename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $uploadedFile->getClientOriginalExtension();
            $newFilename = $filename . '_' . uniqid() . '.' . $extension;
            // Store the new image in S3
            $awsPath = 'images/'.auth()->id().'/'. $newFilename;
            Storage::disk('s3')->put($awsPath, file_get_contents($uploadedFile));

            $formFieldCopy['image'] = $awsPath;
        }

        if ($temArquivoPDF) {
            $uploadedFile = request()->file('file');
            $filename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $uploadedFile->getClientOriginalExtension();

            $PDFerror = \Illuminate\Validation\ValidationException::withMessages([
                'file' => ['Somente aceitamos tipo de arquivo PDF'],

             ]);

            $extension != 'pdf' && throw $PDFerror;

            $newFilename = $filename . '_' . uniqid() . '.' . $extension;
            // Store the new image in S3
            $awsPath = 'file/'.auth()->id().'/' . $newFilename;
            Storage::disk('s3')->put($awsPath, file_get_contents($uploadedFile));

            $formFieldCopy['file'] = $awsPath;
        }



        $formFieldCopy['user_id'] =  auth()->id();
        $book = Book::create($formFieldCopy);
        if($temAutor){
            foreach(request()->get('authors') as $autor){
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
        $temAutor = request()->has('authors');

        if ($ehDonoOuAdmin) {

            $formFields = request()->validate([
                'title' => 'required',
                'author' => 'required',
                // 'file' => 'required' // You can add image validation rules
            ], [
                'title.required' => 'Favor inserir título',
                'author.required' => 'Favor inserir subtitulo',
                'authors.required' => 'Favor selecionar autores',
                'file.required' => 'Favor inserir arquivo da publicacao',
            ]);

            $formFieldCopy = $formFields;
            $temArquivo = request()->hasFile('image');
            $temArquivoPDF = request()->hasFile('file');

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
                $awsPath = 'images/'.auth()->id().'/' . $newFilename;
                Storage::disk('s3')->put($awsPath, file_get_contents($uploadedFile));

                $formFieldCopy['image'] = $awsPath;
            }

            if ($temArquivoPDF) {
                $uploadedFile = request()->file('file');
                $filename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $uploadedFile->getClientOriginalExtension();
                $PDFerror = \Illuminate\Validation\ValidationException::withMessages([
                'file' => ['Somente aceitamos tipo de arquivo PDF'],

             ]);

                $extension != 'pdf' && throw $PDFerror;

                $newFilename = $filename . '_' . uniqid() . '.' . $extension;

                $arquivoJaExiste = $book->file != null && Storage::disk('s3')->exists($book->file);

                if ($arquivoJaExiste) {
                    Storage::disk('s3')->delete($book->image);
                }

                // Store the new image in S3
                $awsPath = 'file/'.auth()->id().'/' . $newFilename;
                Storage::disk('s3')->put($awsPath, file_get_contents($uploadedFile));

                $formFieldCopy['file'] = $awsPath;
            }

            if($temAutor){

                Reservation::where('books_id',$book->id)->delete();
                foreach(request()->get('authors') as $autor){
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
            Storage::disk('s3')->delete($book->file);
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
