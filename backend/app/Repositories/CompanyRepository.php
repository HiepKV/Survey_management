<?php
namespace App\Repositories;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{

    public function index(Request $request)
    {
        $query = Company::query();
       if($request->filled('name')){
           $query->where('name', 'like', '%' . $request->name . '%');
       }
       return response()->json($query->paginate(10), 200);
    }

    public function find(int $id)
    {
        return Company::findOrFail($id);
    }

    public function store(array $data)
    {
        return Company::create($data);
    }

    public function update(int $id, array $data)
    {
        $company = Company::findOrFail($id);
        $company->update($data);
        return $company;
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}
