<?php

use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RegistryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\signUpController;


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
Route::middleware('isAdmin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
    Route::post('/dashboard', [DashboardController::class,'addEmployee'])->middleware('auth');
    Route::post('/update-employee/{id}', [DashboardController::class,'updateEmployee'])->middleware('auth');
    Route::get('/employee-list', [DashboardController::class,'NewEmployee'])->middleware('auth');
    Route::get('/add-employee', [DashboardController::class,'newEmployee'])->middleware('auth');
    Route::get('/patients', [DashboardController::class,'Patients'])->middleware('auth');
    Route::post('/add-patient', [DashboardController::class,'addPatient'])->middleware('auth');
    Route::post('/update-patient/{id}', [DashboardController::class,'updatePatient'])->middleware('auth');
    // Route::put('/update-employee/{id}', [DashboardController::class,'UpdateEmployee'])->middleware('auth')->name('updateemployee');
    Route::get('/registry', [RegistryController::class, 'getRegistry'])->name('registry');
    Route::post('/registry', [RegistryController::class, 'saveRegistry'])->name('saveRegistry');
    Route::get('/pay-approval', [PayController::class, 'Index'])->name('paysummary');
    Route::get('/report', [ReportController::class, 'Index']);
    Route::get('/pay-period', [DashboardController::class, 'PayPeriod']);
    Route::post('/pay-approval/{id}', [DashboardController::class, 'PayApproval']);
    Route::post('/add-pay-period', [DashboardController::class, 'AddPayPeriod']);
    Route::post('/update-pay-period/{id}', [DashboardController::class, 'UpdatePayPeriod']);
    Route::get('/settings', [DashboardController::class, 'Settings'])->middleware('auth');
    Route::post('/add-settings', [DashboardController::class, 'addSettings'])->middleware('auth');
    Route::post('/edit-settings/{id}', [DashboardController::class, 'editSettings'])->middleware('auth');
    Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
    Route::post('/paysummary', [RegistryController::class, 'paysummary'])->middleware('auth');
    Route::put('/update-paysummary/{id}', [RegistryController::class,'UpdatePaysummary'])->middleware('auth')->name('updatepaysummary');
    Route::post('/updatepaysummary/{id}', [PayController::class,'paysummary'])->middleware('auth');
    Route::put('/update-registry/{rid}', [RegistryController::class,'UpdateRegistry'])->middleware('auth')->name('updateregistry');
    Route::get('/visit', [DashboardController::class, 'Visits'])->middleware('auth');
    Route::post('/add-visit', [DashboardController::class, 'AddVisit'])->middleware('auth');
    Route::post('/edit-visit/{id}', [DashboardController::class, 'UpdateVisits'])->middleware('auth');
    Route::get('/employee-time', [DashboardController::class, 'EmpTime'])->middleware('auth');
    Route::post('/add-time', [DashboardController::class, 'AddTime'])->middleware('auth');
    Route::post('/edit-time/{id}', [DashboardController::class, 'UpdateTime'])->middleware('auth');
    Route::get('/approve-invoice/{id}', [PayController::class, 'ApproveInvoice'])->middleware('auth');
    Route::get('/return-invoice/{id}', [PayController::class, 'ReturnInvoice'])->middleware('auth');
    Route::get('/delete-invoice/{id}', [PayController::class, 'DeleteInvoice'])->middleware('auth');
    Route::post('/edit-visit/{id}', [DashboardController::class, 'UpdateVistType'])->middleware('auth');
     Route::get('/specialty', [DashboardController::class, 'Specialty'])->middleware('auth');
    Route::post('/add-specialty', [DashboardController::class, 'AddSpecialty'])->middleware('auth');
    Route::post('/edit-specialty/{id}', [DashboardController::class, 'UpdateSpecialty'])->middleware('auth');
});

Route::get('/update-password', [HomeController::class,'EditPassword'])->middleware('auth');
Route::post('/update-password', [HomeController::class,'UpdatePassword'])->name('password.update')->middleware('auth');
Route::get('/invoice/{id}', [ReportController::class,'invoice'])->middleware('auth');
// Route::post('/invoice', [ReportController::class,'invoice'])->middleware('auth');
Route::post('/update-pay-record/{id}', [EmployeeController::class,'UpdateDailyPay'])->middleware('auth');
Route::get('/delete-pay-record/{id}', [EmployeeController::class,'DeleteDailyPay'])->middleware('auth');
Route::post('/logout', [LogoutController::class,'signoff'])->name('logout');

Route::get('/signup', [signUpController::class,'index'])->name('signup');
Route::post('/signup', [signUpController::class,'save']);

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'save']);


Route::group(['middleware' => ['auth', 'dbTransaction']], function () {
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::get('/employee/enter-pay', [EmployeeController::class, 'enterPaySummary'])->name('auth.employee.enter.pay');
    Route::get('/employee/enter-pays', [EmployeeController::class, 'InvoiceSummary'])->name('invoicesummary');
    Route::post('/employee/enter-pay/preview/get', [EmployeeController::class, 'getPaySummaryPreview'])->name('auth.employee.enter.pay.summary.preview');
    Route::post('/paysummary', [EmployeeController::class, 'paysummary']);
    Route::post('/daily-pay', [EmployeeController::class, 'DailyPay'])->name('dailyPay');
    Route::post('/trial', [EmployeeController::class, 'Trial'])->name('trial');
    Route::get('/resetpassword', function () {
        return view('auth.passwordreset');
    })->name('resetpassword');
    Route::post('/update-paysummary/{id}', [PayController::class, 'UpdatePay']);
});

Route::get('/registry', [RegistryController::class,'getRegistry'])->name('registry');
Route::post('/report', [RegistryController::class,'AddReport'])->name('addreport');

Route::get('/pay', [PayController::class,'Index'])->name('pay');

Route::get('/reports', [RegistryController::class,'Report'])->name('report');
Route::post('edit-report/{id}', [RegistryController::class,'EditReport']);

// Route::get('/',[EmployeeController::class,'index'])->name('employee');
// Route::post('/',[EmployeeController::class,'paysummary'])->name('employee');

Route::get('/', function () {
    return view('auth.login');
})->name('index');