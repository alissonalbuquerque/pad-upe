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

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class UserController extends Controller
{
    public function editPerfil($tab = null)
    {   
        return view('user.update_perfil', [
            'tab' => $tab,
            'menu' => Menu::USER,
        ]);
    }

    public function updatePerfil(Request $request)
    {   
        $validator = User::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::find(Auth::user()->id);
        $user->fill($request->all());
        $user->save();

        return redirect()->route('edit_perfil')->with('success', 'Salvo com sucesso!');
    }

    public function updatePassword(Request $request)
    {
        $validator = User::validatorPassword($request->all());

        if($validator->fails()) {
            return redirect()->route('edit_perfil', ['tab' => 'password'])->withErrors($validator->errors());
        }

        $model = User::find(Auth::user()->id);
        $model->password = Hash::make($request->password);
        $model->save();

        return redirect()->route('edit_perfil', ['tab' => 'user'])->with('success', 'Senha salva com sucesso!');

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
    public function actionCreate()
    {   
        $model = new User();

        return view('users.create', [
            'menu' => Menu::USERS,
            'model' => $model,
            'tab' => 'user',
        ]);
    }

    public function actionStore(Request $request)
    {   
        $validator = User::validator($request->all());

        if($validator->fails()) {
            return redirect()->route('user_create')->withErrors($validator)->withInput();
        }

        $model = new User();
        $model->fill($request->all());
        $model->status = Status::ATIVO;

        $email_splited = explode('@', $model->email);
        $password = array_shift($email_splited);
        $model->password = Hash::make($password);

        if($model->save()) {
            return redirect()->route('user_edit', ['id' => $model->id])->with('success', 'Usuário cadastrado com sucesso!');
        }

        return redirect()->with('fail', 'Falha ao cadastrar Usuário!');
    }

    public function actionEdit(Request $request, $id)
    {   

        $model = User::find($id);
        $profiles = $model->profiles;
        $status = [
            Status::ATIVO => Status::listStatus(Status::ATIVO),
            Status::INATIVO => Status::listStatus(Status::INATIVO)
        ];

        if(count($profiles) <= 0) {
            Session::flash('warning', 'Não existem papeis cadastrados para esse usuário!');
        }

        $tab = $request->query('tab') ?? 'user';

        return view('users.update', [
            'menu' => Menu::USERS,
            'model' => $model,
            'status' => $status,
            'profiles' => $profiles,
            'tab' => $tab
        ]);
    }

    public function actionUpdate(Request $request, $id)
    {   
        $model = User::find($id);

        $validator = User::validator($request->all(), $model->id);

        if($validator->fails()) {
            return redirect()->route('user_edit', ['id' => $model->id])->withErrors($validator)->withInput();
        }

        $model->fill($request->all());

        if($model->save()) {
            return redirect()->route('user_index')->with('success', 'Usuário atualizado com sucesso!');
        }

        return redirect()->with('fail', 'Falha ao cadastrar Usuário!');
    }

    public function actionDelete($id)
    {
        dd($id);
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