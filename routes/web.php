<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadSourceController;
use App\Http\Controllers\LeadStatusController;
use App\Http\Controllers\MarketingCampaignController;
use App\Http\Controllers\MarketingCampaignTypeController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\OpportunityStageController;
use App\Http\Controllers\SalesPipelineController;
use App\Http\Controllers\SalesPipelineStageController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketStatusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('test2');
});

Route::get('/test', function () {
    return view('test2');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resources([
        'activities'=>ActivityController::class,
        'activity-types'=>ActivityTypeController::class,
        'customers'=>CustomerController::class,
        'leads'=>LeadController::class,
        'lead-sources'=>LeadSourceController::class,
        'lead-statuses'=>LeadStatusController::class,
        'marketing-campaigns'=>MarketingCampaignController::class,
        'marketing-campaign-types'=>MarketingCampaignTypeController::class,
        'opportunities'=>OpportunityController::class,
        'opportunity-stages'=>OpportunityStageController::class,
        'sales-pipelines'=>SalesPipelineController::class,
        'sales-pipeline-stages'=>SalesPipelineStageController::class,
        'tickets'=>TicketController::class,
        'ticket-statuses'=>TicketStatusController::class,
        'roles'=>RoleController::class,
        'users'=>UserController::class
    ]);
    Route::get('/get-all-customers',[CustomerController::class,'getAllCustomers'])->name('get-all-customers');
    Route::get('/get-all-leads',[LeadController::class,'getAllLeads'])->name('get-all-leads');
    Route::get('/get-all-opportunities',[OpportunityController::class,'getAllOpportunities'])->name('get-all-opportunities');
    Route::get('/get-all-sales-pipelines',[SalesPipelineController::class,'getAllSalesPipelines'])->name('get-all-sales-pipelines');
    Route::get('/get-all-tickets',[TicketController::class,'getAllTickets'])->name('get-all-tickets');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
