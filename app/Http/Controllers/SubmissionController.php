<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class SubmissionController extends Controller 
{
    public function index()
    {
        try {
            $submissions = Auth::user()->submissions()->latest()->get();
            $latestSubmission = $submissions->first();
            return view('submissions.index', compact('submissions', 'latestSubmission'));
        } catch (Exception $e) {
            Log::error('Error loading submissions: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data pengajuan.');
        }
    }

    public function create()
    {
        return view('submissions.create');
    }

    public function createForm1()
    {
        return view('submissions.form1');
    }
    
    public function createForm2()
    {
        return view('submissions.form2');
    }

    public function createForm3()
    {
        return view('submissions.form3');
    }

    protected function handleFileUpload($file)
    {
        if (!$file) return null;

        try {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('documents', $filename, 'public');
            return $filename;
        } catch (Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            throw new Exception('Gagal mengunggah file');
        }
    }

    protected function deleteFile($path)
    {
        if (!$path) return;

        $fullPath = 'documents/' . $path;
        if (Storage::disk('public')->exists($fullPath)) {
            Storage::disk('public')->delete($fullPath);
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validasi dasar
            $dataValid = $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string',
                'tujuan' => 'required|string',
                'jenis_form' => 'required|in:form1,form2,form3',
                'document' => 'nullable|file|mimes:pdf|max:2048',
            ]);

            // Set nilai default
            $dataValid = array_merge($dataValid, [
                'menimbang' => null,
                'kepada' => null,
                'untuk' => null,
                'jangka_waktu' => null,
                'document_path' => null,
                'user_id' => Auth::id(),
                'status' => 'pending'
            ]);

            // Upload file jika ada
            if ($request->hasFile('document')) {
                $dataValid['document_path'] = $this->handleFileUpload($request->file('document'));
            }

            // Validasi khusus form1
            if ($request->jenis_form === 'form1') {
                $form1Data = $request->validate([
                    'menimbang' => 'required|string',
                    'kepada' => 'required|array',
                    'kepada.*.nama' => 'required|string|max:255',
                    'kepada.*.nip_nik' => 'required|string|max:20',
                    'kepada.*.jabatan' => 'required|string|max:255',
                    'untuk' => 'required|string',
                    'jangka_waktu' => 'required|string',
                ]);

                $dataValid = array_merge($dataValid, $form1Data);
                $dataValid['kepada'] = json_encode($dataValid['kepada']);
            }

            Submission::create($dataValid);
            DB::commit();

            $pesan = match($request->jenis_form) {
                'form1' => 'Surat Tugas berhasil diajukan!',
                'form2' => 'Permohonan SPPD berhasil dikirim!',
                'form3' => 'Kuitansi berhasil dikirim!',
                default => 'Form berhasil dikirim!'
            };

            return redirect()->route('user.dashboard')->with('success', 'Pengajuan berhasil dikirim!');

        } catch (Exception $e) {
            DB::rollBack();
            
            if (isset($dataValid['document_path'])) {
                $this->deleteFile($dataValid['document_path']);
            }
            
            Log::error('Error creating submission: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengirim pengajuan. Silakan coba lagi.');
        }
    }

    public function destroy(Submission $submission)
    {
        try {
            \Log::info('Attempting to delete submission: ' . $submission->id);
            
            $this->authorize('delete', $submission);
            \Log::info('Authorization passed');
            
            DB::beginTransaction();
            
            // Delete files
            if ($submission->document_path) {
                \Log::info('Deleting document: ' . $submission->document_path);
                Storage::disk('public')->delete('documents/' . $submission->document_path);
            }
            
            if ($submission->admin_document_path) {
                \Log::info('Deleting admin document: ' . $submission->admin_document_path);
                Storage::disk('public')->delete('documents/' . $submission->admin_document_path);
            }
            
            // Delete submission
            $submission->delete();
            \Log::info('Submission deleted successfully');
            
            DB::commit();
    
            return redirect()->back()->with('success', 'Pengajuan berhasil dihapus!');
                    
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error deleting submission: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus pengajuan: ' . $e->getMessage());
        }
    }

    public function bulkDestroy(Request $request)
    {
        try {
            $request->validate([
                'submission_ids' => 'required|array',
                'submission_ids.*' => 'exists:submissions,id'
            ]);

            DB::beginTransaction();

            $submissions = Submission::whereIn('id', $request->submission_ids)
                ->where('user_id', Auth::id())
                ->get();

            foreach ($submissions as $submission) {
                $this->authorize('delete', $submission);
                $this->deleteFile($submission->document_path);
                $this->deleteFile($submission->admin_document_path);
                $submission->delete();
            }

            DB::commit();

            $count = count($submissions);
            return redirect()->back()
                ->with('success', "{$count} pengajuan berhasil dihapus!");

        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            DB::rollBack();
            Log::error('Authorization error in bulk deletion: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Anda tidak memiliki izin untuk menghapus beberapa pengajuan.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error in bulk deletion: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus pengajuan. Silakan coba lagi.');
        }
    }

    public function show(Submission $submission)
    {
        try {
            $this->authorize('view', $submission);
            return view('submissions.show', compact('submission'));
        } catch (Exception $e) {
            Log::error('Error showing submission: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menampilkan pengajuan.');
        }
    }

    public function update(Request $request, Submission $submission)
    {
        try {
            $this->authorize('update', $submission);

            $validated = $request->validate([
                'status' => 'required|in:pending,approved,rejected'
            ]);

            $submission->update($validated);

            return redirect()->back()
                ->with('success', 'Status pengajuan berhasil diperbarui!');
        } catch (Exception $e) {
            Log::error('Error updating submission: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui status.');
        }
    }

    public function approve(Submission $submission)
    {
        try {
            $this->authorize('update', $submission);
            $submission->update(['status' => 'approved']);

            return response()->json([
                'message' => 'Pengajuan berhasil disetujui!'
            ]);
        } catch (Exception $e) {
            Log::error('Error approving submission: ' . $e->getMessage());
            return response()->json([
                'error' => 'Terjadi kesalahan saat menyetujui pengajuan.'
            ], 500);
        }
    }

    public function reject(Submission $submission)
    {
        try {
            $this->authorize('update', $submission);
            $submission->update(['status' => 'rejected']);

            return response()->json([
                'message' => 'Pengajuan berhasil ditolak!'
            ]);
        } catch (Exception $e) {
            Log::error('Error rejecting submission: ' . $e->getMessage());
            return response()->json([
                'error' => 'Terjadi kesalahan saat menolak pengajuan.'
            ], 500);
        }
    }

    public function downloadDocument(Submission $submission)
    {
        try {
            $this->authorize('view', $submission);

            if (!$submission->document_path) {
                return back()->with('error', 'Dokumen tidak ditemukan');
            }

            $path = storage_path('app/public/documents/' . $submission->document_path);
            
            if (!file_exists($path)) {
                return back()->with('error', 'File tidak ditemukan');
            }

            return response()->download($path);
            
        } catch (Exception $e) {
            Log::error('Error downloading document: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengunduh dokumen.');
        }
    }
}