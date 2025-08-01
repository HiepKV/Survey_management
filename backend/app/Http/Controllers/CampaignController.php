<?php
namespace App\Http\Controllers;
use App\Http\Requests\CampaignRequest;
use App\Services\CampaignService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
    protected $campaignService;
    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }
    public function index(Request $request){
        return $this->campaignService->index($request);
    }
    public function store(CampaignRequest $request): JsonResponse
    {
        $data = $request->validated();
        $campaign = $this->campaignService->store($data);

        return response()->json($campaign, 201);
    }
    public function update(CampaignRequest $request, int $id)
    {
        $data = $request->validated();

        $campaign = $this->campaignService->update($id, $data);

        return response()->json($campaign);
    }
    public function findOrFail(int $id){
        return $this->campaignService->findOrFail($id);
    }

}
