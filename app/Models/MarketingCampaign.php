<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingCampaign extends Model
{
    protected $fillable = [
        'marketing_campaign_name',
        'marketing_campaign_type_id',
        'start_date',
        'end_date',
    ];

    //relationships
    public function marketingCampaignType()
    {
        return $this->belongsTo(MarketingCampaignType::class,'marketing_campaign_type_id','id');
    }

    /**
     * Service methods for CRUD
     */


    public function getAllMarketingCampaigns()
    {
        return $this->with('marketingCampaignType')->where('marketing_campaigns.status',1)->orderBy('marketing_campaigns.id','desc');
    }

    public function addMarketingCampaign($data)
    {
        return $this->create($data);
    }

    public function getMarketingCampaignById($id)
    {
        return $this->where('id',$id)->firstOrFail();
    }

    public function updateMarketingCampaign($data, $id)
    {
        return $this->where('id',$id)->update($data);
    }

    public function deleteMarketingCampaign($id)
    {
        return $this->where('id',$id)->update(['status'=> 0]);
    }

    public function getTotalMarketingCampaigns()
    {
        return $this->select('id')->where('status',1)->get()->count();
    }
}
