<?php

namespace App\Http\Controllers\Admin;

use App\Funcionario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FuncionarioController extends Controller
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
        $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','Ã','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );

        // matriz de saída
        $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','A','E','I','O','U','n','n','c','C','-','-','-','-','-','-','-','-','-','-','','-','-','-','-','-','-','-','-','-','-','-','-' );

        $stReturn = str_replace($what, $by, $string);

        // devolver a string
        return strtolower($stReturn);
    }

    public function index()
    {
        $funcionarios = Funcionario::orderBy('id', 'DESC')->get();

        return view('admin.funcionarios.index', compact('funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funcionarios = Funcionario::all();
//        $materias = Materia::with('revista')->get();

        return view('admin.funcionarios.adicionar', compact('funcionarios'));
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
            'nome'                   => 'required',
            'observacao'             => 'required',
            'status'              => 'required',
        ];

        $messages = [
            'nome.required'                    => 'Preencha a resenha da matéria',
            'observacao.required'        => 'Preencha com o conteúdo da matéria',
            'status.required'     => 'Preencha se a matéria é destaque',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){

            $response = $request->all();
//            $response['alias'] = $this->sanitizeString($response['titulo']);

            Funcionario::create($response);

            return redirect('/admin/funcionarios')->with(['success' => 'Funcionário cadastrado com sucesso']);

        } else{

            return redirect('admin/funcionario/adicionar')->withErrors($validator)->withInput();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */

    public function edit(Funcionario $funcionario, $id)
    {
        $editFuncionario = $funcionario->find($id);

        if($editFuncionario){
            return view('admin.funcionarios.editar', compact('editFuncionario'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionario $funcionario, $id)
    {
        $trazFuncionario = $funcionario->find($id);

        if(!empty($trazFuncionario)) {

            $response = $request->all();

            $rules = [
                'nome'         => 'required',
                'observacao'   => 'required',
            ];

            $messages = [
                'nome.required'          => 'Preencha o nome do evento',
                'observacao.required'    => 'Preencha a descricao do evento',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->passes()){

                $response = $request->all();
//                $response['alias'] = $this->sanitizeString($response['titulo']);

                Funcionario::create($response);

                return redirect('/admin/funcionarios')->with(['success' => 'Projeto editado com sucesso']);

            } else{

                return redirect('admin/funcionario/editar')->withErrors($validator)->withInput();

            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario $funcionario)
    {
        //
    }


}

