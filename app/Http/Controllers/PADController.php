<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PAD;
use Exception;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PADController extends Controller
{
    /**
     * Show last PAD.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $PADs = PAD::where('professor_id', '=', Auth::user()->id);
        return view('pad.index', ["PADs" => $PADs, 'index_menu' => 1 ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pad.create', ['index_menu' => 1 ]);
    }

    public function anexo()
    {
        return view('pad.anexo', ['index_menu' => 1 ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
			'first_name' => 'required|string|min:3|max:255',
			'city_name' => 'required|string|min:3|max:255',
			'email' => 'required|string|email|max:255'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('insert')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$student = new StudInsert;
                $student->first_name = $data['first_name'];
                $student->last_name = $data['last_name'];
				$student->city_name = $data['city_name'];
				$student->email = $data['email'];
				$student->save();
				return redirect('insert')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('insert')->with('failed',"operation failed");
			}
		}
        
        return redirect('/dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $model = PAD::find($id);
        return view('pad.update', ['pad' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $model = PAD::find($id);
        $model->name = $request->name;
        $model->save();

        return redirect('/pad/index');
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