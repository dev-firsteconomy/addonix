<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\AccountIndustryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadSourceController;
use App\Http\Controllers\OpportunitiesStageController;
use App\Http\Controllers\CommonCaseController;
use App\Http\Controllers\OpportunitiesController;
use App\Http\Controllers\CaseTypeController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStageController;
use App\Http\Controllers\DocumentFolderController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\CampaignTypeController;
use App\Http\Controllers\TargetListController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentWallController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductTaxController;
use App\Http\Controllers\ShippingProviderController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\FormBuilderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\clientPayWithPaypal;
use App\Http\Controllers\PaystackPaymentController;
use App\Http\Controllers\FlutterwavePaymentController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\PaytmPaymentController;
use App\Http\Controllers\MercadoPaymentController;
use App\Http\Controllers\MolliePaymentController;
use App\Http\Controllers\SkrillPaymentController;
use App\Http\Controllers\CoingatePaymentController;
use App\Http\Controllers\LandingPageSectionsController;
use App\Http\Controllers\PlanRequestController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EmailTemplateLangController;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ToyyibpayController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PayfastController;
use App\Http\Controllers\UserlogController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\NotificationTemplatesController;

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


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {


//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(['XSS']);

Route::any('/cookie-consent', [SettingController::class,'CookieConsent'])->name('cookie-consent');

Route::any('/all-data', [DashboardController::class, 'get_data'])->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('plan', PlanController::class);
Route::get('quote/pdf/{id}', [QuoteController::class, 'pdf'])->name('quote.pdf')->middleware(['XSS']);
Route::get('salesorder/pdf/{id}', [SalesOrderController::class, 'pdf'])->name('salesorder.pdf')->middleware(['XSS']);

Route::resource('form_builder', FormBuilderController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('/form/{code}', [FormBuilderController::class, 'formView'])->name('form.view')->middleware(['XSS']);
Route::post('/form_view_store', [FormBuilderController::class, 'formViewStore'])->name('form.view.store')->middleware(['XSS']);
Route::post('/form_field_store/{id}', [FormBuilderController::class, 'bindStore'])->name('form.bind.store')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('invoice/pdf/{id}', [InvoiceController::class, 'pdf'])->name('invoice.pdf')->middleware(['XSS']);
Route::get('/invoice/pay/{invoice}', [InvoiceController::class, 'payinvoice'])->name('pay.invoice');
//================================= Invoice Payment Gateways  ====================================//
Route::post('/invoices/{id}/payment', [InvoiceController::class, 'addPayment'])->name('client.invoice.payment');
Route::post('/{id}/pay-with-paypal', [PaypalController::class, 'clientPayWithPaypal'])->name('client.pay.with.paypal');
Route::get('/{id}/{amount}/get-payment-status', [PaypalController::class, 'clientGetPaymentStatus'])->name('client.get.payment.status');

Route::get('/stripe-payment-status', [StripePaymentController::class, 'planGetStripePaymentStatus'])->name('stripe.payment.status');

Route::post('/invoice-pay-with-paystack', [PaystackPaymentController::class, 'invoicePayWithPaystack'])->name('invoice.pay.with.paystack');
Route::get('/invoice/paystack/{pay_id}/{invoice_id}', [PaystackPaymentController::class, 'getInvociePaymentStatus'])->name('invoice.paystack');

Route::post('/invoice-pay-with-flaterwave', [FlutterwavePaymentController::class, 'invoicePayWithFlutterwave'])->name('invoice.pay.with.flaterwave');
Route::get('/invoice/flaterwave/{txref}/{invoice_id}', [FlutterwavePaymentController::class, 'getInvociePaymentStatus'])->name('invoice.flaterwave');

Route::post('/invoice-pay-with-razorpay', [RazorpayPaymentController::class, 'invoicePayWithRazorpay'])->name('invoice.pay.with.razorpay');
Route::get('/invoice/razorpay/{txref}/{invoice_id}', [RazorpayPaymentController::class, 'getInvociePaymentStatus'])->name('invoice.razorpay');

Route::post('/invoice-pay-with-paytm', [PaytmPaymentController::class, 'invoicePayWithPaytm'])->name('invoice.pay.with.paytm');
Route::post('/invoice/paytm/{invoice}', [PaytmPaymentController::class, 'getInvociePaymentStatus'])->name('invoice.paytm');

Route::post('/invoice-pay-with-mercado', [MercadoPaymentController::class, 'invoicePayWithMercado'])->name('invoice.pay.with.mercado');
Route::get('/invoice/mercado/{invoice}', [MercadoPaymentController::class, 'getInvociePaymentStatus'])->name('invoice.mercado');

Route::post('/invoice-pay-with-mollie', [MolliePaymentController::class, 'invoicePayWithMollie'])->name('invoice.pay.with.mollie');
Route::get('/invoice/mollie/{invoice}', [MolliePaymentController::class, 'getInvociePaymentStatus'])->name('invoice.mollie');

Route::post('/invoice-pay-with-skrill', [SkrillPaymentController::class, 'invoicePayWithSkrill'])->name('invoice.pay.with.skrill');
Route::get('/invoice/skrill/{invoice}', [SkrillPaymentController::class, 'getInvociePaymentStatus'])->name('invoice.skrill');

Route::post('/invoice-pay-with-coingate', [CoingatePaymentController::class, 'invoicePayWithCoingate'])->name('invoice.pay.with.coingate');
Route::get('/invoice/coingate/{invoice}', [CoingatePaymentController::class, 'getInvociePaymentStatus'])->name('invoice.coingate');

Route::post('/invoice-pay-with-stripe', [StripePaymentController::class, 'invoicePayWithStripe'])->name('invoice.pay.with.stripe');
Route::get('/invoice/stripe/{invoice_id}', [StripePaymentController::class, 'getInvociePaymentStatus'])->name('invoice.stripe');

Route::post('/invoice-with-toyyibpay', [ToyyibpayController::class, 'invoicepaywithtoyyibpay'])->name('invoice.with.toyyibpay');
Route::get('/invoice-toyyibpay-status/{amount}/{invoice_id}', [ToyyibpayController::class, 'invoicetoyyibpaystatus'])->name('invoice.toyyibpay.status');

Route::post('/invoice-with-payfast', [PayfastController::class, 'invoicepaywithpayfast'])->name('invoice.with.payfast');
Route::get('/invoice-payfast-status/{invoice_id}', [PayfastController::class, 'invoicepayfaststatus'])->name('invoice.payfast.status');


Route::get('/invoice/error/{flag}/{invoice_id}', [PaymentWallController::class, 'invoiceerror'])->name('error.invoice.show');
Route::post('/invoicepayment', [PaymentWallController::class, 'invoicepay'])->name('paymentwall.invoice');
Route::post('/invoice-pay-with-paymentwall/{invoice}', [PaymentWallController::class, 'invoicePayWithPaymentWall'])->name('invoice-pay-with-paymentwall');


// Route::

//Route::get('/login/{lang?}', 'Auth\LoginController@showLoginForm')->name('login');
//
//Route::get('/password/resets/{lang?}', 'Auth\LoginController@showLinkRequestForm')->name('change.langPass');


Route::get('/invoice/export', [InvoiceController::class, 'fileExport'])->name('invoice.export');


Route::get('/salesorder/pay/{salesorder}', [SalesOrderController::class, 'paysalesorder'])->name('pay.salesorder');
Route::get('/quote/pay/{quote}', [QuoteController::class, 'payquote'])->name('pay.quote');

Route::get('quote/export', [QuoteController::class, 'fileExport'])->name('quote.export');
Route::get('invoice/pay/pdf/{id}', [InvoiceController::class, 'pdffrominvoice'])->name('invoice.download.pdf');





Route::group(['middleware' => ['verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name( 'dashboard')->middleware(['auth', 'XSS']);


    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {

            Route::get('change-language/{lang}', [LanguageController::class, 'changeLanquage'])->name('change.language')->middleware(['auth', 'XSS']);
            Route::get('manage-language/{lang}', [LanguageController::class, 'manageLanguage'])->name('manage.language')->middleware(['auth', 'XSS']);
            Route::post('store-language-data/{lang}', [LanguageController::class, 'storeLanguageData'])->name('store.language.data')->middleware(['auth', 'XSS']);
            Route::get('create-language', [LanguageController::class, 'createLanguage'])->name('create.language')->middleware(['auth', 'XSS']);
            Route::post('store-language', [LanguageController::class, 'storeLanguage'])->name('store.language')->middleware(['auth', 'XSS']);
            Route::delete('/lang/{lang}', [LanguageController::class, 'destroyLang'])->name('lang.destroy')->middleware(['auth', 'XSS']);
        }
    );

    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('user/grid', [UserController::class, 'grid'])->name('user.grid');

            Route::resource('user', UserController::class);
        }
    );

    Route::resource('userlog',UserlogController::class);
    Route::delete('/userlog/{id}/', [UserlogController::class, 'destroy'])->name('userlog.destroy')->middleware(['auth','XSS']);
    Route::get('userlog-view/{id}/', [UserlogController::class, 'view'])->name('userlog.view')->middleware(['auth','XSS']);

    Route::resource('webhook', WebhookController::class);



    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('permission', PermissionController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('role', RoleController::class);
        }
    );

    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('account/grid', [AccountController::class, 'grid'])->name('account.grid');
            Route::resource('account', AccountController::class);

            Route::get('account/create/{type}/{id}', [AccountController::class, 'create'])->name('account.create');
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('account_type', AccountTypeController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('account_industry', AccountIndustryController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('contact/grid', [ContactController::class, 'grid'])->name('contact.grid');
            Route::resource('contact', ContactController::class);
            Route::get('contact/create/{type}/{id}', [ContactController::class, 'create'])->name('contact.create');
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('lead/grid', [LeadController::class, 'grid'])->name('lead.grid');
            Route::resource('lead', LeadController::class);
            Route::post('lead/change-order', [LeadController::class, 'changeorder'])->name('lead.change.order');
            Route::get('lead/create/{type}/{id}', [LeadController::class, 'create'])->name('lead.create');
            Route::get('lead/{id}/show_convert', [LeadController::class, 'showConvertToAccount'])->name('lead.convert.account');
            Route::post('lead/{id}/convert', [LeadController::class, 'convertToAccount'])->name('lead.convert.to.account');
            
            Route::get('leadSearch', [LeadController::class, 'leadSearch'])->name('lead.leadSearch');
            Route::get('/companies/search', 'CompanyController@search')->name('companies.search');
            Route::get('leadTab', [LeadController::class, 'leadTab'])->name('lead.leadTab');
            Route::get('get-product-price', [LeadController::class, 'getProductPrice'])->name('get-product-price');
            Route::get('addInteration/{id}', [LeadController::class, 'addInteration'])->name('addInteration');
            Route::get('addQuotation/{id}', [LeadController::class, 'addQuotation'])->name('addQuotation');
            Route::get('changeStatus/{id}', [LeadController::class, 'changeStatus'])->name('changeStatus');
            Route::post('submitInteraction', [LeadController::class, 'submitInteraction'])->name('submitInteraction'); 
            Route::post('sendQuotation', [LeadController::class, 'sendQuotation'])->name('sendQuotation'); 
            Route::post('send-approval-mail', [LeadController::class, 'sendApprovalEmail'])->name('leadApprovalMail');           
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('lead_source', LeadSourceController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('opportunities_stage', OpportunitiesStageController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('commoncase/grid', [CommonCaseController::class, 'grid'])->name('commoncases.grid');
            Route::resource('commoncases', CommonCaseController::class);
            Route::get('commoncases/create/{type}/{id}', [CommonCaseController::class, 'create'])->name('commoncases.create');
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('opportunities/grid', [OpportunitiesController::class, 'grid'])->name('opportunities.grid');
            Route::resource('opportunities', OpportunitiesController::class);
            Route::post('opportunities/change-order', [OpportunitiesController::class, 'changeorder'])->name('opportunities.change.order');
            Route::get('opportunities/create/{type}/{id}', [OpportunitiesController::class, 'create'])->name('opportunities.create');
        }
    );

    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('case_type', CaseTypeController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('meeting/grid', [MeetingController::class, 'grid'])->name('meeting.grid');
            Route::post('meeting/getparent', [MeetingController::class, 'getparent'])->name('meeting.getparent');
            Route::resource('meeting', MeetingController::class);
            Route::post('meeting/get_meeting_data', [MeetingController::class, 'get_meeting_data'])->name('meeting.get_meeting_data')->middleware(['auth', 'XSS']);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('call/grid', [CallController::class, 'grid'])->name('call.grid');
            Route::post('call/getparent', [CallController::class, 'getparent'])->name('call.getparent');
            Route::resource('call', CallController::class);
            Route::post('call/get_call_data', [CallController::class, 'get_call_data'])->name('call.get_call_data')->middleware(['auth', 'XSS']);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('task/export', [TaskController::class, 'fileExport'])->name('task.export');
            Route::get('task/grid', [TaskController::class, 'grid'])->name('task.grid');
            Route::post('task/getparent', [TaskController::class, 'getparent'])->name('task.getparent');
            Route::get('task/gantt-chart/{duration?}', [TaskController::class, 'ganttChart'])->name('task.gantt.chart');
            Route::post('task/gantt-chart', [TaskController::class, 'ganttChart'])->name('task.gantt.chart.post')->middleware(
                [
                    'auth',
                    'XSS',
                ]
            );
            Route::resource('task', TaskController::class);
            Route::post('task/get_task_data', [TaskController::class, 'get_task_data'])->name('task.get_task_data')->middleware(['auth', 'XSS']);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('task_stage', TaskStageController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('document_folder', DocumentFolderController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('document_type', DocumentTypeController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('campaign_type', CampaignTypeController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('target_list', TargetListController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('document/grid', [DocumentController::class, 'grid'])->name('document.grid');
            Route::resource('document', DocumentController::class);
            Route::get('document/create/{type}/{id}', [DocumentController::class, 'create'])->name('document.create');
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('campaign/grid', [CampaignController::class, 'grid'])->name('campaign.grid');
            Route::resource('campaign', CampaignController::class);
            Route::get('campaign/create/{type}/{id}', [CampaignController::class, 'create'])->name('campaign.create');
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {

            Route::get('quote/grid', [QuoteController::class, 'grid'])->name('quote.grid');
            Route::get('quote/{id}/convert', [QuoteController::class, 'convert'])->name('quote.convert');
            Route::get('quote/preview/{template}/{color}', [QuoteController::class, 'previewQuote'])->name('quote.preview');
            Route::post('quote/template/setting', [QuoteController::class, 'saveQuoteTemplateSettings'])->name('quote.template.setting');
            Route::post('quote/getaccount', [QuoteController::class, 'getaccount'])->name('quote.getaccount');
            Route::get('quote/quoteitem/{id}', [QuoteController::class, 'quoteitem'])->name('quote.quoteitem');
            Route::post('quote/storeitem/{id}', [QuoteController::class, 'storeitem'])->name('quote.storeitem');
            Route::get('quote/quoteitem/edit/{id}', [QuoteController::class, 'quoteitemEdit'])->name('quote.quoteitem.edit');
            Route::post('quote/storeitem/edit/{id}', [QuoteController::class, 'quoteitemUpdate'])->name('quote.quoteitem.update');
            Route::get('quote/items', [QuoteController::class, 'items'])->name('quote.items');
            Route::delete('quote/items/{id}/delete', [QuoteController::class, 'itemsDestroy'])->name('quote.items.delete');
            Route::resource('quote', QuoteController::class);
            Route::get('quote/create/{type}/{id}', [QuoteController::class, 'create'])->name('quote.create');
            Route::get('quote/{id}/duplicate', [QuoteController::class, 'duplicate'])->name('quote.duplicate');
        }
    );


    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('product/import/export', [ProductController::class, 'fileImportExport'])->name('product.file.import');
            Route::post('product/import', [ProductController::class, 'fileImport'])->name('product.import');
            Route::get('product/export', [ProductController::class, 'fileExport'])->name('product.export');
            Route::get('product/grid', [ProductController::class, 'grid'])->name('product.grid');
            Route::resource('product', ProductController::class);
        }
    );
    Route::get('/plan/error/{flag}', [PaymentWallController::class, 'planerror'])->name('error.plan.show');

    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
        }
    );
    Route::get('user/{id}/plan', [UserController::class, 'upgradePlan'])->name('plan.upgrade')->middleware(
        [
            'auth',
            'XSS',
        ]
    );

    Route::get('user/{id}/plan/{pid}', [UserController::class, 'activePlan'])->name('plan.active')->middleware(
        [
            'auth',
            'XSS',
        ]
    );


    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('product_category', ProductCategoryController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('product_brand', ProductBrandController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('product_tax', ProductTaxController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('shipping_provider', ShippingProviderController::class);
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::post('streamstore/{type}/{id}/{title}', [StreamController::class, 'streamstore'])->name('streamstore');
            Route::resource('stream', StreamController::class);
        }
    );

    Route::any('calendar/{type?}', [CalenderController::class, 'index'])->name('calendar.index')->middleware(
        [
            'auth',
            'XSS',
        ]
    );

    Route::any('/all-data', [CalenderController::class, 'get_data'])->middleware(
        [
            'auth',
            'XSS',
        ]
    );

    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('salesorder/grid', [SalesOrderController::class, 'grid'])->name('salesorder.grid');
            Route::get('salesorder/preview/{template}/{color}', [SalesOrderController::class, 'previewInvoice'])->name('salesorder.preview');
            Route::post('salesorder/template/setting', [SalesOrderController::class, 'saveSalesorderTemplateSettings'])->name('salesorder.template.setting');
            Route::post('salesorder/getaccount', [SalesOrderController::class, 'getaccount'])->name('salesorder.getaccount');
            Route::get('salesorder/salesorderitem/{id}', [SalesOrderController::class, 'salesorderitem'])->name('salesorder.salesorderitem');
            Route::post('salesorder/storeitem/{id}', [SalesOrderController::class, 'storeitem'])->name('salesorder.storeitem');
            Route::get('salesorder/items', [SalesOrderController::class, 'items'])->name('salesorder.items');
            Route::get('salesorder/item/edit/{id}', [SalesOrderController::class, 'salesorderItemEdit'])->name('salesorder.item.edit');
            Route::post('salesorder/item/edit/{id}', [SalesOrderController::class, 'salesorderItemUpdate'])->name('salesorder.item.update');
            Route::delete('salesorder/items/{id}/delete', [SalesOrderController::class, 'itemsDestroy'])->name('salesorder.items.delete');

            Route::resource('salesorder', SalesOrderController::class);

            Route::get('salesorder/create/{type}/{id}', [SalesOrderController::class, 'create'])->name('salesorder.create');
            Route::get('salesorder/{id}/duplicate', [SalesOrderController::class, 'duplicate'])->name('salesorder.duplicate');
        }
    );


    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('invoice/grid', [InvoiceController::class, 'grid'])->name('invoice.grid');
            Route::get('invoice/preview/{template}/{color}', [InvoiceController::class, 'previewInvoice'])->name('invoice.preview');
            Route::post('invoice/template/setting', [InvoiceController::class, 'saveInvoiceTemplateSettings'])->name('invoice.template.setting');



            Route::post('invoice/getaccount', [InvoiceController::class, 'getaccount'])->name('invoice.getaccount');
            Route::get('invoice/invoiceitem/{id}', [InvoiceController::class, 'invoiceitem'])->name('invoice.invoiceitem');
            Route::post('invoice/storeitem/{id}', [InvoiceController::class, 'storeitem'])->name('invoice.storeitem');
            Route::get('invoice/items', [InvoiceController::class, 'items'])->name('invoice.items');
            Route::get('invoice/item/edit/{id}', [InvoiceController::class, 'invoiceItemEdit'])->name('invoice.item.edit');
            Route::post('invoice/item/edit/{id}', [InvoiceController::class, 'invoiceItemUpdate'])->name('invoice.item.update');
            Route::delete('invoice/items/{id}/delete', [InvoiceController::class, 'itemsDestroy'])->name('invoice.items.delete');

            Route::resource('invoice', InvoiceController::class);
            Route::get('invoice/create/{type}/{id}', [InvoiceController::class, 'create'])->name('invoice.create');
            Route::get('invoice/{id}/duplicate', [InvoiceController::class, 'duplicate'])->name('invoice.duplicate');

            // **************** //
            Route::post('invoice/send/{id}', [InvoiceController::class, 'sendmail'])->name('invoice.sendmail');
            // Route::get('invoices-payments', 'InvoiceController@payments')->name('invoices.payments');

            Route::get('invoices-payments', [InvoiceController::class, 'payments'])->name('invoices.payments');
            Route::get('invoices/{id}/payments', [InvoiceController::class, 'paymentAdd'])->name('invoices.payments.create');
            Route::post('invoices/{id}/payments', [InvoiceController::class, 'paymentStore'])->name('invoices.payments.store');
        }
    );
Route::post('cookie-setting', [SettingController::class, 'saveCookieSettings'])->name('cookie.setting');

    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            // Route::post('report/customreport', [ReportController::class, 'customreport'])->name('report.index');
            Route::get('report/export', [ReportController::class, 'fileexport'])->name('report.export');
            Route::get('report/leadsanalytic', [ReportController::class, 'leadsanalytic'])->name('report.leadsanalytic');
            Route::get('report/invoiceanalytic', [ReportController::class, 'invoiceanalytic'])->name('report.invoiceanalytic');
            Route::get('report/salesorderanalytic', [ReportController::class, 'salesorderanalytic'])->name('report.salesorderanalytic');
            Route::get('report/quoteanalytic', [ReportController::class, 'quoteanalytic'])->name('report.quoteanalytic');

            Route::post('report/usersrate', [ReportController::class, 'usersrate'])->name('report.usersrate');
            Route::post('report/getparent', [ReportController::class, 'getparent'])->name('report.getparent');
            Route::post('report/supportanalytic', [ReportController::class, 'supportanalytic'])->name('report.supportanalytic');



            Route::resource('report', ReportController::class);
        }
    );

    Route::get('invoice/link/{id}', [InvoiceController::class, 'invoicelink'])->name('invoice.link');




    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::post('business-setting', [SettingController::class, 'saveBusinessSettings'])->name('business.setting');
            Route::post('company-setting', [SettingController::class, 'saveCompanySettings'])->name('company.setting');
            Route::post('email-setting', [SettingController::class, 'saveEmailSettings'])->name('email.setting');
            Route::post('system-setting', [SettingController::class, 'saveSystemSettings'])->name('system.setting');
            Route::post('pusher-setting', [SettingController::class, 'savePusherSettings'])->name('pusher.setting');
            Route::post('test', [SettingController::class, 'testMail'])->name('test.mail');
            Route::get('test', [SettingController::class, 'testMail'])->name('test.mail');
            Route::post('test-mail', [SettingController::class, 'testSendMail'])->name('test.send.mail');
            Route::post('setting/google-calender', [SettingController::class, 'saveGoogleCalenderSettings'])->name('google.calender.settings');
            Route::post('setting/seo', [SettingController::class, 'saveSEOSettings'])->name('seo.settings');

            Route::get('/config-cache', function () {
                Artisan::call('cache:clear');
                Artisan::call('route:clear');
                Artisan::call('view:clear');
                Artisan::call('optimize:clear');
                return redirect()->back()->with('success', 'Clear Cache successfully.');
            });

            Route::get('settings', [SettingController::class, 'index'])->name('settings');
            Route::post('payment-setting', [SettingController::class, 'savePaymentSettings'])->name('payment.setting');
            Route::post('owner-payment-setting', [SettingController::class, 'saveOwnerPaymentSettings'])->name('owner.payment.setting');
        }
    );
    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::get('order', [StripePaymentController::class, 'index'])->name('order.index');
            Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

            //Route::get('/stripe/{code}', 'StripePaymentController@stripe')->name('stripe');
        }
    );
    Route::get('notification_templates/{id?}/{lang?}/', [NotificationTemplatesController::class, 'index'])->name('notification_templates.index')->middleware('auth','XSS');

    Route::resource('notification-templates', NotificationTemplatesController::class)->middleware(
        [
            'auth',
            'XSS',
        ]
    );


    Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::post('change-password', [UserController::class, 'updatePassword'])->name('update.password');
    Route::any('edit-profile', [UserController::class, 'editprofile'])->name('update.account')->middleware(
        [
            'auth',
            'XSS',
        ]
    );

    Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon')->middleware(
        [
            'auth',
            'XSS',
        ]
    );

    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {
            Route::resource('coupon', CouponController::class);
        }
    );
    Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon')->middleware(
        [
            'auth',
            'XSS',
        ]
    );

    Route::get('/change/mode', [UserController::class, 'changeMode'])->name('change.mode');


    Route::post('plan-pay-with-paypal', [PaypalController::class, 'planPayWithPaypal'])->name('plan.pay.with.paypal')->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::get('{id}/{amount}/plan-get-payment-status', [PaypalController::class, 'planGetPaymentStatus'])->name('plan.get.payment.status')->middleware(
        [
            'auth',
            'XSS',
        ]
    );

    // Form Builder


    // Form link base view


    // Form Field
    Route::get('/form_builder/{id}/field', [FormBuilderController::class, 'fieldCreate'])->name('form.field.create')->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::post('/form_builder/{id}/field', [FormBuilderController::class, 'fieldStore'])->name('form.field.store')->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::get('/form_builder/{id}/field/{fid}/show', [FormBuilderController::class, 'fieldShow'])->name('form.field.show')->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::get('/form_builder/{id}/field/{fid}/edit', [FormBuilderController::class, 'fieldEdit'])->name('form.field.edit')->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::post('/form_builder/{id}/field/{fid}', [FormBuilderController::class, 'fieldUpdate'])->name('form.field.update')->middleware(
        [
            'auth',
            'XSS',
        ]
    );

    Route::delete('/form_builder/{id}/field/{fid}', [FormBuilderController::class, 'fieldDestroy'])->name('form.field.destroy')->middleware(
        [
            'auth',
            'XSS',
        ]
    );




    // Form Response
    Route::get('/form_response/{id}', [FormBuilderController::class, 'viewResponse'])->name('form.response')->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::get('/response/{id}', [FormBuilderController::class, 'responseDetail'])->name('response.detail')->middleware(
        [
            'auth',
            'XSS',
        ]
    );

    // Form Field Bind
    Route::get('/form_field/{id}', [FormBuilderController::class, 'formFieldBind'])->name('form.field.bind')->middleware(
        [
            'auth',
            'XSS',
        ]
    );

    // end Form Builder


    //****
    Route::resource('payments', PaymentController::class)->middleware(['auth', 'XSS',]);
    Route::get('/Plan/Payment/{code}', [PlanController::class, 'getpaymentgatway'])->name('plan.payment')->middleware(['auth', 'XSS',]);



    //================================= Plan Payment Gateways  ====================================//
    Route::post('/plan-pay-with-paystack', [PaystackPaymentController::class, 'planPayWithPaystack'])->name('plan.pay.with.paystack')->middleware(['auth', 'XSS']);
    Route::get('/plan/paystack/{pay_id}/{plan_id}', [PaystackPaymentController::class, 'getPaymentStatus'])->name('plan.paystack');

    Route::post('/plan-pay-with-flaterwave', [FlutterwavePaymentController::class, 'planPayWithFlutterwave'])->name('plan.pay.with.flaterwave')->middleware(['auth', 'XSS']);
    Route::get('/plan/flaterwave/{txref}/{plan_id}', [FlutterwavePaymentController::class, 'getPaymentStatus'])->name('plan.flaterwave');

    Route::post('/plan-pay-with-razorpay', [RazorpayPaymentController::class, 'planPayWithRazorpay'])->name('plan.pay.with.razorpay')->middleware(['auth', 'XSS']);
    Route::get('/plan/razorpay/{txref}/{plan_id}', [RazorpayPaymentController::class, 'getPaymentStatus'])->name('plan.razorpay');

    Route::post('/plan-pay-with-paytm', [PaytmPaymentController::class, 'planPayWithPaytm'])->name('plan.pay.with.paytm')->middleware(['auth', 'XSS']);
    Route::post('/plan/paytm/{plan}', [PaytmPaymentController::class, 'getPaymentStatus'])->name('plan.paytm');


    Route::post('/plan-pay-with-mercado', [MercadoPaymentController::class, 'planPayWithMercado'])->name('plan.pay.with.mercado')->middleware(['auth', 'XSS']);
    Route::get('/plan/mercado/{plan}', [MercadoPaymentController::class, 'getPaymentStatus'])->name('plan.mercado');

    Route::post('/plan-pay-with-mollie', [MolliePaymentController::class, 'planPayWithMollie'])->name('plan.pay.with.mollie')->middleware(['auth', 'XSS']);
    Route::get('/plan/mollie/{plan}', [MolliePaymentController::class, 'getPaymentStatus'])->name('plan.mollie');

    Route::post('/plan-pay-with-skrill', [SkrillPaymentController::class, 'planPayWithSkrill'])->name('plan.pay.with.skrill')->middleware(['auth', 'XSS']);
    Route::get('/plan/skrill/{plan}', [SkrillPaymentController::class, 'getPaymentStatus'])->name('plan.skrill');

    Route::post('/plan-pay-with-coingate', [CoingatePaymentController::class, 'planPayWithCoingate'])->name('plan.pay.with.coingate')->middleware(['auth', 'XSS']);
    Route::get('/plan/coingate/{plan}', [CoingatePaymentController::class, 'getPaymentStatus'])->name('plan.coingate');


    Route::post('/planpayment', [PaymentWallController::class, 'planpay'])->name('paymentwall')->middleware(['auth', 'XSS']);
    Route::post('/paymentwall-payment/{plan}', [PaymentWallController::class, 'planPayWithPaymentWall'])->name('paymentwall.payment')->middleware(['auth', 'XSS']);

    Route::post('/plan-pay-with-toyyibpay', [ToyyibpayController::class, 'planPayWithToyyibpay'])->name('plan.pay.with.toyyibpay');
    Route::get('/plan-pay-with-toyyibpay/{amount}/{couponCode}', [ToyyibpayController::class, 'planGetPaymentStatus'])->name('plan.toyyibpay');

    // plan payfast
    Route::post('payfast-plan', [PayfastController::class, 'index'])->name('payfast.payment')->middleware(['auth']);
    Route::get('payfast-plan/{success}', [PayfastController::class, 'success'])->name('payfast.payment.success')->middleware(['auth']);

    //================================= Custom Landing Page ====================================//
    Route::get('/landingpage', [LandingPageSectionsController::class, 'index'])->name('custom_landing_page.index')->middleware(['auth', 'XSS']);
    Route::get('/LandingPage/show/{id}', [LandingPageSectionsController::class, 'show']);
    Route::post('/LandingPage/setConetent', [LandingPageSectionsController::class, 'setConetent'])->middleware(['auth', 'XSS']);

    Route::get('/get_landing_page_section/{name}', function ($name) {
        $plans = DB::table('plans')->get();
        return view('custom_landing_page.' . $name, compact('plans'));
    });
    Route::post('/LandingPage/removeSection/{id}', [LandingPageSectionsController::class, 'removeSection'])->middleware(['auth', 'XSS']);
    Route::post('/LandingPage/setOrder', [LandingPageSectionsController::class, 'setOrder'])->middleware(['auth', 'XSS']);
    Route::post('/LandingPage/copySection', [LandingPageSectionsController::class, 'copySection'])->middleware(['auth', 'XSS']);



    //=================================Plan Request Module ====================================//
    Route::get('plan_request', [PlanRequestController::class, 'index'])->name('plan_request.index')->middleware(['auth', 'XSS']);
    Route::get('request_frequency/{id}', [PlanRequestController::class, 'requestView'])->name('request.index')->middleware(['auth', 'XSS']);
    Route::get('request_send/{id}', [PlanRequestController::class, 'userRequest'])->name('send.request')->middleware(['auth', 'XSS']);
    Route::get('request_response/{id}/{response}', [PlanRequestController::class, 'acceptRequest'])->name('response.request')->middleware(['auth', 'XSS']);
    Route::get('request_response/{id}', [PlanRequestController::class, 'cancelRequest'])->name('request.cancel')->middleware(['auth', 'XSS']);




    // ===============================================Import Export=======================================
    Route::get('salesOrder/export', [SalesOrderController::class, 'fileExport'])->name('salesorder.export');




    /*==================================Recaptcha====================================================*/
    Route::post('/recaptcha-settings', [SettingController::class, 'recaptchaSettingStore'])->name('recaptcha.settings.store')->middleware(['auth', 'XSS']);


    //=======================================Twilio==========================================//
    Route::post('setting/twilio', [SettingController::class, 'twilio'])->name('twilio.setting');



    //========================================================================================//
    Route::any('user-reset-password/{id}', [UserController::class, 'employeePassword'])->name('user.reset');
    Route::post('user-reset-password/{id}', [UserController::class, 'employeePasswordReset'])->name('user.password.update');



    //==========================================================================================//

    // Email Templates
    Route::get('email_template_lang/{id}/{lang?}', [EmailTemplateController::class, 'manageEmailLang'])->name('manage.email.language')->middleware(['auth', 'XSS']);
    Route::post('email_template_store/{pid}', [EmailTemplateController::class, 'storeEmailLang'])->name('store.email.language')->middleware(['auth']);
    Route::post('email_template_status', [EmailTemplateController::class, 'updateStatus'])->name('status.email.language')->middleware(['auth']);


    Route::resource('email_template', EmailTemplateController::class)->middleware(
        [
            'auth',
            // 'XSS',
        ]
    );
    Route::resource('email_template_lang', EmailTemplateLangController::class)->middleware(
        [
            'auth',
            // 'XSS',
        ]
    );



    //==========================================================================================================//

    //contract
    Route::resource('contract_type', ContractTypeController::class)->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::resource('contract', ContractController::class)->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::post('/contract_status_edit/{id}', [ContractController::class, 'contract_status_edit'])->name('contract.status')->middleware(['auth', 'XSS']);
    Route::post('/contract/{id}/file', [ContractController::class, 'fileUpload'])->name('contracts.file.upload')->middleware(['auth', 'XSS']);
    Route::get('/contract/{id}/file/{fid}', [ContractController::class, 'fileDownload'])->name('contracts.file.download')->middleware(['auth', 'XSS']);
    Route::delete('/contract/{id}/file/delete/{fid}', [ContractController::class, 'fileDelete'])->name('contracts.file.delete')->middleware(['auth', 'XSS']);
    Route::post('/contract/{id}/note', [ContractController::class, 'noteStore'])->name('contracts.note.store')->middleware(['auth']);
    Route::get('/contract/{id}/note', [ContractController::class, 'noteDestroy'])->name('contracts.note.destroy')->middleware(['auth']);
    Route::post('contract/{id}/description', [ContractController::class, 'descriptionStore'])->name('contracts.description.store')->middleware(['auth']);
    Route::get('/contract/copy/{id}', [ContractController::class, 'copycontract'])->name('contracts.copy')->middleware(['auth', 'XSS']);
    Route::post('/contract/copy/store', [ContractController::class, 'copycontractstore'])->name('contracts.copy.store')->middleware(['auth', 'XSS']);


    Route::get('contract/{id}/get_contract', [ContractController::class, 'printContract'])->name('get.contract');
    Route::get('contract/pay/pdf/{id}', [ContractController::class, 'pdffromcontract'])->name('contract.download.pdf');
    Route::get('contract/pay/pdf', [ContractController::class, 'signature'])->name('contract.signature');
    Route::get('/signature/{id}', [ContractController::class, 'signature'])->name('signature')->middleware(['auth', 'XSS']);
    Route::post('/signaturestore', [ContractController::class, 'signatureStore'])->name('signaturestore')->middleware(['auth', 'XSS']);



    Route::get('/contract/preview/{template}/{color}', [ContractController::class, 'previewContract'])->name('contract.preview');
    Route::get('/contract/{id}/mail', [ContractController::class, 'sendmailContract'])->name('send.mail.contract');





    // Route::post('/projects/{id}/comment/{tid}/file', ['as' => 'comment.store.file','uses' => 'ContractController@commentStoreFile',]);
    // Route::delete('/projects/{id}/comment/{tid}/file/{fid}', ['as' => 'comment.destroy.file',    'uses' => 'ContractController@commentDestroyFile',]);
    Route::post('/contract/{id}/comment', [ContractController::class, 'commentStore'])->name('comment.store');
    Route::get('/contract/{id}/comment', [ContractController::class, 'commentDestroy'])->name('comment.destroy');


    // Storage setting
    Route::post('storage-settings', [SettingController::class, 'storageSettingStore'])->name('storage.setting.store')->middleware(['auth', 'XSS']);
});
