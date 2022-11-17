<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 7;
        if (strlen($katakunci)) {
            $data = mahasiswa::where('nim', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('jurusan', 'like', "%$katakunci%")
                ->orWhere('kelas', 'like', "%$katakunci%")
                ->orWhere('jeniskelamin', 'like', "%$katakunci%")
                ->orWhere('alamat', 'like', "%$katakunci%")
                ->paginate();
        } else {
            $data = mahasiswa::orderBy('nim', 'desc')->paginate();
        }
        return view('mahasiswa.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $path = $request->file->store('public/images');
        if ($request->file('file')->isValid()) {
            mahasiswa:create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'jeniskelamin' => $request->jeniskelamin,
            'alamat' => $request->alamat,
                'file'=>$path
            ]);
            return redirect()->route('mahasiswa')->with(['success' =>'Data Berhasil Disimpan']);
        }
        
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required|numeric:mahasiswa.kelas',
            'jeniskelamin' => 'required',
            'alamat' => 'required',
        ], [
            'nim.required' => 'NIM WAJIB DIISI',
            'nim.numeric' => 'NIM WAJIB DIISI DENGAN ANGKA',
            'nim.unique' => 'NIM SUDAH ADA',
            'nama.required' => 'NAMA WAJIB DIISI',
            'jurusan.required' => 'JURUSAN WAJIB DIISI',
            'jeniskelamin.required' => 'JENISKELAMIN WAJIB DIISI',
            'alamat.required' => 'ALAMAT WAJIB DIISI',

        ]);

        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'jeniskelamin' => $request->jeniskelamin,
            'alamat' => $request->alamat,
        ];

        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mahasiswa::where('nim', $id)->first();
        return view('mahasiswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'jeniskelamin' => 'required',
            'alamat' => 'required',
        ], [
            'nama.required' => 'NAMA WAJIB DIISI',
            'jurusan.required' => 'JURUSAN WAJIB DIISI',
        ]);

        $data = [
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'jeniskelamin' => $request->jeniskelamin,
            'alamat' => $request->alamat,
        ];
        mahasiswa::where('nim', $id)->update($data);
        mahasiswa::where('kelas', $id)->update($data);
        return redirect()->to('mahasiswa')->with('success', 'update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mahasiswa::where('nim', $id)->delete();
        return redirect()->to('mahasiswa')->with('success', 'Berhasil melakukan delete data');
    }
}
