<?php

namespace App\Http\Controllers;

use App\Models\Util\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{   
    public function index() {
        return view('download.index', [
            'menu' => Menu::FILES,
        ]);
    }

    public function degreeSchedule() {
        return Storage::download('public/grade_horario.docx');
    }
    
    public function manual() {
        return Storage::download('public/manual.pdf');
    }
}
