<?php
namespace App\Repositories\Contracts;
interface AccountRepositoryInterface
{
    public function index();
    public function store(array $data);
}
