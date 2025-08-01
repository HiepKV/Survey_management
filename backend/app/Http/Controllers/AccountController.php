<?php
namespace App\Http\Controllers;
use App\Services\AccountService;
use Illuminate\Http\Request;
class AccountController extends Controller
{
    protected $accountService;
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }
    public function index(){
        return $this->accountService->index();
    }
    public function store(Request $request){
        $data = $request->all();
        return $this->accountService->store($data);
    }
}
