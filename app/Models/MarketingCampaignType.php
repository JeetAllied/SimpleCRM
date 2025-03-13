<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingCampaignType extends Model
{
    use HasFactory;
    protected $fillable = [
        'marketing_campaign_type_name'
    ];

    /**
     * Service methods for CRUD
     */


    public function getAllMarketingCampaignTypes()
    {
        return $this->select('id', 'marketing_campaign_type_name','status')->where('status',1)->orderBy('id','desc')->get();
    }

    public function addMarketingCampaignType($data)
    {
        return $this->create($data);
    }

    public function getMarketingCampaignTypeById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateMarketingCampaignType($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteMarketingCampaignType($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalActiveMarketingCampaignTypes()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
