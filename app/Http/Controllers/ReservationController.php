<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    public function create(){
       
       
        return view('reservations.create', [
            'books' => Book::all(),
            'users'=>User::all()
        ]);
       
    }

    public function store(ReservationRequest $request){
        
        $request->validated();
        $reserve = Reservation::create($request);
        Session::flash('message','Livro reservado com sucesso!');
        return redirect()->route('reservation.update', $reserve->id);
       
    }

    public function storeShortcut(Book $book){
        
        $reserve = Reservation::create(
            [
                'books_id' => $book->id,
                'user_id' => auth()->id()
            ]
            );
        return redirect()->route('index');
       
    }


    public function destroy(Book $book){
        
        $reservation = Reservation::where('books_id',$book->id);
        $reservation->delete();
        Session::flash('message','Livro disponibilizado com sucesso!');
        return redirect()->route('index');
       
    }

    public function index(){

       

        return view('reservations.index', 
        [
            'reservations' => auth()->user()->reservations
        ]
    );

    }

    public function manage(){

       

        return view('reservations.manage', 
        [
            'reservations' => Reservation::all()
        ]
    );

    }
}
