<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUnitKerjaRequest;
use App\Http\Resources\UnitKerjaResource;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('auth.admin')->only(['create', 'update', 'delete']);
    }

    public function index(UnitKerja $unitKerja)
    {
        return UnitKerjaResource::collection($unitKerja::with('updated_by')->paginate(10));
    }

    public function display_with_karyawan()
    {
    }

    public function create(PostUnitKerjaRequest $postUnitKerjaRequest)
    {

        $unitKerja = new UnitKerja();

        $unitKerja->name = $postUnitKerjaRequest->name;
        $unitKerja->created_at = date('Y-m-d H:i:s');
        $unitKerja->created_by = auth()->user()->id;
        $unitKerja->save();

        return new UnitKerjaResource($unitKerja);
    }

    public function update(int $unit_kerja_id, PostUnitKerjaRequest $request)
    {
        $unitKerja = new UnitKerja();

        // $unitKerja::find($unit_kerja_id);

        try {
            //code...
            $unitKerja::find($unit_kerja_id)->update(['name' => $request->name, '']);
            return new UnitKerjaResource($unitKerja::find($unit_kerja_id));
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'message' => 'Unit kerja tidak ada dalam database !']);
        }
    }

    public function delete(int $unit_kerja_id, UnitKerja $unitKerja){
        try {
            //code...
            $unitKerja::find($unit_kerja_id)->delete();
            return response()->json(['status' => 'success', 'message' => 'Unit kerja berhasil dihapus !']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'message' => 'Unit kerja tidak ada dalam database !']);
        }
    }
}
