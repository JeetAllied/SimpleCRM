<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Opportunity;
use App\Models\Activity;
use App\Models\MarketingCampaign;
use App\Models\Ticket;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index() {
        $leadsCount = Lead::count();
        $opportunitiesCount = Opportunity::count();

        $leadConversion = [
            'leads' => $leadsCount,
            'opportunities' => $opportunitiesCount,
        ];

        $pipelineData = Opportunity::join('opportunity_stages','opportunity_stages.id','=','opportunities.opportunity_stage_id')
            ->selectRaw('opportunity_stages.opportunity_stage_name as name, COUNT(opportunities.id) as count')
            ->groupBy('opportunity_stages.opportunity_stage_name')
            ->pluck('count', 'name');

        $activityData = Activity::join('activity_types','activity_types.id','=','activities.activity_type_id')
            ->selectRaw('activity_types.activity_type_name as name, COUNT(activities.id) as count')
            ->groupBy('activity_types.activity_type_name')
            ->pluck('count', 'name');

        $marketingData = MarketingCampaign::join('marketing_campaign_types','marketing_campaign_types.id','=','marketing_campaigns.id')
            ->selectRaw('marketing_campaign_types.marketing_campaign_type_name as name, COUNT(marketing_campaigns.id) as count')
            ->groupBy('marketing_campaign_types.marketing_campaign_type_name')
            ->pluck('count', 'name');

        $ticketStatus = Ticket::join('ticket_statuses', 'tickets.ticket_status_id', '=', 'ticket_statuses.id')
            ->selectRaw('ticket_statuses.ticket_status_name as status, COUNT(tickets.id) as count')
            ->groupBy('ticket_statuses.ticket_status_name')
            ->pluck('count', 'status');

        return view('dashboard.index', compact('leadConversion', 'pipelineData', 'activityData', 'marketingData', 'ticketStatus'));
    }
}
