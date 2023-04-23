<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;

class ImportUserController extends Controller
{
    public function actionIndex() {
        return view('imports.update_user');
    }

    public function actionStore(Request $request)
    {   
        $file = $request->file('uploadFile');
        $campus = Campus::whereId($request->campus_id)->first();
        $curso = Curso::whereCampusId($campus->id)->whereName('GERAL (TEMP)')->first();

        $handle = fopen($file, 'r');
        $lines = [];

        if($handle)
        {
            while(($data = fgetcsv($handle, 1000, ",")) !== false)
            {
                array_push($lines, $data);
            }
        }

        unset($lines[0]);

        $lines = array_map(function($array) {
            return [$array[1], $array[2], strtolower(trim($array[7]))];
        }, $lines);

        $with_emails = array_filter($lines, function($array) { return $array[2] !== '-'; });
        $less_emails = array_filter($lines, function($array) { return $array[2] === '-'; });

        foreach($with_emails as $data)
        {   
            $user = User::whereEmail($data[2])->first();

            $count = 0;
            $list = [];
            if($user === null) {
                array_push($list, $data);
                $count++;
            } else {
                $user->campus_id = $campus->id;
                $user->curso_id = $curso->id;
                $user->save();
            }
        }

        fclose($handle);

        dd($count, $list, $less_emails);

        return redirect()->route('import_index');
    }
}
