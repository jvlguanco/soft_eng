<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdmissionPageController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\WelcomePageController;

Route::redirect('/', '/home');
Route::redirect('/logout', '/home');

Route::get('/{currentRoute}', [WelcomePageController::class, 'index'])->name('welcome.page')->defaults('currentRoute', 'home');

require __DIR__.'/auth.php';

Route::middleware('guest')->group(function () {
    Route::get('/applicant/apply', [ApplicationController::class, 'create'])
    ->name('apply');

    Route::post('/applicant/apply', [ApplicationController::class, 'store'])->name('apply.post');

    Route::get('/applicant/back', [ApplicationController::class, 'back'])->name('back');
});

Route::get('/get-provinces/{regionCode}', [ProvinceController::class, 'getProvinces']);
Route::get('/get-cities/{provinceCode}', [CityController::class, 'getCities']);
Route::get('/get-barangays/{cityCode}', [BarangayController::class, 'getBarangays']);

Route::post('/applicant/login', [LoginController::class, 'store'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/admin/{currentRoute}', [AdmissionPageController::class, 'AdmissionDashboard'])->name('admin.page');
Route::post('/admin/{currentRoute}/ChangeDate', [AdmissionPageController::class, 'AdmissionChangeDate'])->name('admin.change');
Route::post('/admin/{currentRoute}/{announcementId}/update', [AdmissionPageController::class, 'AdmissionUpdateAnnouncement'])->name('admin.update.announcement');
Route::get('/admin/{currentRoute}/{announcementId}/delete', [AdmissionPageController::class, 'AdmissionDeleteAnnouncement'])->name('admin.delete.announcement');
Route::get('/admin/{currentRoute}/{announcementId}', [AdmissionPageController::class, 'AdmissionEditAnnouncement'])->name('admin.edit.announcement');
Route::post('/admin/{currentRoute}/add', [AdmissionPageController::class, 'AdmissionAddAnnouncement'])->name('admin.add.announcement');
Route::get('/admin/{currentRoute}/{applicationType}/{applicantId}', [AdmissionPageController::class, 'AdmissionApplicantVerify'])->name('admin.verify');
Route::post('/admin/{currentRoute}/{applicationType}/{applicantId}/verify', [AdmissionPageController::class, 'AdmissionVerify'])->name('admin.verify.applicant');

Route::get('/applicant/{currentRoute}/{applicantId}',[ApplicantController::class, 'ApplicantPage'])->name('applicant.page');
Route::post('/applicant/{currentRoute}/{applicantId}/resubmitBirth',[ApplicantController::class, 'ResubmitBirthCert'])->name('applicant.resubmitBirth');
Route::post('/applicant/{currentRoute}/{applicantId}/resubmitForm137',[ApplicantController::class, 'ResubmitForm137'])->name('applicant.resubmitForm137');
Route::post('/applicant/{currentRoute}/{applicantId}',[ApplicantController::class, 'ChangePassword'])->name('applicant.change');

Route::get('/admin/{currentRoute}/restore/all/status', [ActionController::class, 'restore'])->name('admin.restore');
Route::get('/admin/{currentRoute}/archive/all/status', [ActionController::class, 'archive'])->name('admin.archive');
Route::get('/admin/{currentRoute}/delete/all/status', [ActionController::class, 'delete'])->name('admin.delete');