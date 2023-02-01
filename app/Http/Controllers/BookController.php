<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


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
            'author'=>'required'
        ],[
            'title.required'=>'Favor inserir título',
            'author.required'=>'Favor inserir autor',
        ]
    
    );
    if(request()->hasFile('image')){
        $formFields['image'] =request()->file('image')->store('images', 'public');
    }
        $formFields['user_id'] =  auth()->id();
        Book::create($formFields);
        Session::flash('message','Livro adicionado com sucesso!');
        return redirect('/');
    }

    public function edit(Book $book){
        // dd($book);
        return view('books.edit', ['book'=>$book]);
    }

    // Atualizar dados do livro

    public function update(Book $book){
        // dd(request()->file('image')->store() );
        $formFields= request()->validate([
            'title'=>'required',
            'author'=>'required'
        ],[
            'title.required'=>'Favor inserir título',
            'author.required'=>'Favor inserir autor',
        ]
    
    );
    if(request()->hasFile('image')){
        $formFields['image'] =request()->file('image')->store('images', 'public');
    }
        $book->update($formFields);
        Session::flash('message','Livro editado com sucesso!');
        return back();
    }
    
    public function destroy(Book $book){
        $book->delete();
        Session::flash('message','Livro excluído com sucesso!');
        return redirect('/');
    }

    public function manage(){
        return view('books.manage', 
        [
            'books' => auth()->user()->books
        ]
    );

    }
     

}
