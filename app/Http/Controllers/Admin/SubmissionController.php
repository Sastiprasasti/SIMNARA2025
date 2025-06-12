<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class SubmissionController extends Controller 
{
   public function index()
   {
       $submissions = Submission::with('user')->latest()->get();
       return view('admin.submissions.index', compact('submissions'));
   }

   public function updateStatus(Request $request, Submission $submission)
   {
       $validated = $request->validate([
           'status' => 'required|in:pending,approved,rejected',
           'admin_document' => 'nullable|file|mimes:pdf|max:2048',
           'admin_remarks' => 'nullable|string|max:500' // Tambahkan validasi untuk remarks
 
       ]);
       
       $submission->admin_remarks = $request->admin_remarks;


       // Tambahkan kondisi untuk semua form type
       if ($request->hasFile('admin_document')) {
           $file = $request->file('admin_document');
           $filename = time() . '_admin_' . $file->getClientOriginalName();
           
           // Simpan file di direktori public/documents
           $file->storeAs('public/documents', $filename);
           
           // Update path dokumen admin
           $validated['admin_document_path'] = $filename;
       }

       // Update submission dengan status dan path dokumen
       $submission->update($validated);

       return back()->with('success', 'Status berhasil diupdate!');
   }

   public function generatePDF(Submission $submission)
   {
       $view = $this->getSubmissionView($submission);
       $filename = $this->getFilename($submission);

       $data = [
           'submission' => $submission
       ];

       if ($submission->jenis_form === 'form1') {
           $data['kepada'] = json_decode($submission->kepada, true);
       }

       $pdf = PDF::loadView($view, $data);
       return $pdf->stream($filename . '_' . $submission->id . '.pdf');
   }

   public function downloadDocument(Submission $submission, Request $request)
   {
       // Tentukan path berdasarkan tipe dokumen (admin atau user)
       $path = $request->type === 'admin' 
           ? $submission->admin_document_path 
           : $submission->document_path;

       if (!$path) {
           return back()->with('error', 'Dokumen tidak ditemukan');
       }

       // Bangun path lengkap file
       $fullPath = storage_path('app/public/documents/' . $path);
       
       if (!file_exists($fullPath)) {
           return back()->with('error', 'File tidak ditemukan');
       }

       // Download file
       return response()->download($fullPath);
   }

   public function viewDocument(Submission $submission)
   {
       // Khusus Form 1: Generate PDF surat tugas
       if ($submission->jenis_form === 'form1') {
           $data = [
               'submission' => $submission,
               'kepada' => json_decode($submission->kepada, true)
           ];
           
           $pdf = PDF::loadView('admin.submissions.pdf.pdf_form1', $data);
           return $pdf->stream('Surat_Tugas_' . $submission->id . '.pdf');
       }

       // Cek dokumen admin untuk Form 3
       if ($submission->jenis_form === 'form3' && $submission->admin_document_path) {
           $path = storage_path('app/public/documents/' . $submission->admin_document_path);
           if (file_exists($path)) {
               return response()->file($path);
           }
       }

       // Cek dokumen user untuk form lainnya
       if (!$submission->document_path) {
           return back()->with('error', 'Dokumen tidak ditemukan');
       }

       $path = storage_path('app/public/documents/' . $submission->document_path);
       
       if (!file_exists($path)) {
           return back()->with('error', 'File tidak ditemukan'); 
       }

       return response()->file($path);
   }

   private function getSubmissionView(Submission $submission)
   {
       return match($submission->jenis_form) {
           'form1' => 'admin.submissions.pdf.pdf_form1',
           'form2' => 'admin.submissions.pdf.pdf_form2', 
           'form3' => 'admin.submissions.pdf.pdf_form3',
           default => 'admin.submissions.pdf.pdf_default',
       };
   }

   private function getFilename(Submission $submission)
   {
       return match($submission->jenis_form) {
           'form1' => 'Surat_Tugas',
           'form2' => 'Permohonan_KTP',
           'form3' => 'Form_Pengaduan',
           default => 'Dokumen',
       };
   }
}