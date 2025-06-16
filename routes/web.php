<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminController;

Route::match(['GET','POST'],'/', [AuthController::class, 'login'])->name('login');
Broadcast::routes();
Route::group(['as'=>'super-admin.','prefix' => 'super-admin','middleware'=>['auth','role:super-admin']], function () {
    Route::controller(SuperAdminController::class)->group(function () {
        Route::get('/clients', 'ClientList')->name('client.list'); 
        Route::get('/invite-new-client', 'InviteNewClientCreate')->name('client.create'); 
        Route::post('/client/store', 'InviteNewClientStore')->name('client.store');  
    });
    
});
Route::group(['as'=>'admin.','prefix' => 'admin','middleware'=>['auth','role:admin']], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/invite-new-member', 'InviteNewMemberCreate')->name('member.create'); 
        Route::post('/member/store', 'InviteNewMemberStore')->name('member.store');  
    });
    
});
foreach (['super-admin', 'admin'] as $role) {
    Route::group([
        'as' => $role . '.',
        'prefix' => $role,
        'middleware' => ['auth', "role:$role"]
    ], function () use ($role) {
        Route::controller(SuperAdminController::class)->group(function () {
            Route::get('/members', 'MembersList')->name('members.list');
        });
    });
}

foreach (['super-admin', 'admin','member'] as $role) {
    Route::group([
        'as' => $role . '.',
        'prefix' => $role,
        'middleware' => ['auth', "role:$role"]
    ], function () use ($role) {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::controller(SuperAdminController::class)->group(function () {
            Route::get('/short-urls', 'ShortUrlList')->name('short-url.list');
            
        });
    });
}
foreach (['admin','member'] as $role) {
    Route::group([
        'as' => $role . '.',
        'prefix' => $role,
        'middleware' => ['auth', "role:$role"]
    ], function () use ($role) {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/short-url/create', 'ShortUrlCreate')->name('short-url.create');
            Route::post('/short-url/store', 'ShortUrlStore')->name('short-url.store');
            
        });
    });
}
Route::group(['middleware'=>['auth']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/invite/accept/{token}', [SuperAdminController::class, 'showAcceptForm'])->name('invitation.accept');
Route::get('/s/{short_code}', [AdminController::class, 'resolve'])->name('short-url.resolve');
