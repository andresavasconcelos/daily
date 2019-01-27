<?php

namespace App\Http\Controllers\Admin;

use App\Evento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventosController extends Controller
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
        $eventos = Evento::orderBy('id', 'DESC')->get();

//        ##### FILTRO EVENTOS ######

        $eventos = DB::table('eventos')
            ->where(function($query) use($request) {
                if ($request->titulo != "") {
                    $query->where('eventos.titulo', 'like', "%{$request->titulo}%");
                }

                if ($request->data != "") {
                    $query->where("eventos.data", "like", "%{$request->data}%");
                }

            })->orderBy('eventos.id', 'DESC')->paginate(10);


//        ##### FILTRO EVENTOS ######

        return view('admin.eventos.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eventos = Evento::all();
//        $eventos = Eventos::with('revista')->get();

        return view('admin.eventos.adicionar', compact('eventos'));
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
            'texto'       => 'required',
            'data'           => 'required',
            'hora'           => 'required',
            'is_featured'    => 'required',
            'imagem'         => 'required',
        ];

        $messages = [
            'titulo.required'          => 'Preencha o título de eventos',
            'resenha.required'         => 'Preencha a resenha de eventos',
            'texto.required'        => 'Preencha com o conteúdo de eventos',
            'data.required'            => 'Preencha com a data do conteúdo de eventos',
            'hora.required'            => 'Preencha com a hora do conteúdo de eventos',
            'is_featured.required'     => 'Preencha se o evento é destaque',
            'imagem.required'          => 'Preencha o imagem de eventos',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){

            $response = $request->all();
            $response['alias'] = $this->sanitizeString(strtolower($response['titulo']));

            Evento::create($response);


            return redirect('/admin/eventos')->with(['success' => 'Evento cadastrada com sucesso']);
        } else{

            return redirect('admin/evento/adicionar')->withErrors($validator)->withInput();

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
    public function edit(Evento $evento, $id)
    {
        $editEvento = $evento->find($id);

        if($editEvento){
            return view('admin.eventos.editar', compact('editEvento'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento, $id)
    {

        $trazEvento = $evento->find($id);

        if(!empty($trazEvento)) {

            $response = $request->all();

            $rules = [
                'titulo' => 'required',
                'resenha' => 'required',
                'texto' => 'required',
                'data' => 'required',
                'hora' => 'required',
                'is_featured' => 'required',

            ];

            $messages = [
                'titulo.required' => 'Preencha o título do evento',
                'resenha.required' => 'Preencha a resenha do evento',
                'texto.required' => 'Preencha com o conteúdo do evento',
                'data.required' => 'Preencha com o conteúdo do evento',
                'hora.required' => 'Preencha com o conteúdo do evento',
                'is_featured.required' => 'Preencha se o evento é destaque',

            ];

        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){

            $response = $request->all();
            $response['alias'] = $this->sanitizeString(strtolower($response['titulo']));

            Evento::create($response);

            return redirect('/admin/eventos')->with(['success' => 'Evento editado com sucesso']);

        } else{

            return redirect('admin/evento/adicionar')->withErrors($validator)->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eventos $evento)
    {
        //
    }

    public function geraDados()
    {
        $diaSemana = DiaSemana::with('cardapio')->get();
        $cardapios = [];

        $todos = DB::table('dias_da_semana')
            ->select('*')
            ->rightJoin('cardapio', 'cardapio.id', '=', 'dias_da_semana.id_cardapio')
            ->get();

        foreach ($todos as $cardapio) {
            if ($cardapio->id_cardapio == null) {
                $cardapios[] = $cardapio;
            }
        }
        $dados = array("cardapios" => $cardapios,
            "diaSemana" => $diaSemana);
        return $dados;
    }
}
