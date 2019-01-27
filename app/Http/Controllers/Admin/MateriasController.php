<?php

namespace App\Http\Controllers\Admin;

use App\Materia;
use App\Http\Controllers\Controller;
use App\Revista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MateriasController extends Controller
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

    public function index()
    {
        $materias = Materia::orderBy('id', 'DESC')->get();

        return view('admin.materias.index', compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $revistas = Revista::all();
//        $materias = Materia::with('revista')->get();

        return view('admin.materias.adicionar', compact('revistas'));
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
            'resenha'        => 'required',
            'conteudo'       => 'required',
            'is_featured'    => 'required',
            'status'         => 'required',
            'imagem'         => 'required',
        ];

        $messages = [
            'titulo.required'          => 'Preencha o título da matéria',
            'resenha.required'         => 'Preencha a resenha da matéria',
            'conteudo.required'        => 'Preencha com o conteúdo da matéria',
            'is_featured.required'     => 'Preencha se a matéria é destaque',
            'status.required'          => 'Preencha o status da materia',
            'imagem.required'          => 'Preencha com a imagem da materia',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){

            $response = $request->all();
            $response['alias'] = $this->sanitizeString(strtolower($response['titulo']));

            Materia::create($response);

            return redirect('/admin/materias')->with(['success' => 'Matéria cadastrada com sucesso']);

        } else{

            return redirect('admin/materia/adicionar')->withErrors($validator)->withInput();

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
    public function edit(Materia $materia, $id)
    {
        $editMateria = $materia->find($id);
        $revistas = Revista::all();

        if($editMateria){
            return view('admin.materias.editar', compact('editMateria', 'revistas'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materia $materia, $id)
    {
        $trazMateria = $materia->find($id);

        if(!empty($trazMateria)){

            $response = $request->all();

            $response['alias'] = $this->sanitizeString(strtolower($response['titulo']));

            $trazMateria->update($response);

            return redirect('admin/materia/editar/'.$id)->with(['success' => 'Produto editado com sucesso']);

        } else {

            return redirect('admin/materias')->with(['error' => 'Produto não encontrado']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materia $materia)
    {
        //
    }

    public function geraDados()
    {
//        $diaSemana = DiaSemana::with('cardapio')->get();
//        $cardapios = [];
//
//        $todos = DB::table('dias_da_semana')
//            ->select('*')
//            ->rightJoin('cardapio', 'cardapio.id', '=', 'dias_da_semana.id_cardapio')
//            ->get();
//
//        foreach ($todos as $cardapio) {
//            if ($cardapio->id_cardapio == null) {
//                $cardapios[] = $cardapio;
//            }
//        }
//        $dados = array("cardapios" => $cardapios,
//            "diaSemana" => $diaSemana);
//        return $dados;
    }
}
