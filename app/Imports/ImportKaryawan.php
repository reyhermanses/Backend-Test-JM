<?php

namespace App\Imports;

use Hash;
use Carbon\Carbon;
use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportKaryawan implements ToModel, WithHeadingRow, SkipsOnFailure, WithValidation
{

    use Importable, SkipsFailures;

    public function transform_date($value, $format = 'Y-m-d')
    {
        try {
            return Carbon::instance(Date::excelToDateTimeObject($value));
        } catch (\Throwable $th) {
            return Carbon::createFromFormat($format, $value);
        }
    }

    public function model(array $row)
    {
        return new Karyawan([
            //    'name'     => $row[0],
            //    'email'    => $row[1],
            //    'password' => Hash::make($row[2]),
            'nik' => $row['nik'],
            'name' => $row['name'],
            'unit_id' => $row['unitid'],
            'position_name' => $row['positionname'],
            'date_of_birth' => $this->transform_date($row['dateofbirth']),
            'place_of_birth' => $row['placeofbirth'],
            // 'created_at' => date('Y-m-d H:i:s'),
            'created_by' => auth()->user()->id,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nik' => ['nik' => 'unique:karyawan,nik'],
            '*.unit_id' => ['unitid' => 'required,unit_id'],
            // '*.name' => ['name' => 'required, name'],
            '*.position_name' => ['positionname' => 'required, position_name'],
            '*.date_of_birth' => ['dateofbirth' => 'required, date_of_birth'],
            '*.place_of_birth' => ['placeofbirth' => 'required, place_of_birth'],
        ];
    }
}
