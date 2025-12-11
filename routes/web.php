<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Klinik Gigi Sehat - Route Definitions
| 
| Semua route untuk halaman publik dan admin.
|
*/

// ============================================
// API ROUTES FOR DATA CRUD
// ============================================

Route::prefix('api')->group(function () {
    // Doctors
    Route::get('/doctors', [DataController::class, 'getDoctors']);
    Route::post('/doctors', [DataController::class, 'saveDoctors']);

    // Patients
    Route::get('/patients', [DataController::class, 'getPatients']);
    Route::post('/patients', [DataController::class, 'savePatients']);

    // Appointments
    Route::get('/appointments', [DataController::class, 'getAppointments']);
    Route::post('/appointments', [DataController::class, 'saveAppointments']);

    // Feedbacks
    Route::get('/feedbacks', [DataController::class, 'getFeedbacks']);
    Route::post('/feedbacks', [DataController::class, 'saveFeedbacks']);

    // Services
    Route::get('/services', [DataController::class, 'getServices']);
    Route::post('/services', [DataController::class, 'saveServices']);
});

// ============================================
// PUBLIC ROUTES
// ============================================

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('home');

// ============================================
// AUTH ROUTES
// ============================================

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Layanan & Harga (Pricelist)
Route::get('/services', function () {
    return view('services.index');
})->name('services.index');

// Feedback
Route::get('/feedback', function () {
    return view('feedback.index');
})->name('feedback');

// Daftar Dokter
Route::get('/doctors', function () {
    return view('doctors.index');
})->name('doctors.index');

// Jadwal Dokter (dengan parameter ID untuk nanti)
Route::get('/doctors/{id}/schedule', function ($id) {
    // TODO: Fetch doctor data berdasarkan $id
    return view('doctors.schedule');
})->name('doctors.schedule');

// Registrasi Pasien
Route::get('/patients/register', function () {
    return view('patients.register');
})->name('patients.register');

// Checkout DP
Route::get('/appointment/checkout', function () {
    return view('appointment.checkout');
})->name('appointment.checkout');

// Konfirmasi
Route::get('/appointment/confirmed', function () {
    return view('appointment.confirmed');
})->name('appointment.confirmed');


// ============================================
// ADMIN ROUTES
// ============================================

Route::prefix('admin')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Data Pasien
    Route::get('/patients', function () {
        return view('admin.patients');
    })->name('admin.patients');

    // Data Dokter
    Route::get('/doctors', function () {
        return view('admin.doctors');
    })->name('admin.doctors');

    // Data Janji Temu
    Route::get('/appointments', function () {
        return view('admin.appointments');
    })->name('admin.appointments');

    // Rekam Medis
    Route::get('/medical-records', function () {
        return view('admin.medical-records');
    })->name('admin.medical-records');

    // Feedback
    Route::get('/feedbacks', function () {
        return view('admin.feedbacks');
    })->name('admin.feedbacks');

});
