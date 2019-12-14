<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::domain('{sub}.abstract.test')->group(function () {
    /*******************
     * ******* Investor Servicing, Sub Domain
     **************/
    Route::get('/choose-investment', 'SubInvestorServicingController@choose');
});

// @todo Protect routes
Route::get('/tax-documents/{type?}/{rand?}/{id?}', 'SubInvestorServicingController@tax');
Route::get('/reports/{type?}/{rand?}/{id?}', 'SubInvestorServicingController@reports');
Route::get('/trade/{type?}/{rand?}/{id?}', 'SubInvestorServicingController@trade');
// settings
Route::get('/account-settings/investor-info', 'SubInvestorServicingController@investorInfo');
Route::get('/account-settings/bank-account', 'SubInvestorServicingController@bank');
Route::get('/account-settings/electronic-consent', 'SubInvestorServicingController@consent');
Route::get('/account-settings/password-two-factor', 'SubInvestorServicingController@password');

Route::get('/', function () {
    $hostname = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    return view('welcome')->with('hostname', explode('.', $hostname, 2)[0]);
});

// Sessions
Route::get('/login', 'SessionController@getLogin')->name('login');
Route::post('/login', 'SessionController@doLogin');
Route::get('/register', 'SessionController@getRegister');
Route::post('/register', 'SessionController@doRegister');
Route::get('/invite/{invitecode?}', 'SessionController@getInvite');
Route::post('/invite/{invitecode?}', 'SessionController@doInvite');
Route::get('/logout', 'SessionController@doLogout');
Route::get('/forget-password', 'SessionController@getForget');
Route::post('/forget-password', 'SessionController@doForget');
Route::get('/reset-password/{resetcode?}', 'SessionController@getResetPassword');
Route::post('/reset-password/{resetcode?}', 'SessionController@doResetPassword');

// Dashboard
Route::get('/dashboard', 'DashboardController@dashboard');
Route::get('/portfolio', 'DashboardController@portfolio');
Route::post('/dashboard', 'DashboardController@dashboard');
Route::post('/portfolio', 'DashboardController@portfolio');

// Onboarding
Route::get('/welcome', 'WelcomeController@userType');
Route::post('/welcome', 'WelcomeController@setUserType');
Route::get('/welcome/overview', 'WelcomeController@allSet');

// Sponsors
Route::get('/sponsor/welcome', 'SponsorController@welcome');
Route::get('/sponsor/introduction', 'SponsorController@intro');
Route::get('/sponsor/schedule-demo', 'SponsorController@scheduleDemo');

//For sponsor account approve (Email)
Route::get('/sponsor/approve', 'ForApprovalController@sponsorApprove');
Route::get('/sponsor/reject', 'ForApprovalController@sponsorReject');
Route::post('/sponsor/rejected', 'ForApprovalController@sponsorRejected');

//For property approve (Email)
Route::get('/property/approve', 'ForPropertyApprovalController@propertyApprove');
Route::get('/property/reject', 'ForPropertyApprovalController@propertyReject');
Route::post('/property/rejected', 'ForPropertyApprovalController@propertyRejected');

//For fund approve (Email)
Route::get('/fund/approve', 'ForFundApprovalController@fundApprove');
Route::get('/fund/reject', 'ForFundApprovalController@fundReject');
Route::post('/fund/rejected', 'ForFundApprovalController@fundRejected');

//For investor property approve (Email)
Route::get('/investor/approve', 'ForInvestorApprovalController@propertyApprove');
Route::get('/investor/reject', 'ForInvestorApprovalController@propertyReject');

//Notification
Route::get('/push','PushController@push')->name('array_push(array, var)');
Route::patch('notifications/{id}/read', 'NotificationController@markAsRead');
Route::get('notifications', 'NotificationController@index');
Route::post('notifications/mark-all-read', 'NotificationController@markAllRead');

// Push Subscriptions
Route::post('subscriptions', 'PushSubscriptionController@update');
Route::post('subscriptions/delete', 'PushSubscriptionController@destroy');

// Sponsor Diligence
Route::get('/diligence/verification', 'DiligenceController@verification');
Route::post('/diligence/verification/create', 'DiligenceController@createVerification');

// Bio (About the Sponsor)
Route::get('/diligence/bio', 'DiligenceController@bio');
Route::post('/diligence/bio/create', 'DiligenceController@createBio');

// Principles (Meet The Principles, Property Owners, and Fund Managers)

Route::get('/diligence/principles', 'DiligenceController@principles');
Route::post('/principles/create', 'Principles@createPrinciples');
Route::delete('/principles/delete', 'Principles@deletePrinciple');

// References (Professional References)
Route::get('/diligence/references', 'DiligenceController@references');
Route::post('/diligence/references/create', 'DiligenceController@createReferences');

// Diligence (Sponsor Diligence with Ease)

Route::get('/diligence/documents', 'DiligenceController@diligence');
Route::post('/diligence/documents/create', 'DiligenceController@createDiligence');

// Preview
Route::get('/diligence/preview', 'DiligenceController@preview');
Route::post('/diligence/preview/create', 'DiligenceController@submitPreview');

// Account Verification Entire
Route::get('/account-settings/verification/entire', 'AccountSettingsController@entire');

Route::get('/account-settings/wallets', 'AccountSettingsController@wallets');
Route::get('/account-settings/privacy', 'AccountSettingsController@privacy');
Route::post('/account-settings/privacy', 'AccountSettingsController@updatePrivacy');
Route::get('/account-settings/password', 'AccountSettingsController@passwordAnd2FA');
Route::post('/account-settings/password', 'AccountSettingsController@updatePassword');
Route::get('/account-settings/document', 'AccountSettingsController@document');
Route::get('/account-settings/export', 'AccountSettingsController@exportData');
Route::post('/account-settings/verification/create', 'AccountSettingsController@submitPreview');
Route::post('/account-settings/create-account', 'AccountSettingsController@createAccount');
Route::get('/account-settings/custody-account', 'AccountSettingsController@custodyAccount');
Route::post('/account-settings/deposit-funds/{id?}', 'AccountSettingsController@depositFunds');

// Get Principles
Route::get('/principles/get', 'Principles@getPrinciples');

// Save Data
Route::post('/account-settings/create/{principles?}', 'AccountSettingsController@saveData');

/*******************
 * ******* Security Flow
 **************/
//step 1
Route::get('/security-flow/step-1/choose', 'SecurityFlow@choose');
Route::get('/security-flow/step-1/upload-photos', 'SecurityFlow@upload');
Route::get('/security-flow/step-1/details', 'SecurityFlow@details');
Route::get('/security-flow/step-1/highlights', 'SecurityFlow@highlights');
//step 2
Route::get('/security-flow/step-2/ownership', 'SecurityFlow@ownership');
//step 3
Route::get('/security-flow/step-3/diligence', 'SecurityFlow@diligence');
//step 4
Route::get('/security-flow/step-4/key-points', 'SecurityFlow@keyPoints');
//step 5
Route::get('/security-flow/step-5/capital-stack', 'SecurityFlow@capitalStack');
//step 6
Route::get('/security-flow/step-6/meet-sponsors', 'SecurityFlow@meetSponsors');
//step 7
Route::get('/security-flow/step-7/preview', 'SecurityFlow@preview');
Route::get('/security-flow/preview', 'SecurityFlow@final');

// save post data into a session
Route::post('/security-flow/step-1/create/{details?}', 'SecurityFlow@saveData');
Route::post('/security-flow/step-1/create/{highlights?}', 'SecurityFlow@saveData');
Route::post('/security-flow/step-2/create/{ownership?}', 'SecurityFlow@saveData');
Route::post('/security-flow/step-4/create/{keyPoints?}', 'SecurityFlow@saveData');
Route::post('/security-flow/step-5/create/{capitalStack?}', 'SecurityFlow@saveData');
Route::post('/security-flow/step-6/create/{meetSponsors?}', 'SecurityFlow@saveData');
Route::post('/security-flow/step-7/create/preview', 'SecurityFlow@submitPreview');


/*******************
 * ******* Security Fund Flow
 **************/
//step 1
Route::get('/security-fund-flow/step-1/choose', 'SecurityFundFlow@choose');
Route::get('/security-fund-flow/step-1/details', 'SecurityFundFlow@details');
Route::get('/security-fund-flow/step-1/details-no', 'SecurityFundFlow@detailsno');
Route::get('/security-fund-flow/step-1/upload-photos', 'SecurityFundFlow@upload');
Route::get('/security-fund-flow/step-1/highlights', 'SecurityFundFlow@highlights');
//step 2
Route::get('/security-fund-flow/step-2/ownership', 'SecurityFundFlow@ownership');
//step 3
Route::get('/security-fund-flow/step-3/diligence', 'SecurityFundFlow@diligence');
//step 4
Route::get('/security-fund-flow/step-4/key-points', 'SecurityFundFlow@keyPoints');
//step 5
Route::get('/security-fund-flow/step-5/capital-stack', 'SecurityFundFlow@capitalStack');
//step 6
Route::get('/security-fund-flow/step-6/meet-sponsors', 'SecurityFundFlow@meetSponsors');
//step 7
Route::get('/security-fund-flow/step-7/preview', 'SecurityFundFlow@preview');
Route::get('/security-fund-flow/preview', 'SecurityFundFlow@final');

// save post data into a session
Route::post('/security-fund-flow/step-1/create/{details?}', 'SecurityFundFlow@saveData');
Route::post('/security-fund-flow/step-1/create/{highlights?}', 'SecurityFundFlow@saveData');
Route::post('/security-fund-flow/step-2/create/{ownership?}', 'SecurityFundFlow@saveData');
Route::post('/security-fund-flow/step-4/create/{keyPoints?}', 'SecurityFundFlow@saveData');
Route::post('/security-fund-flow/step-5/create/{capitalStack?}', 'SecurityFundFlow@saveData');
Route::post('/security-fund-flow/step-6/create/{meetSponsors?}', 'SecurityFundFlow@saveData');
Route::post('/security-fund-flow/step-7/create/preview', 'SecurityFundFlow@submitPreview');

/*******************
 * ******* Properties
 **************/
Route::post('/property/create/new', 'PropertyController@submitPreview');
Route::get('/properties/pending', 'PropertyController@pending');
Route::get('/properties/approved', 'PropertyController@approved');
// for the demo
Route::get('/create/recap/metrics/{type?}/{rand}/{id?}', 'PropertyController@recap');

/*******************
 * ******* Marketplace
 **************/
Route::get('/marketplace/details/{type?}/{rand}/{id?}', 'Marketplace@new');
Route::get('/marketplace', 'Marketplace@mcg');
// Details Fill Void (Learn More) for Demo Purposes
Route::get('/marketplace/details/learn-more', 'Marketplace@learnmoreDummy');

Route::get('/properties/choose/sticker/{type?}/{rand}/{id?}', 'PropertyController@sticker');
Route::get('/investment/metrics/{type?}/{rand}/{id?}', 'PropertyController@metrics');
Route::get('/edit/security-flow/{type?}/{id?}', 'PropertyController@edit');


/*******************
 * ******* Investor Servicing
 **************/

Route::get('/investor-servicing/k1', 'InvestorServicingController@k1');
Route::get('/investor-servicing/choose-investment', 'InvestorServicingController@choose');
Route::get('/investor-servicing/cap-table-mgmt/{type?}/{rand?}/{id?}', 'InvestorServicingController@captable');
Route::get('/investor-servicing/cap-table/download/{type?}/{id?}', 'InvestorServicingController@downloadCapTableCSV');
Route::get('/investor-servicing/cap-table/export/{type?}/{id?}', 'InvestorServicingController@exportCaptable');
Route::get('/investor-servicing/reports/{type?}/{rand?}/{id?}', 'InvestorServicingController@reports');
Route::get('/investor-servicing/upload-new-property', 'PropertyController@newProperty');
Route::get('/investor-servicing/tax-document', 'InvestorServicingController@tax');
Route::get('/investor-servicing/reports/dt/{type?}/{rand?}/{id?}', 'InvestorServicingController@dst');
Route::get('/investor-servicing/download/reports/{type?}/{rand?}/{id?}', 'InvestorServicingController@downloadDSTReportPdf');
Route::get('/ownership-snapshot/{type?}/{rand?}/{id?}', 'InvestorServicingController@ownershipCap');
Route::post('/reports/create/new', 'InvestorServicingController@reportsCreate');
Route::get('/view-oldreports/{report_id?}/{report_type?}', 'InvestorServicingController@reportsViewOld');
Route::get('/investor-servicing/investor/reports/{type?}/{rand?}/{id?}', 'InvestorServicingController@investorReport');
Route::get('/investor-servicing/sponsor/reports/{id?}', 'InvestorServicingReportsController@get');
Route::get('/view-investment', 'SubInvestorServicingController@choose');


// Distributions
Route::post('/distributions/create/new', 'DistributionsController@submitDistributions');
Route::get('/investor-servicing/distributions/{type?}/{rand?}/{id?}', 'DistributionsController@distributions');

Route::get('/investor-servicing/distributions/preview/{type?}/{rand?}/{id?}/{distribution_id?}', 'DistributionsController@preview');
Route::get('/investor-servicing/distributions/nacha/{type?}/{rand?}/{id?}', 'DistributionsController@getNACHA');
Route::get('/investor-servicing/distributions/csv/{type?}/{rand?}/{id?}', 'DistributionsController@getCSV');

Route::post('/distributions/preview/new', 'DistributionsController@download');

// Tax
Route::get('/investor-servicing/tax-document/{type?}/{rand?}/{id?}', 'InvestorServicingController@tax');
Route::post('/tax/create/new', 'InvestorServicingController@taxCreate');

/*******************
 * ******* Files
 **************/

Route::get('/getFiles', 'FilesController@retrieve');
Route::get('/destroy/file', 'FilesController@destroy');
Route::resource('files', 'FilesController', ['only' => ['store']]);

// Diligence
Route::get('/files/diligence/check', 'FilesController@checkDir');
// Test Files
Route::get('/testCap', 'FilesController@readDocFiles');

/*******************
 * ******* Box API
 **************/

Route::get('/box/access-token', 'BoxController@generateAccessToken');

// Folders
Route::get('/box/rootfolder', 'BoxController@rootFolder');
Route::get('/box/folder/items/{id?}', 'BoxController@getFolderItems');
Route::post('/box/folder/create', 'BoxController@createFolder');
Route::post('/box/folder/update', 'BoxController@updateFolder');
Route::get('/box/folder/delete/{id?}', 'BoxController@deleteFolder');
Route::get('/box/folder/trash/{id?}', 'BoxController@permanentDeleteFolder');
Route::post('/box/folder/copy', 'BoxController@copyFolder');
Route::get('/box/folder/share/{id?}', 'BoxController@getShareFolder');

// Files
Route::get('/box/file/{id?}', 'BoxController@getFileInfo');
Route::post('/box/file/update', 'BoxController@updateFileInfo');
Route::get('/box/file/download/{id?}', 'BoxController@downloadFile');
Route::post('/box/file/upload', 'BoxController@uploadFile');
Route::get('/box/file/delete/{id?}', 'BoxController@deleteFile');
Route::post('/box/file/replace', 'BoxController@updateFile');
Route::post('/box/file/copy', 'BoxController@copyFile');
Route::get('/box/file/embed/{id?}', 'BoxController@getEmbedLink');
Route::get('/box/file/thumbnail/{id?}', 'BoxController@getThumbnail');
Route::get('/box/file/share/{id?}', 'BoxController@getShareFile');

/*******************
 * ******* Chart Info
 **************/

Route::get('/cap/chart/info', 'Chart@saveCap');
