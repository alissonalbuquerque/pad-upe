<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\User;
use App\Models\UserType;
use App\Models\Util\Menu;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class UserController extends Controller
{   
    public function editPerfil() {
        return view('user.update_perfil', ['menu' => Menu::USER]);
    }

    public function updatePerfil(Request $request) {

        $validator = User::validator($request->all());

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::find(Auth::user()->id);
        $user->fill($request->all());
        $user->save();
        
        return redirect()->route('edit_perfil')->with('success', 'Salvo com sucesso!');

    }

    public function updatePassword(Request $request) {

        $validator = User::validator($request->all(), true);

        // if($validator->fails()) {
        //     return redirect()->back()->withErrors($validator->errors());
        // }

        // $user = User::find(Auth::user()->id);
        // $user->fill($request->all());
        // $user->save();
        
        // return redirect()->route('edit_perfil')->with('success', 'Salvo com sucesso!');

    }

    public function actionIndex(Request $request)
    {   
        $users = 
            User::initQuery();

        $users = $users->get();
        return view('users.index', [
            'users' => $users,
            'menu' => Menu::USERS,
        ]);
    }

    // Admin
    public function actionCreate(Request $request)
    {   
        $model = new User();

        return view('users.create', [
            'menu' => Menu::USERS,
            'model' => $model,
        ]);
    }

    public function actionStore(Request $request)
    {   
        $request->validate(User::ruleDefault(), User::messages());

        $model = new User();
        $model->fill($request->all());
        $model->status = Status::ATIVO;

        $email_splited = explode('@', $model->email);
        $password = array_shift($email_splited);
        $model->password = Hash::make($password);

        if($model->save())
        {
            return redirect()->route('user_edit', ['id' => $model->id])->with('success', 'Usuário cadastrado com sucesso!');
        }

        return redirect()->with('fail', 'Falha ao cadastrar Usuário!');
    }

    public function actionEdit($id)
    {
        $model = User::find($id);
        $status = [
            Status::ATIVO => Status::listStatus(Status::ATIVO),
            Status::INATIVO => Status::listStatus(Status::INATIVO)
        ];
        
        return view('users.update', [
            'menu' => Menu::USERS,
            'model' => $model,
            'status' => $status,
        ]);
    }

    public function actionUpdate($id, Request $request)
    {
        dd($id);
    }

    public function actionDelete($id) {

    }

    public function actionImport(Request $request)
    {   
        $request->validate(['file' => 'required|mimes:csv,txt,xlx,xls,xlsx,pdf|max:2048']);
        
        $file = $request->file;
        	
        $excel = Excel::toArray(new UsersImport, $file)[0];

        unset($excel[0]);

        $excel = array_filter($excel,
            function($row) {
                $email = trim($row[7]);
                return strstr($email, '@');
            }
        );

        $importCount = 0;
        $duplicados = 0;
        foreach($excel as $row)
        {   
            $email = trim(strtolower($row[7]));

            $userQuery = User::initQuery()->whereEmail($email)->first();
            
            if($userQuery === null) {

                $password = explode("@", $email);
                $password = array_shift($password);

                $user = new User();
                $user->name = trim($row[1]);
                $user->email = $email;
                $user->password = Hash::make($password);
                $user->status = Status::ATIVO;

                if($user->save())
                {
                    $userType = new UserType();
                    $userType->user_id = $user->id;
                    $userType->type = UserTYPE::TEACHER;
                    $userType->status = Status::ATIVO;
                    $userType->selected = true;

                    if($userType->save())
                    {
                        $importCount++;
                    }
                }

            } else {
                $duplicados++;
            }
        }

        return redirect()->route('user_import_view')->with('success', sprintf('Importado com Sucesso! Importados: %d | Duplicados: %d', $importCount, $duplicados));
    }

    public function actionImportView()
    {
        return view('users.importView');   
    }
}
