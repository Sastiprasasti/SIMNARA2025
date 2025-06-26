<?php

use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SuratMasukController;
use App\Http\Controllers\Admin\SubmissionController as AdminSubmissionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\PedomanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SuratController;
use App\Models\SuratMasuk;




// Redirect root to login
Route::get('/', function () {
    return Auth::check() ? redirect()->route('user.dashboard') : redirect()->route('login');
});


// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// User Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    Route::get('/submissions/{submission}/pdf', [UserDashboardController::class, 'downloadPDF'])
        ->name('submissions.pdf');

    // Templates
    Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
    Route::get('/templates/download/sppd', [TemplateController::class, 'downloadSPPD'])->name('templates.download.sppd');
    Route::get('/templates/download/kuitansi', [TemplateController::class, 'downloadKuitansi'])->name('templates.download.kuitansi');

    // Pedoman Routes
    Route::get('/pedoman', [PedomanController::class, 'index'])->name('pedoman.index');

    // Submissions
    Route::controller(SubmissionController::class)->group(function () {
        // Index and Create
        Route::get('/submissions', 'index')->name('submissions.index');
        Route::get('/submissions/create', 'create')->name('submissions.create');

        // Form Routes
        Route::get('/submissions/create/form1', 'createForm1')->name('submissions.createForm1');
        Route::get('/submissions/create/form2', 'createForm2')->name('submissions.createForm2');
        Route::get('/submissions/create/form3', 'createForm3')->name('submissions.createForm3');

        // Store and Manage
        Route::post('/submissions', 'store')->name('submissions.store');
        Route::delete('/submissions/{submission}', [SubmissionController::class, 'destroy'])
            ->name('submissions.destroy')
            ->middleware('auth');

        // Document Operations
        Route::get('/submissions/{submission}/download', 'downloadDocument')
            ->name('submissions.download');
    });
});

// Admin Routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard Admin
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('/surat-masuk', 'suratMasuk')->name('surat-masuk');
            Route::get('/surat-keluar', 'suratKeluar')->name('surat-keluar');
        });




        // Surat Masuk Management
        Route::controller(SuratMasukController::class)->group(function () {
            // Create & Store
            Route::post('/surat-masuk', 'store')->name('surat-masuk.store');

            // View & Download
            Route::get('/surat-masuk/{suratMasuk}/view', 'view')->name('surat-masuk.view');
            Route::get('/surat-masuk/{suratMasuk}/download', 'download')->name('surat-masuk.download');

            // Delete
            Route::delete('/surat-masuk/{suratMasuk}', 'destroy')->name('surat-masuk.destroy');

            // Bulk Actions
            Route::post('/surat-masuk/bulk-delete', 'bulkDestroy')->name('surat-masuk.bulk-destroy');

            // Export
            Route::get('/surat-masuk/export', 'export')->name('surat-masuk.export');

            Route::post('/surat-masuk/kirim-disposisi', 'kirimDisposisi')->name('kirim.disposisi');
        });



        // Submissions Management
        Route::controller(AdminSubmissionController::class)->group(function () {
            Route::get('/submissions', 'index')->name('submissions.index');
            Route::patch('/submissions/{submission}/status', 'updateStatus')
                ->name('submissions.status');
            Route::get('/submissions/{submission}/pdf', 'generatePDF')
                ->name('submissions.pdf');
            Route::get('/submissions/{submission}/download', 'downloadDocument')
                ->name('submissions.download');
            Route::get('/submissions/{submission}/view', 'viewDocument')
                ->name('submissions.view');
            Route::delete('/submissions/bulk-delete', 'bulkDestroy')
                ->name('submissions.bulk-destroy');
        });
    });

// Fallback route
Route::fallback(function () {
    return redirect()->route('login');
});

Route::get('/approve-disposisi/{token}', [SuratMasukController::class, 'approveDisposisi']);

//Approve Surat Masuk
Route::get('/approve-disposisi/{token}', function ($token) {
    $surat = SuratMasuk::where('disposisi_token', $token)->first();

    if (!$surat) {
        return abort(404, 'Token tidak ditemukan');
    }

    $surat->status_disposisi = 'Disetujui';
    $surat->save();

    return view('disposisi.approved'); // halaman konfirmasi
});

//Rejected Surat Masuk
// Reject
Route::get('/reject-disposisi/{token}', function ($token) {
    $surat = \App\Models\SuratMasuk::where('disposisi_token', $token)->first();

    if (!$surat) {
        return abort(404, 'Token tidak ditemukan');
    }

    $surat->status_disposisi = 'Ditolak';
    $surat->save();

    return view('disposisi.rejected');
});

Route::get('/debug-user', function () {
    $user = \App\Models\User::where('email', 'admin3205@gmail.com')->first();

    return [
        'exists' => $user !== null,
        'hashed_password' => $user?->password,
        'check_password' => \Illuminate\Support\Facades\Hash::check('password', $user->password),
    ];
});
