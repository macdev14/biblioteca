<?php

use App\Repositories\Interfaces\BookRepositoryInterface;

class AuthorRepository implements BookRepositoryInterface
{
    private $model;
    public function __construct($model)
    {
        $this->model = $model;
    }
    public function findAll()
    {
        return $this->model->all();
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['title'] ?? false) {
            $query->where('title', 'like', '%' . request('title') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')

                ->orWhere('author', 'like', '%' . request('search') . '%');
        }
    }
}
