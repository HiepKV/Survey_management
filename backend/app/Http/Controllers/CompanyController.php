<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\CompanyService;
class CompanyController extends Controller
{
    protected $companyService;
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    public function index(Request $request){
        return $this->companyService->index($request);
    }
    public function store(Request $request){
        $data = $request->all();
        return $this->companyService->store($data);
    }
    public function update(int $id, array $data){
        return $this->companyService->update($id, $data);
    }
    public function findOrFail(int $id){
        return $this->companyService->findOrFail($id);
    }
}
