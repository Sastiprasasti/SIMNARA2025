<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\PDF;

class UserDashboardController extends Controller 
{
    /**
     * Display user dashboard with submission statistics
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $submissions = $user->submissions()->with('user')->latest()->get();
            
            // Calculate statistics
            $stats = [
                'total_submissions' => $submissions->count(),
                'pending_submissions' => $submissions->where('status', 'pending')->count(),
                'approved_submissions' => $submissions->where('status', 'approved')->count(),
                'rejected_submissions' => $submissions->where('status', 'rejected')->count(),
                
                // Group by form type
                'form1_count' => $submissions->where('jenis_form', 'form1')->count(),
                'form2_count' => $submissions->where('jenis_form', 'form2')->count(),
                'form3_count' => $submissions->where('jenis_form', 'form3')->count(),
                
                // Recent activity
                'recent_approved' => $submissions->where('status', 'approved')
                    ->take(5)->values()->all(),
                'recent_pending' => $submissions->where('status', 'pending')
                    ->take(5)->values()->all(),
            ];

            return view('user.dashboard', compact('stats', 'submissions'));

        } catch (\Exception $e) {
            Log::error('Error in dashboard: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memuat dashboard.');
        }
    }

    /**
     * Download PDF for approved submissions
     */
    public function downloadPDF(Submission $submission)
    {
        try {
            // Validate user ownership and submission status
            if ($submission->user_id !== Auth::id()) {
                Log::warning('Unauthorized PDF download attempt by user ' . Auth::id());
                return redirect()->back()
                    ->with('error', 'Anda tidak memiliki akses ke dokumen ini.');
            }

            if ($submission->status !== 'approved') {
                return redirect()->back()
                    ->with('error', 'Hanya pengajuan yang telah disetujui yang dapat diunduh.');
            }

            // Determine view and filename based on submission type
            $view = match($submission->jenis_form) {
                'form1' => 'admin.submissions.pdf_form1',
                'form2' => 'admin.submissions.pdf_form2',
                'form3' => 'admin.submissions.pdf_form3',
                default => throw new \Exception('Jenis form tidak valid')
            };

            $filename = match($submission->jenis_form) {
                'form1' => 'Surat_Tugas',
                'form2' => 'SPPD',
                'form3' => 'Kuitansi',
                default => 'Dokumen'
            };

            // Generate PDF
            $pdf = PDF::loadView($view, [
                'submission' => $submission,
                'user' => Auth::user(),
                'generated_at' => now()->format('d/m/Y H:i:s')
            ]);

            // Configure PDF options if needed
            $pdf->setPaper('a4');
            
            // Generate filename with timestamp
            $fullFilename = sprintf(
                '%s_%s_%s.pdf',
                $filename,
                $submission->id,
                now()->format('Ymd_His')
            );

            return $pdf->download($fullFilename);

        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengunduh dokumen.');
        }
    }

    /**
     * Display submission statistics
     */
    public function statistics()
    {
        try {
            $user = Auth::user();
            $submissions = $user->submissions;

            $monthlyStats = $submissions
                ->groupBy(function($submission) {
                    return $submission->created_at->format('Y-m');
                })
                ->map(function($group) {
                    return [
                        'total' => $group->count(),
                        'approved' => $group->where('status', 'approved')->count(),
                        'pending' => $group->where('status', 'pending')->count(),
                        'rejected' => $group->where('status', 'rejected')->count(),
                    ];
                });

            $formTypeStats = [
                'form1' => [
                    'total' => $submissions->where('jenis_form', 'form1')->count(),
                    'approved' => $submissions->where('jenis_form', 'form1')
                        ->where('status', 'approved')->count(),
                ],
                'form2' => [
                    'total' => $submissions->where('jenis_form', 'form2')->count(),
                    'approved' => $submissions->where('jenis_form', 'form2')
                        ->where('status', 'approved')->count(),
                ],
                'form3' => [
                    'total' => $submissions->where('jenis_form', 'form3')->count(),
                    'approved' => $submissions->where('jenis_form', 'form3')
                        ->where('status', 'approved')->count(),
                ],
            ];

            return view('user.statistics', compact('monthlyStats', 'formTypeStats'));

        } catch (\Exception $e) {
            Log::error('Error generating statistics: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memuat statistik.');
        }
    }
}