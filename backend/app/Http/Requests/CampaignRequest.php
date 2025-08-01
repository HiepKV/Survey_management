<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CampaignRequest extends FormRequest
{
    public function rules(){
        return [
            'title' => 'sometimes|string',
            'send_method' => 'sometimes|string',
            'send_date' => 'sometimes|date',
            'status' => 'sometimes|string',
            'company_id' => 'sometimes|integer',
            'created_by' => 'sometimes|integer'
        ];
    }
}
