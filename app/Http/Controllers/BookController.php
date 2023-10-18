<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    // Show all listings
    public function index(){

        return view('books.index',[
            'heading'=> 'LATEST BOOKS',
            'books'=> Book::latest()->filter(request(['title', 'search']))->paginate(6)
        ]);

    }

    public function show(Book $book){

        return view('books.show',[
            'book'=> $book
        ]);
    }
    public function create(){
        return view('books.create');
    }

    public function store(){
        // dd(request()->file('image')->store() );
        $formFields= request()->validate([
            'title'=>'required',
            'author'=>'required',
            'image'=>'required'
        ],[
            'title.required'=>'Favor inserir título',
            'author.required'=>'Favor inserir autor',
            'image.required'=>'Favor inserir imagem'
        ]

    );
    // if(request()->hasFile('image')){

    //     // $extension  = request()->file('image')->get;
    //     // $image_name = time() .'_' . request()->title . '.' . $extension;

    //     // Storage::disk('s3')->put('images', request()->file('image') );
    //     // $path = Storage::disk('s3')->get(request()->file('image'));

    //     $formFields['image']



    // }
        $formFields['user_id'] =  auth()->id();
        Book::create($formFields);
        Session::flash('message','Livro adicionado com sucesso!');
        return redirect('/');
    }

    public function edit(Book $book){
        // dd($book);
        if(auth()->id()==$book->user->id || auth()->user()->isAdmin()){
        return view('books.edit', ['book'=>$book]);
        }
        else{
            Session::flash('message','Livro adicionado por outro usuário!');
            return redirect()->route('index');
        }
    }

    // Atualizar dados do livro

public function update(Book $book)
{
    if (auth()->id() == $book->user->id || auth()->user()->isAdmin()) {

        $formFields = request()->validate([
            'title' => 'required',
            'author' => 'required',
            // 'image' => 'image|required' // You can add image validation rules
        ], [
            'title.required' => 'Favor inserir título',
            'author.required' => 'Favor inserir autor',
            'image.required' => 'Favor inserir link da imagem do livro',
        ]);

        $formFieldCopy = $formFields;

        if (request()->hasFile('image')) {
            $uploadedFile = request()->file('image');
            $filename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $uploadedFile->getClientOriginalExtension();
            $newFilename = $filename . '_' . uniqid() . '.' . $extension;

            $arquivoJaExiste = $book->image != null && Storage::disk('s3')->exists('images/' . $book->image);

            if ($arquivoJaExiste) {
                Storage::disk('s3')->delete('images/' . $book->image);
            }

            // Store the new image in S3
            $awsPath = 'images/' . $newFilename;
            Storage::disk('s3')->put($awsPath, file_get_contents($uploadedFile));

            $formFieldCopy['image'] = $awsPath;
        }

        $book->update($formFieldCopy);
        Session::flash('message', 'Livro editado com sucesso!');
        return back();
    } else {
        Session::flash('message', 'Livro adicionado por outro usuário!');
        return redirect()->route('index');
    }
}


    public function destroy(Book $book){
        if(auth()->id()==$book->user->id || auth()->user()->isAdmin()){
        $book->delete();
        Session::flash('message','Livro excluído com sucesso!');
        return redirect('/');
        }else{
            Session::flash('message','Livro adicionado por outro usuário!');
            return redirect()->route('index');
        }
    }

    public function manage(){
        return view('books.manage',
        [
            'books' => auth()->user()->books
        ]
    );

    }


}
