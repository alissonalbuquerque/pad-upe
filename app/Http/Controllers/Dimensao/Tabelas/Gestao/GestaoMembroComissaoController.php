<?php

namespace App\Http\Controllers\Dimensao\Tabelas\Gestao;

use App\Http\Controllers\Controller;
use App\Models\Tabelas\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class GestaoMembroComissaoController extends Controller
{
    public function index($user_pad_id)
    {
        return $user_pad_id;
    }
    
    public function create(Request $request)
    {    
    }
    
    public function update($id, Request $request)
    {
    }
    
    
    public function ajaxValidation(Request $request)
    {
    }
    
    public function delete($id)
    {
    }
    
    public function search($user_pad_id = null)
    {
    }
    
    public function edit($id)
    {
    }
}