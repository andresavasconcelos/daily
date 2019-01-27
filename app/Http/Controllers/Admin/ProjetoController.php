<?php

namespace App\Http\Controllers\Admin;

use App\Projeto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjetoController extends Controller
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
        $projeto = Projeto::orderBy('id', 'DESC')->get();

//        ##### FILTRO Projeto ######

        $projetos = DB::table('projetos')
            ->where(function($query) use($request) {
                if ($request->nome != "") {
                    $query->where('projetos.nome', 'like', "%{$request->nome}%");
                }

                if ($request->descricao != "") {
                    $query->where("projetos.descricao", "like", "%{$request->descricao}%");
                }


            })->orderBy('projetos.id', 'DESC')->paginate(10);


//        ##### FILTRO EVENTOS ######

        return view('admin.projetos.index', compact('projetos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projeto = Projeto::all();

        return view('admin.projetos.adicionar', compact('projeto'));
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
            'nome'         => 'required',
            'descricao'      => 'required',
        ];

        $messages = [
            'nome.required'          => 'Preencha o nome projeto',
            'descricao.required'         => 'Preencha a descricao do projeto',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){

            Projeto::create($request->all());

            return redirect('/admin/projetos')->with(['success' => 'Projeto cadastrado com sucesso']);
        } else{
            return redirect('admin/projeto/adicionar')->withErrors($validator)->withInput();
        }
    }

    public function edit(Projeto $projeto, $id)
    {
        $editProjeto = $projeto->find($id);

        if($editProjeto){
            return view('admin.projetos.editar', compact('editProjeto'));
        }

    }

    public function update(Request $request, Projeto $projeto, $id)
    {

        $trazProjeto = $projeto->find($id);

        if(!empty($trazProjeto)) {

            $response = $request->all();

            $rules = [
                'nome'      => 'required',
                'descricao'   => 'required',
            ];

            $messages = [
                'nome.required'        => 'Preencha o nome do evento',
                'descricao.required'     => 'Preencha a descricao do evento',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->passes()){

                $response = $request->all();
//                $response['alias'] = $this->sanitizeString($response['titulo']);

                Projeto::create($response);

                return redirect('/admin/projetos')->with(['success' => 'Projeto editado com sucesso']);

            } else{

                return redirect('admin/projeto/editar')->withErrors($validator)->withInput();

            }

        }
    }
}
