<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
class CompanyService
{
    protected $companyRepository;
    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    public function index(Request $request)
    {
        return $this->companyRepository->index($request);
    }
    public function store(array $data)
    {
        $data['created_by'] = auth()->user()->id;
        return $this->companyRepository->store($data);
    }
    public function update(int $id, array $data)
    {
        return $this->companyRepository->update($id, $data);
    }
    public function findOrFail(int $id){
        return $this->companyRepository->find($id);
    }
}
