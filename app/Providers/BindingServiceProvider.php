<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Services\ActivityTypeService\ActivityTypeService',
            'App\Services\ActivityTypeService\ActivityTypeServiceImpl'
        );
        $this->app->bind(
            'App\Services\LeadSourceService\LeadSourceService',
            'App\Services\LeadSourceService\LeadSourceServiceImpl'
        );
        $this->app->bind(
            'App\Services\LeadStatusService\LeadStatusService',
            'App\Services\LeadStatusService\LeadStatusServiceImpl'
        );
        $this->app->bind(
            'App\Services\MarketingCampaignTypeService\MarketingCampaignTypeService',
            'App\Services\MarketingCampaignTypeService\MarketingCampaignTypeServiceImpl'
        );
        $this->app->bind(
            'App\Services\OpportunityStageService\OpportunityStageService',
            'App\Services\OpportunityStageService\OpportunityStageServiceImpl'
        );
        $this->app->bind(
            'App\Services\SalesPipelineStageService\SalesPipelineStageService',
            'App\Services\SalesPipelineStageService\SalesPipelineStageServiceImpl'
        );
        $this->app->bind(
            'App\Services\TicketStatusService\TicketStatusService',
            'App\Services\TicketStatusService\TicketStatusServiceImpl'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
