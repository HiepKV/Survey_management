<?php
namespace App\Services;
use App\Repositories\CampaignRepository;
use Illuminate\Http\Request;

class CampaignService
{
    protected $campaignRepository;
    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }
    public function index(Request $request){
        return $this->campaignRepository->index($request);
    }
    public function store(array $data){
        $data['created_by'] = auth()->user()->id;
        return $this->campaignRepository->store($data);
    }
    public function update(int $id, array $data){
        return $this->campaignRepository->update($id, $data);
    }
    public function findOrFail(int $id){
        return $this->campaignRepository->find($id);
    }
}
