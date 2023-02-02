<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'author'];

    public function scopeFilter($query, array $filters){
            if($filters['title'] ?? false ){
                $query->where('title', 'like','%'.request('title').'%');
            }

            if($filters['search'] ?? false ){
                $query->where('title', 'like','%'.request('search').'%')
                
                ->orWhere('author', 'like','%'.request('search').'%');
            }
    }


    public function user(){
     return $this->belongsTo(User::class, 'user_id');
    }

    public function reservations(){
        return $this->belongsTo(Reservation::class, 'books_id');
    }
    
    public function reserved(){
        $reserve = Reservation::where('books_id', $this->id)->exists();
        return $reserve;
    }

    public function unreserve(){
        $reserve = Reservation::where('books_id', $this->id);
        $reserve->delete();
        return $reserve;
    }
}


