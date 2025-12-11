<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DataController extends Controller
{
    protected $dataPath;

    public function __construct()
    {
        $this->dataPath = public_path('data');
    }

    // ============================================
    // DOCTORS CRUD
    // ============================================

    public function getDoctors()
    {
        $file = $this->dataPath . '/doctors.json';
        $data = File::exists($file) ? json_decode(File::get($file), true) : ['doctors' => []];
        return response()->json($data);
    }

    public function saveDoctors(Request $request)
    {
        $file = $this->dataPath . '/doctors.json';
        $data = ['doctors' => $request->input('doctors', [])];
        File::put($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return response()->json(['success' => true, 'message' => 'Data dokter berhasil disimpan']);
    }

    // ============================================
    // PATIENTS CRUD
    // ============================================

    public function getPatients()
    {
        $file = $this->dataPath . '/patients.json';
        $data = File::exists($file) ? json_decode(File::get($file), true) : ['patients' => []];
        return response()->json($data);
    }

    public function savePatients(Request $request)
    {
        $file = $this->dataPath . '/patients.json';
        $data = ['patients' => $request->input('patients', [])];
        File::put($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return response()->json(['success' => true, 'message' => 'Data pasien berhasil disimpan']);
    }

    // ============================================
    // APPOINTMENTS CRUD
    // ============================================

    public function getAppointments()
    {
        $file = $this->dataPath . '/appointments.json';
        $data = File::exists($file) ? json_decode(File::get($file), true) : ['appointments' => []];
        return response()->json($data);
    }

    public function saveAppointments(Request $request)
    {
        $file = $this->dataPath . '/appointments.json';
        $data = ['appointments' => $request->input('appointments', [])];
        File::put($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return response()->json(['success' => true, 'message' => 'Data janji temu berhasil disimpan']);
    }

    // ============================================
    // FEEDBACKS CRUD
    // ============================================

    public function getFeedbacks()
    {
        $file = $this->dataPath . '/feedbacks.json';
        $data = File::exists($file) ? json_decode(File::get($file), true) : ['feedbacks' => []];
        return response()->json($data);
    }

    public function saveFeedbacks(Request $request)
    {
        $file = $this->dataPath . '/feedbacks.json';
        $data = ['feedbacks' => $request->input('feedbacks', [])];
        File::put($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return response()->json(['success' => true, 'message' => 'Data feedback berhasil disimpan']);
    }

    // ============================================
    // SERVICES CRUD
    // ============================================

    public function getServices()
    {
        $file = $this->dataPath . '/services.json';
        $data = File::exists($file) ? json_decode(File::get($file), true) : ['services' => []];
        return response()->json($data);
    }

    public function saveServices(Request $request)
    {
        $file = $this->dataPath . '/services.json';
        $data = ['services' => $request->input('services', [])];
        File::put($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return response()->json(['success' => true, 'message' => 'Data layanan berhasil disimpan']);
    }
}
