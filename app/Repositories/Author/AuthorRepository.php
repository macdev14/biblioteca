<?php
use App\Repositories\Interfaces\AuthorRepositoryInterface;
class AuthorRepository implements AuthorRepositoryInterface{
    private $model;
    public function __construct($model){
        $this->model = $model;
    }
    public function findAll(){
        return $this->model->all();
    }

    
}
