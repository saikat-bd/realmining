<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDashbaordController;
use App\Http\Controllers\ExclusiveAdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CompanyFundController;
use App\Http\Controllers\CompanyCommissionContrller;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\DebitWalletController;
use App\Http\Controllers\CreditWalletController;
use App\Http\Controllers\TransferWalletController;
use App\Http\Controllers\RoyaltyWalletController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\WalletAccountController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GenerationPlanController;
use App\Http\Controllers\ForgotTransactionPinController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\ActiveYourAccountController;
use App\Http\Controllers\IPOController;


Route::get('/clear', function() {
   Artisan::call('config:cache');
   Artisan::call('event:cache');
   Artisan::call('route:cache');
   Artisan::call('view:cache');
   return "Cleared!";
});

// start website 
Route::get('/', [LoginController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/packages', [HomeController::class, 'packages']);
Route::get('/blogs', [HomeController::class, 'blogs']);
Route::get('/contact', [HomeController::class, 'contact']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'index']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgot']);

Route::get('generated-new-password', [ForgotPasswordController::class, 'generated_password']);
Route::post('generated-new-password', [ForgotPasswordController::class, 'generatedpassword']);


Route::get('/register', [RegisterController::class, 'index']);
Route::get('/create-new-account', [RegisterController::class, 'created_new_account']);
Route::post('/registerstore', [RegisterController::class, 'store']);
Route::post('/createaccountstore', [RegisterController::class, 'createaccountstore']);


// end website 
Route::get('auth', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('login-check', [LoginController::class, 'login_check']);

// user auth start
Route::group(['middleware' => 'auth'], function () {

Route::get('forgot-transactionpin', [ForgotTransactionPinController::class, 'sendmail']);
Route::get('verifymailsend', [ForgotTransactionPinController::class, 'verifysendmail']);
Route::get('account-verifaction', [ForgotTransactionPinController::class, 'verfiyaccountsubmit']);


Route::get('profile-edit', [DashboardController::class, 'profile_edit']);
Route::get('profile', [DashboardController::class, 'profile']);

Route::get('dashboard', [DashboardController::class, 'index']);
Route::post('profile-update', [DashboardController::class, 'profile_update']);

Route::get('change-password', [PasswordController::class, 'index']);
Route::post('password-update', [PasswordController::class, 'password_update']);
Route::post('transaction-pin', [PasswordController::class, 'trsaction_pin']);
Route::post('transaction-pin-update', [PasswordController::class, 'trsaction_pin_update']);

Route::get('activeyouraccount', [ActiveYourAccountController::class, 'activeaccount']);

Route::get('invite-link', [DashboardController::class, 'invite_link']);
Route::get('my-refrences', [DashboardController::class, 'my_refrences']);
Route::get('my-team', [DashboardController::class, 'my_team']);
Route::get('team-ranks', [DashboardController::class, 'team_rank']);

Route::get('ipocoinbuy/{id}', [IPOController::class, 'ipocoinbuy']);
Route::post('ipocoinstore', [IPOController::class, 'iconbuystore']);

Route::get('investment-report', [InvestmentController::class, 'investment_report']);
Route::get('investment/{id}', [InvestmentController::class, 'investment']);
Route::get('buyexclusive-plan/{id}', [InvestmentController::class, 'buyexclusiveplan']);
Route::get('exclusive-plan', [InvestmentController::class, 'exclusive_plan']);
Route::get('exclusive-report', [InvestmentController::class, 'exclusive_report']);

Route::get('withdrawal-report', [DebitWalletController::class, 'index']);
Route::get('debit-to-transfer', [DebitWalletController::class, 'debit_transfer']);
Route::post('debit-to-transfer', [DebitWalletController::class, 'debit_transferstore']);
Route::get('debit-to-withdrawal', [DebitWalletController::class, 'withdrawal']);
Route::post('debit-to-withdrawal', [DebitWalletController::class, 'withdrawal_store']);
Route::get('credit-wallet', [CreditWalletController::class, 'index']);


Route::get('credit-to-transfer', [CreditWalletController::class, 'credit_transfer']);
Route::post('credit-to-transfer', [CreditWalletController::class, 'transferstore']);

Route::get('credit-to-debit', [CreditWalletController::class, 'credit_debit']);
Route::post('credit-to-debit', [CreditWalletController::class, 'debit_store']);

Route::get('transfer-report', [TransferWalletController::class, 'report']);
Route::get('transfer-wallet', [TransferWalletController::class, 'index']);
Route::post('transfer-wallet', [TransferWalletController::class, 'transferwalt']);

Route::get('deposit-report', [TransferWalletController::class, 'deposit_report']);
Route::get('deposit', [TransferWalletController::class, 'deposit']);
Route::post('depositstore', [TransferWalletController::class, 'depositstore']);

Route::get('investment', [TransferWalletController::class, 'investment']);
Route::get('account-status', [TransferWalletController::class, 'account_status']);

Route::get('royalty-wallet', [RoyaltyWalletController::class, 'index']);

Route::get('royalty-to-transfer', [RoyaltyWalletController::class, 'royalty_transfer']);
Route::post('royalty-to-transfer', [RoyaltyWalletController::class, 'transfer_store']);
Route::get('royalty-to-debit', [RoyaltyWalletController::class, 'royalty_debit']);
Route::post('royalty-to-debit', [RoyaltyWalletController::class, 'debit_store']);
Route::get('total-earning', [EarningController::class, 'index']);
Route::get('history', [EarningController::class, 'history']);
Route::get('investment-history', [EarningController::class, 'investment_history']);
Route::get('withdrawal-history', [EarningController::class, 'withdrawl']);
Route::get('total-earning', [EarningController::class, 'total_earning']);
Route::get('daily-history', [EarningController::class, 'daily_history']);
Route::get('generation-history', [EarningController::class, 'generation_history']);
Route::get('incentive-history', [EarningController::class, 'incentive_history']);
Route::get('salary-history', [EarningController::class, 'salary_history']);

Route::get('message-center', [MessageController::class, 'index']);
Route::post('sendmessage', [MessageController::class, 'sendmesage']);

});



// for admin start

Route::get('/admin-login', [AdminLoginController::class, 'index']);
Route::post('/adminlogincheck', [AdminLoginController::class, 'admnilogin_check']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    
Route::get('dashboard', [AdminDashbaordController::class, 'index']);
Route::get('logout', [AdminLoginController::class, 'logout']);


Route::prefix('settings')->group(function () {

    Route::get('packagemanage', [PackageController::class, 'index']);
    Route::get('packagemanage/form', [PackageController::class, 'form']);
    Route::get('packagemanage/edit/{id}', [PackageController::class, 'edit']);
    Route::post('packagemanage/store', [PackageController::class, 'store']);
    Route::post('packagemanage/update/{id}', [PackageController::class, 'updated']);


    Route::get('exclusive-manage', [ExclusiveAdminController::class, 'index']);
    Route::get('exclusive-manage/form', [ExclusiveAdminController::class, 'form']);
    Route::get('exclusive-manage/edit/{id}', [ExclusiveAdminController::class, 'edit']);
    Route::post('exclusive-manage/store', [ExclusiveAdminController::class, 'store']);
    Route::post('exclusive-manage/update/{id}', [ExclusiveAdminController::class, 'updated']);
    

    Route::get('generation', [GenerationPlanController::class, 'index']);
    Route::get('generation/edit/{id}', [GenerationPlanController::class, 'show']);
    Route::post('generation/update/{id}', [GenerationPlanController::class, 'updated']);



   
    Route::get('wallet-accounts', [WalletAccountController::class, 'index']);
    Route::get('wallet-accounts/form', [WalletAccountController::class, 'form']);
    Route::get('wallet-accounts/edit/{id}', [WalletAccountController::class, 'edit']);
    Route::post('wallet-accounts/store', [WalletAccountController::class, 'store']);
    Route::post('wallet-accounts/update/{id}', [WalletAccountController::class, 'updated']);



    Route::get('setting', [SettingsController::class, 'setting']);

    Route::post('setting', [SettingsController::class, 'setting_update']);
    Route::get('logo', [SettingsController::class, 'logo']);
    Route::post('logo', [SettingsController::class, 'logo_update']); 

    Route::get('metasetting', [SettingsController::class, 'metasetting']);
    Route::post('metasetting', [SettingsController::class, 'metasetting_update']);
    
    Route::get('homecontent', [SettingsController::class, 'homecontent']);
    Route::post('homecontent', [SettingsController::class, 'homecontent_update']);
    
    Route::get('about-us', [SettingsController::class, 'about_us']);
    Route::post('about-us', [SettingsController::class, 'about_us_update']);
    Route::get('termsofservice', [SettingsController::class, 'terms']);
    Route::post('termsofservice', [SettingsController::class, 'terms_update']);
});



Route::prefix('companyfund')->group(function () {
    Route::get('/index', [CompanyFundController::class, 'index']);
    Route::get('/statement', [CompanyFundController::class, 'statement']);
    Route::post('/store', [CompanyFundController::class, 'store']);
});

Route::prefix('companycommission')->group(function () {
    Route::get('/form', [CompanyCommissionContrller::class, 'form']);
    Route::get('/statement', [CompanyCommissionContrller::class, 'index']);
    Route::post('/store', [CompanyCommissionContrller::class, 'store']);
});




Route::prefix('message')->group(function () {
    Route::get('/inbox', [MessageController::class, 'admin_index']);
    Route::get('/show/{id}', [MessageController::class, 'admin_show']);
    Route::post('reply', [MessageController::class, 'reply']);
});



Route::prefix('customer')->group(function () {
    Route::get('/index', [CustomerController::class, 'index']);
    Route::get('/activemember', [CustomerController::class, 'activemember']);

    Route::get('/custoermlogin/{id}', [CustomerController::class, 'custoermlogin']);
    Route::get('/edit/{id}', [CustomerController::class, 'edit']);
    Route::post('/update/{id}', [CustomerController::class, 'update']);
    Route::get('/transfer', [CustomerController::class, 'transfer']);
    Route::post('/transferstore', [CustomerController::class, 'transferstore']);

    Route::get('/withdrawal', [CustomerController::class, 'withdrawal']);

    Route::get('/member-rank', [CustomerController::class, 'rank']);

    Route::get('/royalty-transfer', [CustomerController::class, 'royalty_tran']);
    Route::post('/royalitystore', [CustomerController::class, 'royalitystore']);
    Route::get('/deposit', [CustomerController::class, 'deposit']);
    Route::get('/deposit-report', [CustomerController::class, 'deposit_report']);
    Route::get('/invstment-report', [CustomerController::class, 'invstment_report']);
    Route::get('/income-report', [CustomerController::class, 'income_report']);
    Route::get('/exclusive-report', [ExclusiveAdminController::class, 'exclusive_report']);
    Route::get('/transfer-report', [CustomerController::class, 'transfer_report']);
    Route::get('/royalty-report', [CustomerController::class, 'troyalty_report']);
    Route::get('/tax-report', [CustomerController::class, 'tax_report']);
    Route::get('/deposit-rejected/{id}', [CustomerController::class, 'deposit_rejected']);
    Route::get('/deposit-paid/{id}', [CustomerController::class, 'deposit_paid']);
    Route::get('/withdrawal-paid/{id}', [CustomerController::class, 'withdrawal_paid']);
    Route::get('/withdrawal-reject/{id}', [CustomerController::class, 'withdrawal_reject']);
    Route::get('/withdrawal-report', [CustomerController::class, 'withdrawal_report']);
});

});