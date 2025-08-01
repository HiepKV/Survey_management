<?php
namespace App\Repositories;
use App\Models\Campaign;
use App\Repositories\Contracts\CampaignRepositoryInterface;
use Illuminate\Http\Request;

class CampaignRepository implements CampaignRepositoryInterface
{
    public function index(Request $request)
    {
        $query = Campaign::with('company')
            ->withCount('recipients', 'formAnswers')
            ->orderBy('created_at', 'desc');

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('name')) {
            $query->whereHas('company', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        return response()->json($query->paginate(10), 200);
    }


    public function find(int $id)
    {
        $campaign = Campaign::with('company' )
            ->withCount('recipients', 'formAnswers')
            ->findOrFail($id);
        return response()->json($campaign, 200);
    }

    public function store(array $data)
    {
        return Campaign::create($data);
    }

    public function update(int $id, array $data)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->update($data);
        return $campaign;
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}
