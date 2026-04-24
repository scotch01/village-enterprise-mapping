<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Desa;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Usaha;
use App\Models\Jawaban;
use App\Models\JawabanDetail;

class UsahaController extends Controller
{

    public function create()
    {
        $user = auth()->user();
        $desa = $user->desa;

        if (!$desa) {
            abort(403);
        }

        return Inertia::render('Usaha/Create', [
            'wilayah' => [
                'provinsi' => $desa->provinsi,
                'kabupaten' => $desa->kabupaten,
                'kecamatan' => $desa->kecamatan,
                'desa' => $desa->nama,
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Blok I
            'nama_usaha' => 'required|string|max:255',
            'alamat' => 'required|string',

            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'website' => 'nullable|string|max:255',

            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            'jawaban.I.105' => 'nullable|string|max:255',
            'jawaban.I.106' => 'required|string|max:50',
            'jawaban.I.109' => 'required|string|max:50',

            'jawaban.I.110a' => 'required|in:1,2,3',
            'jawaban.I.110b' => Rule::requiredIf(
                in_array($request->input('jawaban.I.110a'), ['2','3'])
            ),
            'jawaban.I.110c' => 'required|in:1,2,3,4',

            // Blok II
            'jawaban.II.201a' => 'required|string|max:255',
            'jawaban.II.201b' => 'required|digits:16',
            'jawaban.II.201c' => 'required|in:1,2',
            'jawaban.II.201d' => 'required|integer|min:0|max:120',
            'jawaban.II.201e' => 'nullable|string|max:20',
            'jawaban.II.201f' => 'required|in:1,2,3,4,5,6,7,8,9',

            'jawaban.II.202' => 'required|in:1,2',

            'jawaban.II.203a' => 'required|in:1,2',
            'jawaban.II.203b' => Rule::requiredIf(
                $request->input('jawaban.II.203a') == '1'
            ),
        ]);

        $user = auth()->user();
        $desa = $user->desa;

        if (!$desa) {
            abort(403);
        }

        DB::transaction(function () use ($request, $user, $desa) {

            $usaha = Usaha::create([
                'desa_id' => $desa->id,
                'user_id' => $user->id,
                'nama_usaha' => $request->nama_usaha,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'website' => $request->website,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            $jawaban = Jawaban::create([
                'usaha_id' => $usaha->id,
                'blok' => 'I'
            ]);

            $auto = [
                '101' => $desa->provinsi,
                '102' => $desa->kabupaten,
                '103' => $desa->kecamatan_nama,
                '104' => $desa->nama,
            ];

            $inputJawaban = $request->input('jawaban.I');

            $data = array_merge($auto, $inputJawaban);

            if (!in_array($request->input('jawaban.I.110a'), ['2','3'])) {
                $data['110b'] = null;
            }

            foreach ($data as $kode => $value) {
                JawabanDetail::create([
                    'jawaban_id' => $jawaban->id,
                    'kode_pertanyaan' => $kode,
                    'value' => $value,
                ]);
            }

            $jawabanII = Jawaban::create([
                'usaha_id' => $usaha->id,
                'blok' => 'II'
            ]);

            $dataII = $request->input('jawaban.II');

            // skip logic
            if ($request->input('jawaban.II.203a') != '1') {
                $dataII['203b'] = null;
            }

            foreach ($dataII as $kode => $value) {
                JawabanDetail::create([
                    'jawaban_id' => $jawabanII->id,
                    'kode_pertanyaan' => $kode,
                    'value' => $value,
                ]);
            }
            
        });

        return redirect('/dashboard-pengisi');
    }
}
