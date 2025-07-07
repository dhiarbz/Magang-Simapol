<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(){
        $laporan = Laporan::latest()->paginate(10, ['*'], 'laporan_page'); 

        $totalLaporan = Laporan::count();
        $totalAduan = Aduan::count(); 

        $today = Carbon::today();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $laporanHariini = Laporan::whereDate('created_at', $today)->count();
        $laporanBulanini = Laporan::whereMonth('created_at', $currentMonth)->whereYear('created_at',$currentYear)->count();
        
        $user = auth()->user();

        return view('admin.dashboard',compact('laporan','totalAduan','totalLaporan','laporanHariini','laporanBulanini','user'));
    }

    public function data_laporan(){
        $data = Laporan::paginate(25);
        $user = auth()->user();

        return view('admin.data_laporan',compact('user','data'));
    }

    public function view_add_laporan(){
        $data = Laporan::all();
        $user = auth()->user();

        return view('admin.add_laporan',compact('data','user'));
    }

    public function fadd_laporan(Request $request){
        $validated = $request->validate([
            'nik' => 'required|string',
            'nama' => 'required|string',
            'ttg' => 'required|string',
            'agama' => 'required|string',
            'pekerjaan' => 'required|string',
            'alamat_ktp' => 'required|string',
            'alamat_domisili' => 'required|string',
            'nomor_hp' => 'required|string',
            'isi_laporan' => 'required|string',
            'bukti_1' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'bukti_2' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'bukti_3' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

          foreach (['bukti_1', 'bukti_2', 'bukti_3'] as $bukti) {
            if ($request->hasFile($bukti)) {
                $validated[$bukti] = $request->file($bukti)->store('bukti', 'public');
            }
        }
        $laporan = Laporan::create($validated);
        return redirect()->route('admin.data_laporan', ['laporan' => $laporan->id])
                         ->with('success', 'Laporan berhasil dibuat.');
    }
    public function showUpdate_laporan($id){
        $laporan = Laporan::find($id);
        if (!$laporan) {
            return redirect()->route('admin.data_laporan')->with('error', 'Data pengunjung tidak ditemukan.');
        }
        $user = auth()->user();

        return view('admin.update_laporan', compact('laporan','user'));
    }
    public function fupdate_laporan(Request $request, $id)
    {
        $validated = $request->validate([
            'nik' => 'required|string',
            'nama' => 'required|string',
            'ttg' => 'required|string',
            'agama' => 'required|string',
            'pekerjaan' => 'required|string',
            'alamat_ktp' => 'required|string',
            'alamat_domisili' => 'required|string',
            'nomor_hp' => 'required|string',
            'isi_laporan' => 'required|string',
            'bukti_1' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'bukti_2' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'bukti_3' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            ]);

            $laporan = Laporan::find($id);
            if (!$laporan) {
                return redirect()->route('admin.data_laporan')->with('error', 'Data laporan tidak ditemukan.');
            }

            // Handle file uploads and delete old files if new ones are uploaded
            foreach (['bukti_1', 'bukti_2', 'bukti_3'] as $bukti) {
            if ($request->hasFile($bukti)) {
                // Delete old file if exists
                if ($laporan->$bukti && Storage::disk('public')->exists($laporan->$bukti)) {
                    Storage::disk('public')->delete($laporan->$bukti);
                }
                // Store new file
                 $validated[$bukti] = $request->file($bukti)->store('bukti', 'public');
                } else {
                    // Keep the old file if no new file was uploaded
                    $validated[$bukti] = $laporan->$bukti;
                }
            }

        // Update the laporan
        $laporan->update($validated);

        return redirect()->route('admin.data_laporan', ['laporan' => $laporan->id])
        ->with('success', 'Laporan berhasil diperbarui.');
    }
    public function delete_laporan($id){
        $laporan = Laporan::findOrFail($id);
        if(!$laporan){
            return redirect()->route('admin.data_laporan')->with('error','Data Tidak Ditemukan');
        }
        $laporan->delete();
        return redirect()->route('admin.data_laporan')->with('succes','Data Berhasil Dihapus');
    }
    public function detail_laporan($id){
        $laporan = Laporan::find($id);
                $user = auth()->user();

        return view('admin.detail_laporan',compact('laporan','user'));
    }

    public function previewPdf(Laporan $laporan){
       $pdf = Pdf::loadView('admin.preview', compact('laporan'))
                  ->setPaper('a4', 'portrait');
        return $pdf->stream('SA-' . $laporan->nama . '-' . $laporan->id . '.pdf');
    }

    public function showAduan(){
        $data = Aduan::paginate(25);
        $user = auth()->user();

        return view('admin.surat',compact('user','data'));
    }

    public function add_surat(){
        $user = auth()->user();

        return view('admin.add_surat',compact('user'));
    }
    public function fadd_surat(Request $request){
        $validated = $request->validate([
            'nomor_surat' => 'required|string|unique:aduans,nomor_surat',
            'hari' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'nama' => 'required|string|max:100',
            'ttg' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'domisili' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'nik' => 'required|string|max:20',
            'tujuan' => 'required|string|max:255',
            'tempat_kejadian' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'kerugian' => 'required|string',
            'teradu' => 'required|string',
            'korban' => 'required|string',
            'modus' => 'required|string',
            'keterangan' => 'nullable|in:belum,sudah pernah dilaporkan',
            'penerima' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'nrp' => 'required|string|max:30',
        ]);
        $aduan = Aduan::create($validated);
        return redirect()->route('admin.surat', ['aduan' => $aduan->id])
                         ->with('success', 'Laporan berhasil dibuat.');
    }
    public function downloadPdf(Aduan $aduan){
        $pdf = Pdf::loadView('admin.download', compact('aduan'))
                  ->setPaper('a4', 'portrait');
        return $pdf->stream('STPA-' . $aduan->nama . '-' . $aduan->id . '.pdf');
    }
    public function detail_surat($id){
        $aduan = Aduan::find($id);
                $user = auth()->user();

        return view('admin.detail_surat',compact('aduan','user'));
    }
    public function delete_surat($id){
        $aduan = Aduan::findOrFail($id);
        if(!$aduan){
            return redirect()->route('admin.surat')->with('error','Data Tidak Ditemukan');
        }
        $aduan->delete();
        return redirect()->route('admin.surat')->with('succes','Data Berhasil Dihapus');
    }
    public function update_surat($id){
        $aduan = Aduan::find($id);
        if (!$aduan) {
            return redirect()->route('admin.surat')->with('error', 'Data pengunjung tidak ditemukan.');
        }
        return view('admin.update_surat', compact('aduan'));
    }
    public function fupdate_surat(Request $request, $id){
         $validated = $request->validate([
            'nomor_surat' => 'required|string',
            'hari' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'nama' => 'required|string|max:100',
            'ttg' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'domisili' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'nik' => 'required|string|max:20',
            'tujuan' => 'required|string|max:255',
            'tempat_kejadian' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'kerugian' => 'required|string',
            'teradu' => 'required|string',
            'korban' => 'required|string',
            'modus' => 'required|string',
            'keterangan' => 'nullable|in:belum,sudah pernah dilaporkan',
            'penerima' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'nrp' => 'required|string|max:30',
        ]);
         $aduan = Aduan::find($id);
            if (!$aduan) {
                return redirect()->route('admin.surat')->with('error', 'Data laporan tidak ditemukan.');
            }

        // Update the laporan
        $aduan->update($validated);

        return redirect()->route('admin.surat', ['aduan' => $aduan->id])
        ->with('success', 'Laporan berhasil diperbarui.');
    }
    public function backup(){
        $laporan = Laporan::latest()->paginate(10, ['*'], 'laporan_page');
        $aduan = Aduan::latest()->paginate(10, ['*'], 'aduan_page');
                $user = auth()->user();

        return view('admin.backup',compact('aduan','laporan','user'));
    }
    public function exportLaporan_pdf()
{
    // 1. Ambil data
    $laporan = Laporan::latest()->get();

    // 2. Kirim data ke view menggunakan array atau fungsi compact()
    $pdf = Pdf::loadView('admin.exportLaporan_pdf', [
        'laporan' => $laporan
    ])->setPaper('a4', 'landscape');

    // 3. Download PDF
    return $pdf->download('backup-dataLaporan-simapol-' . date('Y-m-d') . '.pdf');
}

// Nama method disamakan dengan route untuk konsistensi
public function exportSTPA_pdf() 
{
    // 1. Ambil data
    $aduan = Aduan::latest()->get();

    // 2. Kirim data ke view menggunakan compact()
    $pdf = Pdf::loadView('admin.exportSTPA_pdf', compact('aduan'))
              ->setPaper('a4', 'landscape');

    // 3. Download PDF (ditambahkan tanggal agar nama file unik)
    return $pdf->download('backup-dataSTPA-simapol-' . date('Y-m-d') . '.pdf');
}

public function pengaturan(){
    $user = auth()->user();

    return view('admin.pengaturan',compact('user'));
}

public function updateProfile(Request $request){
    $request->validate([
        'name'=> 'required|string|max:255'
    ]);

    $user = auth()->user();
    $user->name = $request->name;
    $user->save();

    return back()->with('success','Nama Berhasil Diupdate');
}

public function updatePassword(Request $request){
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = auth()->user();

    if(!Hash::check($request->current_password,$user->password)){
        return back()->withError(['current_password' => 'Password lama salah.']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('succes','Password berhasil diubah.');
}

public function kelola_user(){
    $users = User::orderByRaw("CASE WHEN role = 'admin' THEN 0 ELSE 1 END")
                 ->latest()
                 ->paginate(10);

    return view('admin.kelola_user', compact('users'));
}
public function add_user(){
    $user = auth()->user();

    return view('admin.add_user',compact('user'));
}
public function fadd_user(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'nrp' => 'required|string|unique:users,nrp',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);
    User::create([
        'name' => $request->name,
        'nrp' => $request->nrp,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role ?? 'user',
    ]);

    return redirect()->route('admin.kelola_user')->with('success', 'User berhasil ditambahkan.');
}
public function update_user($id){
    $user = auth()->user();
    $users = User::findOrFail($id);
    return view('admin.update_user',compact('users','user'));
}
public function fupdate_user(Request $request,$id){
    $users = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'nrp' => 'required|string|unique:users,nrp,' . $users->id,
        'email' => 'required|email|unique:users,email,' . $users->id,
        'password' => 'nullable|min:6',
    ]);
    $users->name = $request->name;
    $users->nrp = $request->nrp;
    $users->email = $request->email;

    if ($request->filled('password')) {
        $users->password = Hash::make($request->password);
    }

    $users->save();

    return redirect()->route('admin.kelola_user')->with('success', 'User berhasil diperbarui.');
}

public function delete_user($id){
    $users = User::findOrFail($id);
    $users->delete();

    return redirect()->route('admin.kelola_user')->with('success', 'User berhasil dihapus.');
}
}
