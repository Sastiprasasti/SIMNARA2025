use App\Mail\DisposisiSurat;
use Illuminate\Support\Facades\Mail;

public function kirimDisposisi(Request $request)
{
$disposisi = $request->input('disposisi');
$emailMap = [
    "IPDS": "ipds3205@bps.go.id",
    "TU": "sastiprasasti01@gmail.com",
    "Kepala Kantor": "nevihendri@bps.go.id",
    "Neraca": "neraca@example.com",
    "Sosial": "sosial@example.com",
    "Distribusi": "distribusi@example.com",
    "Produksi": "produksi@example.com"
];

if (!isset($emailMap[$disposisi])) {
return back()->with('error', 'Disposisi tidak valid.');
}

Mail::to($emailMap[$disposisi])->send(new DisposisiSurat(
strtoupper($disposisi),
$request->nomor_surat,
$request->nama_pengirim,
$request->tujuan
));

return back()->with('success', 'Email disposisi dikirim!');
}