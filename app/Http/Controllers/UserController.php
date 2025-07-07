<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Aduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function dashboard(){
        $laporans = Laporan::latest()->get();
        return view('user.dashboard',compact('laporans'));
    }
    public function store(Request $request){
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
        return redirect()->route('user.show', ['laporan' => $laporan->id])
                         ->with('success', 'Laporan berhasil dibuat.');
    }
    public function show(Laporan $laporan){
        return view('user.show',compact('laporan'));
    }
    public function edit(Laporan $laporan){
        
        return view('user.edit',compact('laporan'));
    }
    public function update(Request $request, Laporan $laporan){

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
                // Hapus file lama jika ada
                if ($laporan->$bukti) {
                    Storage::disk('public')->delete($laporan->$bukti);
                }
                $validated[$bukti] = $request->file($bukti)->store('bukti', 'public');
            } else {
                // Pertahankan file yang sudah ada jika tidak diupdate
                $validated[$bukti] = $laporan->$bukti;
            }
        }

         $laporan->update($validated);

        return redirect()->route('user.show', ['laporan' => $laporan->id])
                         ->with('success', 'Laporan berhasil di edit.');
    }
    public function previewPdf(Laporan $laporan){
       $pdf = Pdf::loadView('user.preview', compact('laporan'))
                  ->setPaper('a4', 'portrait');
        return $pdf->stream('SA-' . $laporan->nama . '-' . $laporan->id . '.pdf');
    }
    public function downloadpdf(Laporan $laporan){
       $pdf = Pdf::loadView('user.preview', compact('laporan'))
                  ->setPaper('a4', 'portrait');
        return $pdf->download('SA-' . $laporan->nama . '-' . $laporan->id . '.pdf');
    }
    public function add_surat(Request $request){
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
        return redirect()->route('user.dashboard', ['aduan' => $aduan->id])
                         ->with('success', 'Laporan berhasil dibuat.');
    }
}
