<?php

namespace App\Http\Controllers\Admin;

use App\Bonus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BonusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function sanitizeString($string) {

        // matriz de entrada
        $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );

        // matriz de saída
        $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-' );

        // devolver a string
        return str_replace($what, $by, $string);
    }

    public function index(Request $request)
    {
        $bonus = Bonus::orderBy('id', 'DESC')->get();

//        ##### FILTRO BONUS ######

        $bonus = DB::table('bonus')
            ->where(function($query) use($request) {
                if ($request->titulo != "") {
                    $query->where('bonus.titulo', 'like', "%{$request->titulo}%");
                }

                if ($request->data != "") {
                    $query->where("bonus.data", "like", "%{$request->data}%");
                }

            })->orderBy('bonus.id', 'DESC')->paginate(10);


//        ##### FILTRO EVENTOS ######

        return view('admin.bonus.index', compact('bonus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bonus = Bonus::all();
//        $materias = Materia::with('revista')->get();

        return view('admin.bonus.adicionar', compact('bonus'));
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
            'titulo'         => 'required',
            'descricao'      => 'required',
            'link'           => 'required',

        ];

        $messages = [
            'titulo.required'          => 'Preencha o título bônus',
            'descricao.required'         => 'Preencha a descricao bônus',
            'link.required'        => 'Preencha com o conteúdo de bônus',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){

            Bonus::create($request->all());

            return redirect('/admin/bonus')->with(['success' => 'Bônus cadastrado com sucesso']);
        } else{
            return redirect('admin/bonus/adicionar')->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function show(Cardapio $cardapio, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function edit(Bonus $bonus, $id)
    {
        $editBonus = $bonus->find($id);

        if($editBonus){
            return view('admin.bonus.editar', compact('editBonus'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bonus $bonus, $id)
    {

        $trazBonus = $bonus->find($id);

        if(!empty($trazBonus)) {

            $response = $request->all();

            $rules = [
                'titulo'      => 'required',
                'descricao'   => 'required',
                'link'        => 'required',

            ];

            $messages = [
                'titulo.required'        => 'Preencha o título do evento',
                'descricao.required'     => 'Preencha a resenha do evento',
                'link.required'          => 'Preencha com o conteúdo do evento',

            ];

        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $response = $request->all();
            $response['alias'] = $this->sanitizeString(strtolower($response['titulo']));

            Bonus::create($response);

            return redirect('/admin/bonus')->with(['success' => 'Bônus editado com sucesso']);

        } else {

            return redirect('admin/bonus/editar')->withErrors($validator)->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bonus $bonus)
    {
        //
    }

    public function geraDados()
    {

    }
}
