<?php
namespace App\Services;
use App\Repositories\Contracts\AccountRepositoryInterface;

class AccountService
{
    protected $accountRepository;
    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }
    public function index(){
        return $this->accountRepository->index();
    }
    public function store(array $data){
        return $this->accountRepository->store($data);
    }
}
