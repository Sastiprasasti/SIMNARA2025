<?php
// File: app/Http/Controllers/DocumentController.php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;


class DocumentController extends Controller
{
    public function generateSuratTugas($id)
    {
        try {
            // Debug: Cek ID yang diterima
            \Log::info('Generating Surat Tugas for ID: ' . $id);

            // Cari submission dan tambahkan error handling
            $submission = Submission::findOrFail($id);
            \Log::info('Submission found:', ['data' => $submission->toArray()]);

            // Cek relasi user
            if (!$submission->user) {
                \Log::error('User relation not found for submission: ' . $id);
                throw new \Exception('Data user tidak ditemukan');
            }

            $data = [
                'nomor_surat' => 'B-0736/32051/VS.300/2024',
                'nama' => $submission->nama,
                'nip' => $submission->user->nip,
                'jabatan' => $submission->user->jabatan,
                'tujuan_tugas' => $submission->tujuan,
                'jangka_waktu' => $submission->tanggal_mulai . ' -- ' . $submission->tanggal_selesai,
                'tanggal_surat' => now()->format('d F Y'),
                'nama_kepala' => 'Nevi Hendri, S.Si, M.M',
                'nip_kepala' => '19721130 199203 1 001',

                // Data untuk header/footer
                'alamat_kantor' => 'Jalan Pembangunan No. 222 Tarogong Kidul, Garut, Jawa Barat - Indonesia',
                'kode_pos' => '44151',
                'telepon' => '(0262) 233273',
                'fax' => '(0262) 4893051',
                'email' => 'bps3205@bps.go.id'
            ];

            \Log::info('Data prepared for view:', ['data' => $data]);

            // Cek apakah view exists
            if (!view()->exists('documents.surat-tugas')) {
                \Log::error('View documents.surat-tugas not found');
                throw new \Exception('Template surat tidak ditemukan');
            }

            if (request()->type == 'pdf') {
                try {
                    $pdf = PDF::loadView('documents.surat-tugas', $data);
                    return $pdf->download('surat-tugas-' . $id . '.pdf');
                } catch (\Exception $e) {
                    \Log::error('PDF generation failed:', ['error' => $e->getMessage()]);
                    throw new \Exception('Gagal membuat PDF: ' . $e->getMessage());
                }
            }

            return view('documents.surat-tugas', $data);
        } catch (\Exception $e) {
            \Log::error('Error in generateSuratTugas:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return error view
            return response()->view('errors.custom', [
                'message' => 'Terjadi kesalahan saat membuat surat: ' . $e->getMessage()
            ], 500);
        }
    }

    public function generateSPPD($id)
    {
        $submission = Submission::findOrFail($id);

        $data = [
            'nomor_surat' => 'B-2731/32051/KP.650/2024',
            'ppk' => 'Rita Salamah, S.Si',
            'nip_ppk' => '19761002 200212 2 004',
            'nama' => $submission->nama,
            'nip' => $submission->user->nip,
            'pangkat' => $submission->user->pangkat,
            'jabatan' => $submission->user->jabatan,
            'tingkat_biaya' => 'Sesuai Standar Biaya Masukan',
            'maksud_perjalanan' => $submission->tujuan,
            'alat_angkut' => 'Darat',
            'tempat_berangkat' => 'BPS Kabupaten Garut',
            'tempat_tujuan' => $submission->tempat_tujuan,
            'lama_perjalanan' => '1 (satu) hari',
            'tanggal_berangkat' => $submission->tanggal_mulai,
            'tanggal_kembali' => $submission->tanggal_selesai,

            // Anggaran
            'mata_anggaran' => [
                'program' => '054.01.GG',
                'kegiatan' => '2910',
                'kro' => '2910.QMA',
                'ro' => '2910.QMA.006',
                'komponen' => '716'
            ],

            // Data pejabat
            'nama_kepala' => 'Nevi Hendri, S.Si, M.M',
            'nip_kepala' => '19721130 199203 1 001'
        ];

        if (request()->type == 'pdf') {
            $pdf = PDF::loadView('documents.sppd', $data);
            return $pdf->download('sppd-' . $id . '.pdf');
        }

        return view('documents.sppd', $data);
    }

    public function generateKuitansi($id)
    {
        $submission = Submission::findOrFail($id);

        // Hitung total biaya
        $transport = 181000;
        $penginapan = 800000;
        $uang_harian = 430000 * 2; // 2 hari
        $total = $transport + $penginapan + $uang_harian;

        $data = [
            'jumlah' => $total,
            'terbilang' => $this->terbilang($total),
            'keterangan' => 'Perjalanan Dinas ' . $submission->tujuan,
            'nomor_sppd' => 'B-2731/32051/KP.650/2024',
            'tanggal_sppd' => now()->format('d F Y'),
            'rute_perjalanan' => 'BPS Kabupaten Garut ke ' . $submission->tempat_tujuan,

            // Data pejabat
            'nama_ppk' => 'Rita Salamah, S.Si',
            'nip_ppk' => '19761002 200212 2 004',
            'nama_bendahara' => 'Ali Nurdin, SE',
            'nip_bendahara' => '19710228 199102 1 001',
            'nama_penerima' => $submission->nama,
            'nip_penerima' => $submission->user->nip,

            // Rincian biaya
            'transport' => $transport,
            'penginapan' => $penginapan,
            'uang_harian' => $uang_harian,
            'tanggal_kuitansi' => now()->format('d F Y')
        ];

        if (request()->type == 'pdf') {
            $pdf = PDF::loadView('documents.kuitansi', $data);
            return $pdf->download('kuitansi-' . $id . '.pdf');
        }

        return view('documents.kuitansi', $data);
    }

    public function downloadWordSuratTugas($id)
    {
        $submission = Submission::findOrFail($id);

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Tambahkan konten
        $section->addText('SURAT TUGAS');
        $section->addText('Nomor: B-0736/32051/VS.300/2024');
        $section->addText("Nama: {$submission->nama}");
        $section->addText("NIP: {$submission->user->nip}");
        $section->addText("Jabatan: {$submission->user->jabatan}");
        $section->addText("Tujuan: {$submission->tujuan}");
        $section->addText("Tanggal: {$submission->tanggal_mulai} s.d. {$submission->tanggal_selesai}");

        // Simpan ke temporary file
        $filename = 'surat-tugas-' . $id . '.docx';
        $tempFile = storage_path('app/public/' . $filename);
        $phpWord->save($tempFile, 'Word2007');

        return response()->download($tempFile)->deleteFileAfterSend(true);
    }

    private function terbilang($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";

        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->terbilang($nilai - 10) . " Belas";
        } else if ($nilai < 100) {
            $temp = $this->terbilang($nilai / 10) . " Puluh" . $this->terbilang($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . $this->terbilang($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->terbilang($nilai / 100) . " Ratus" . $this->terbilang($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . $this->terbilang($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->terbilang($nilai / 1000) . " Ribu" . $this->terbilang($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->terbilang($nilai / 1000000) . " Juta" . $this->terbilang($nilai % 1000000);
        }

        return $temp;
    }
}
