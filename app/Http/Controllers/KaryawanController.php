<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Imports\ImportKaryawan;
use App\Http\Resources\KaryawanResource;
use App\Http\Requests\PostKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;

class KaryawanController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('auth.admin')->only(['create', 'import', 'update']);
    }

    public function index(Karyawan $karyawan)
    {
        return new KaryawanResource($karyawan::with('has_unit_kerja')->get());
    }

    public function create(PostKaryawanRequest $request)
    {

        $karyawan = new Karyawan();

        $karyawan->nik = $request->nik;
        $karyawan->name = $request->name;
        $karyawan->unit_id = $request->unit_id;
        $karyawan->position_name = $request->position_name;
        $karyawan->date_of_birth = $request->date_of_birth;
        $karyawan->place_of_birth = $request->place_of_birth;
        $karyawan->created_at = date('Y-m-d H:i:s');
        $karyawan->created_by = auth()->user()->id;
        $karyawan->save();

        return new KaryawanResource($karyawan);
    }

    public function import(Request $request)
    {
        try {
            $file = $request->file("file")->store('import');

            $import = new ImportKaryawan;

            $import->import($file);

            if ($import->failures()->isNotEmpty()) {
                return response()->json(['status' => 'err validation', 'message' => $import->failures()]);
            }
            //code...
            return response()->json(['message' => 'Data karyawan berhasil di import']);
        } catch (\Throwable $th) {
            //throw $th;

            return response()->json(['status' => 'Unknown err', 'message' => $th->getMessage()]);
        }
    }

    public function update(int $karyawanId,  UpdateKaryawanRequest $request)
    {

        //validasi jika data karyawan yang akan di update by id exist

        $karyawan = new Karyawan();

        $karyawan::find($karyawanId);

        try {
            //code...
            $karyawan::find($karyawanId)->update([
                'nik' => $request->nik,
                'name' => $request->name,
                'unit_id' => $request->unit_id,
                'position_name' => $request->position_name,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => auth()->user()->id,
            ]);

            return new KaryawanResource($karyawan::find($karyawanId));
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function delete(int $karyawanId, Karyawan $karyawan)
    {
        try {
            //code...
            $karyawan::find($karyawanId)->delete();
            return response()->json(['status' => 'success', 'message' => 'Data karyawan berhasil dihapus !']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'message' => 'Data karyawan tidak ada dalam database !']);
        }
    }
}
