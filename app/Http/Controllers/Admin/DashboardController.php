<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\User;
use App\Models\SuratMasuk;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_submissions' => Submission::count(),
            'pending_submissions' => Submission::where('status', 'pending')->count(),
            'approved_submissions' => Submission::where('status', 'approved')->count(),
            'surat_keluar' => Submission::whereIn('jenis_form', ['form1', 'form2', 'form3'])->count(),
            'surat_masuk' => SuratMasuk::count()
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function suratMasuk()
    {
        $suratMasuk = SuratMasuk::latest()->get();
        return view('admin.surat-masuk', compact('suratMasuk'));
    }

    public function suratKeluar()
    {
        // Mengambil semua surat
        $submissions = Submission::whereIn('jenis_form', ['form1', 'form2', 'form3'])
                               ->with('user')
                               ->latest()
                               ->get();

        // Menghitung statistik
        $totalSubmissions = $submissions->count();
        $pendingSubmissions = $submissions->where('status', 'pending')->count();
        $approvedSubmissions = $submissions->where('status', 'approved')->count();
        $todaySubmissions = $submissions->where('created_at', '>=', today())->count();

        return view('admin.surat-keluar', compact(
            'submissions',
            'totalSubmissions',
            'pendingSubmissions',
            'approvedSubmissions',
            'todaySubmissions'
        ));
    }
}