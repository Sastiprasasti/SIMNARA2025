<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function index()
    {
        return view('templates.index');
    }

    public function downloadSPPD()
    {
        $filePath = 'public/templates/template_sppd.docx';
        
        if (!Storage::exists($filePath)) {
            return back()->with('error', 'Template file tidak ditemukan.');
        }

        return Storage::download($filePath, 'template_sppd.docx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ]);
    }

    public function downloadKuitansi()
    {
        $filePath = 'public/templates/template_kuitansi.docx';
        
        if (!Storage::exists($filePath)) {
            return back()->with('error', 'Template file tidak ditemukan.');
        }

        return Storage::download($filePath, 'template_kuitansi.docx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ]);
    }
}