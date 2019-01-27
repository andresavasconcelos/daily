<?php

namespace App\Http\Controllers\Admin;

use App\Noticia;
use App\Http\Controllers\Controller;
use App\Revista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NoticiasController extends Controller
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
        $noticias = Noticia::orderBy('id', 'DESC')->get();

//        ##### FILTRO EVENTOS ######

        $noticias = DB::table('noticias')
            ->where(function($query) use($request) {
                if ($request->titulo != "") {
                    $query->where('noticias.titulo', 'like', "%{$request->titulo}%");
                }

                if ($request->data != "") {
                    $query->where("noticias.resenha", "like", "%{$request->resenha}%");
                }

            })->orderBy('noticias.id', 'DESC')->paginate(10);

//        ##### FILTRO EVENTOS ######

        return view('admin.noticias.index', compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $revistas = Revista::all();
//        $noticias = Noticia::with('revista')->get();

        return view('admin.noticias.adicionar', compact('revistas'));
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
            'descricao'       => 'required',
            'is_featured'    => 'required',
            'status'         => 'required',
            'imagem'         => 'required',
        ];

        $messages = [
            'titulo.required'          => 'Preencha o título da notícia',
            'resenha.required'         => 'Preencha a resenha da notícia',
            'descricao.required'        => 'Preencha com o conteúdo da notícia',
            'is_featured.required'     => 'Preencha se a notícia é destaque',
            'status.required'          => 'Preencha o status de notícia',
            'imagem.required'          => 'Preencha o status de notícia',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){

            Noticia::create($request->all());

            return redirect('/admin/noticias')->with(['success' => 'Notícia cadastrada com sucesso']);
        } else{
            return redirect('admin/noticia/adicionar')->withErrors($validator)->withInput();
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
    public function edit(Noticia $noticia, $id)
    {
        $editNoticia = $noticia->find($id);

        if($editNoticia){
            return view('admin.noticias.editar', compact('editNoticia'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Noticia $noticia, $id)
    {
        $trazNoticia = $noticia->find($id);

        if(!empty($trazNoticia)) {

            $response = $request->all();

            $rules = [
                'titulo' => 'required',
                'resenha' => 'required',
                'descricao' => 'required',
                'is_featured' => 'required',
                'status' => 'required',
                'imagem' => 'required',
            ];

            $messages = [
                'titulo.required' => 'Preencha o título da notícia',
                'resenha.required' => 'Preencha a resenha da notícia',
                'descricao.required' => 'Preencha com o conteúdo da notícia',
                'is_featured.required' => 'Preencha se a notícia é destaque',
                'status.required' => 'Preencha o status de notícia',
                'imagem.required' => 'Preencha o status de notícia',
            ];

        }
        $validator = Validator::make($request->all(), $rules, $messages);
        $response['alias'] = $this->sanitizeString($response['titulo']);

        if ($validator->passes()) {

            $trazNoticia->update($response);

            return redirect('admin/noticia/editar/' . $id)->with(['success' => 'Noticia editada com sucesso']);

        } else {

            return redirect('admin/noticia/editar/' . $id)->withErrors($validator);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noticia $noticia)
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
