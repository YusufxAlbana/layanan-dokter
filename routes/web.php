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

// Detail Layanan
Route::get('/services/{id}', function ($id) {
    // Fetch service data from JSON file
    $file = public_path('data/services.json');
    $services = [];
    $service = null;

    if (\Illuminate\Support\Facades\File::exists($file)) {
        $data = json_decode(\Illuminate\Support\Facades\File::get($file), true);
        $services = $data['services'] ?? [];

        // Find service by ID
        foreach ($services as $s) {
            if ($s['id'] === $id) {
                $service = $s;
                break;
            }
        }
    }

    // Return 404 if service not found
    if (!$service) {
        abort(404, 'Layanan tidak ditemukan');
    }

    // Determine icon and gradient based on service name
    $iconMap = [
        'Pemeriksaan' => 'search',
        'Pembersihan' => 'sparkles',
        'Tambal' => 'circle-dot',
        'Cabut' => 'scissors',
        'Bleaching' => 'sun',
        'Konsultasi' => 'message-circle',
        'Kawat' => 'git-branch',
        'Crown' => 'crown',
        'Saluran' => 'heart-pulse',
        'Veneer' => 'smile',
        'Implan' => 'plus-circle'
    ];

    $gradientMap = [
        'S001' => 'from-sky-500 to-sky-600',
        'S002' => 'from-emerald-500 to-emerald-600',
        'S003' => 'from-amber-500 to-amber-600',
        'S004' => 'from-purple-500 to-purple-600',
        'S005' => 'from-rose-500 to-rose-600',
        'S006' => 'from-indigo-500 to-indigo-600',
        'S007' => 'from-cyan-500 to-cyan-600',
        'S008' => 'from-pink-500 to-pink-600',
        'S009' => 'from-teal-500 to-teal-600',
        'S010' => 'from-orange-500 to-orange-600'
    ];

    $icon = 'heart';
    foreach ($iconMap as $key => $value) {
        if (str_contains($service['name'], $key)) {
            $icon = $value;
            break;
        }
    }

    $gradientClass = $gradientMap[$id] ?? 'from-sky-500 to-emerald-500';

    return view('services.show', [
        'service' => $service,
        'icon' => $icon,
        'gradientClass' => $gradientClass
    ]);
})->name('services.show');

// Feedback
Route::get('/feedback', function () {
    return view('feedback.index');
})->name('feedback');

// Daftar Dokter
Route::get('/doctors', function () {
    return view('doctors.index');
})->name('doctors.index');

// Jadwal Dokter (dengan parameter ID)
Route::get('/doctors/{id}/schedule', function ($id) {
    // Fetch doctor data from JSON file
    $file = public_path('data/doctors.json');
    $doctors = [];
    $doctor = null;

    if (\Illuminate\Support\Facades\File::exists($file)) {
        $data = json_decode(\Illuminate\Support\Facades\File::get($file), true);
        $doctors = $data['doctors'] ?? [];

        // Find doctor by ID
        foreach ($doctors as $d) {
            if ($d['id'] === $id) {
                $doctor = $d;
                break;
            }
        }
    }

    // Return 404 if doctor not found
    if (!$doctor) {
        abort(404, 'Dokter tidak ditemukan');
    }

    return view('doctors.schedule', ['doctor' => $doctor]);
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
