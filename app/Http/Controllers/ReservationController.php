<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
{
    public function create(){
       
        $books_id = Reservation::pluck('books_id')->all();
        // $users_id = Reservation::pluck('books_id')->all();
        $unReservedbooks = Book::whereNotIn('id', $books_id)->get();
        return view('reservations.create', [
            'books' => $unReservedbooks,
            'users'=>User::all()
        ]);
       
    }

    

    public function edit(Reservation $reserve){
        
        $books_id = Reservation::pluck('books_id')->all();
        $unReservedbooks = Book::whereNotIn('id', $books_id)->get();
        $r  = Book::where('id','=' ,$reserve->book->id)->get();
        $unReservedbooks = $unReservedbooks->merge($r);
        return view('reservations.edit', [
            'books' => $unReservedbooks,
            'users'=>User::all(),
            'reservation'=> $reserve,
           
            
        ]);
       
    }

    public function update(Reservation $reserve, UpdateReservationRequest $request){
        
        $formFields =$request->validated();
        $reserve->update($formFields);
        Session::flash('message','Reserva atualizada com sucesso!');
        return redirect()->route('reservation.edit', $reserve->id);
       
    }

    public function store(ReservationRequest $request){
        
        $formFields = $request->validated();
        $reserve = Reservation::create([
            'user_id' => $formFields['user_id'],
            'books_id' => $formFields['books_id'],
        ]);
        // $reserve = Reservation::create($formFields);
        Session::flash('message','Reserva criada com sucesso!');
        return redirect()->route('reservation.edit', $reserve->id);
       
    }

    public function storeShortcut(Book $book){
        
        $reserve = Reservation::create(
            [
                'books_id' => $book->id,
                'user_id' => auth()->id()
            ]
            );
        Session::flash('message','Reserva criada com sucesso!');
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
