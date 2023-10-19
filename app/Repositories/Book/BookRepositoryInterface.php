<?php

namespace App\Repositories\Interfaces;

interface BookRepositoryInterface
{
	public function findAll();
    public function scopeFilter($query, array $filters);
}


?>
