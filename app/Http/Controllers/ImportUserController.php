<?php

namespace App\Http\Controllers;

use App\Models\Campus;
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

            if($user === null) {
                dd($user, $data[2]);
            }

            // $user->campus_id = 3;
            // if(!$user->save()) {
            //     dd('errors');
            // }
        }

        fclose($handle);

        dd(3, $with_emails, $less_emails);

        return redirect()->route('import_index');
    }
}
