<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PAD;
use App\Models\Tabelas\Constants;
use App\Models\User;
use App\Models\UserPad;
use App\Models\UserType;
use App\Models\UserTypePad;
use App\Models\Util\Menu;
use App\Models\Util\MenuItemsAdmin;
use App\Models\Util\MenuItemsTeacher;
use App\Models\Util\Status;
use Database\Seeders\PadSeeder;
use Exception;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PadController extends Controller
{
    /**
     * Show last PAD.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        if(Auth::user()->isTypeAdmin())
        {
            $users = User::initQuery()->whereType(UserType::TEACHER)->get();
            $pads = Pad::all();
            $menu = Menu::PADS;
            return view('pad.admin.index', ['menu' => $menu, 'pads' => $pads]);
        }
        
        if(Auth::user()->isTypeTeacher())
        {   
            $menu = Menu::PADS;
            $userPads = UserPad::initQuery()->whereUser(Auth::user()->id)->get();

            return view('pad.teacher.index', ['menu' => $menu, 'userPads' => $userPads]);
        }
    }

    /**
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {   
        $menu = Menu::PADS;
        return view('pad.teacher.view', ['user_pad_id' => $id, 'menu' => $menu]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $status = [
            Status::ATIVO => Status::listStatus(Status::ATIVO) 
        ];
        return view('pad.admin.create', ['status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'nome' => ['required', 'string', 'min:6', 'max:255'],
            'status' => ['required', 'integer'],
            'data_inicio' => ['required', 'date', 'before_or_equal:data_fim'],
            'data_fim' => ['required', 'date', 'after_or_equal:data_inicio'],
        ],
        [
            'required' => 'O campo de :attribute é obrigatório',
            'nome.min' => 'O campo de :attribute deve ter no mínimo 6 letras',
            'nome.max' => 'O campo de :attribute deve ter no máximo 255 letras',
            'data_inicio.before_or_equal' => 'A :attribute deve ser uma data anterior ou igual a data de fim',
            'data_fim.after_or_equal' => 'A :attribute deve ser uma data posterior ou igual a data de início',
        ]);

        if($validated)
        {
            $model = new Pad($request->all());
    
            if($model->save())
            {
                $users = User::initQuery()->whereType(UserType::TEACHER)->get();
                
                foreach($users as $user)
                {   
                    $profile = $user->profile(UserType::TEACHER);

                    $userPad = new UserPad();
                    $userPad->pad_id = $model->id;
                    $userPad->user_type_id = $profile->id;
                    $userPad->status = Status::ATIVO;
                    
                    $userPad->save();
                }

                return redirect()->route('pad_index')->with('success', 'PAD cadastrado com sucesso!');
            } else {
                return redirect()->route('pad_index')->with('success', 'Erro ao cadastrar o PAD!');
            }
        }

    }

    public function anexo()
    {
        return view('pad.anexo', ['index_menu' => 1 ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $pad = PAD::find($id);
        $status = Constants::listStatus();

        return view('pad.admin.edit', ['pad' => $pad, 'status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $validated = $request->validate([
            'nome' => ['required', 'string', 'min:6', 'max:255'],
            'status' => ['required', 'integer'],
            'data_inicio' => ['required', 'date', 'before_or_equal:data_fim'],
            'data_fim' => ['required', 'date', 'after_or_equal:data_inicio'],
        ],
        [
            'required' => 'O campo de :attribute é obrigatório',
            'nome.min' => 'O campo de :attribute deve ter no mínimo 6 letras',
            'nome.max' => 'O campo de :attribute deve ter no máximo 255 letras',
            'data_inicio.before_or_equal' => 'A :attribute deve ser uma data anterior ou igual a data de fim',
            'data_fim.after_or_equal' => 'A :attribute deve ser uma data posterior ou igual a data de início',
        ]);

        if($validated) {
            $model = Pad::find($id);
            $model->fill($request->all());
            
            if($model->save()) {
                return redirect()->route('pad_index')->with('success', 'PAD atualizado com sucesso!');
            } else {
                return redirect()->route('pad_index')->with('success', 'Erro ao atualizar o PAD!');
            }
        }
    }

    
    public function delete($id) {
        $model = Pad::find($id);

        if($model->delete()) {
            return redirect()->route('pad_index')->with('success', 'PAD removido com sucesso!');
        } else {
            return redirect()->route('pad_index')->with('fail', 'Não foi possível remover o PAD!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = PAD::find($id);
        $model->delete();

        return redirect('/pad/index');
    }
}