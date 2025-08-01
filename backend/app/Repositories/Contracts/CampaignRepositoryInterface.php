<?php
namespace App\Repositories\Contracts;
use Illuminate\Http\Request;

interface CampaignRepositoryInterface
{
    public function index(Request $request);
    public function find(int $id);
    public function store(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
