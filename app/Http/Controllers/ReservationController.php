<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    public function store(Book $book){
        Reservation::create(
            [
                'book_id' =>$book->id,
                'user_id'=> auth()->user()->id
            ]
            );
        return Session::flash('message','Livro reservado com sucesso!');
       
    }

    public function destroy(Book $book){
        $book->delete();
        return Session::flash('message','Livro disponibilizado com sucesso!');
       
    }
}
