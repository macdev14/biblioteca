<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    public function store(Book $book){
       
        $reserve = Reservation::create(
            [
                'books_id' =>$book->id,
                'user_id'=> auth()->id()
            ]
            );
        Session::flash('message','Livro reservado com sucesso!');
        return redirect()->route('index');
       
    }

    public function destroy(Book $book){
        
        $reservation = Reservation::where('books_id',$book->id);
        $reservation->delete();
        Session::flash('message','Livro disponibilizado com sucesso!');
        return redirect()->route('index');
       
    }
}
