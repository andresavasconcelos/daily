<?php

namespace App\Http\Controllers\Admin;

use App\Daily;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DailyController extends Controller
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
        $dailies = Daily::orderBy('id', 'DESC')->get();

        return view('admin.dailies.index', compact('dailies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dailies = Daily::all();
//        $materias = Materia::with('revista')->get();

        return view('admin.dailies.adicionar', compact('dailies'));
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
            'data'            => 'required',
            'tarefa'          => 'required',
        ];

        $messages = [
            'data.required'            => 'Preencha a data',
            'tarefa.required'          => 'Preencha tarefa ',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){

            $response = $request->all();
//            $response['alias'] = $this->sanitizeString($response['titulo']);

            Daily::create($response);

            return redirect('/admin/dailies')->with(['success' => 'Daily adicionada com sucesso']);

        } else{

            return redirect('admin/daily/adicionar')->withErrors($validator)->withInput();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */

    public function edit(DAily $daily, $id)
    {
        $editDaily = $daily->find($id);

        if($editDaily){
            return view('admin.dailies.editar', compact('editDaily'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Daily $daily, $id)
    {
        $trazDaily = $daily->find($id);

        if(!empty($trazDAily)) {

            $response = $request->all();

            $rules = [
//                'id_funcionario'  => 'required',
                'data'            => 'required',
//                'id_projeto'      => 'required',
                'tarefa'          => 'required',
                'observacao'      => 'required',
                'feito'           => 'required',

            ];

            $messages = [
//                'id_funcionario.required'  => 'Preencha o título da matéria',
                'data.required'            => 'Preencha a resenha da matéria',
//                'id_projeto.required'      => 'Preencha a resenha da matéria',
                'tarefa.required'          => 'Preencha com o conteúdo da matéria',
                'observacao.required'      => 'Preencha com o conteúdo da matéria',
                'feito.required'           => 'Preencha se a matéria é destaque',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
//            $response['alias'] = $this->sanitizeString($response['titulo']);

            if ($validator->passes()) {

                $trazDAily->update($response);

                return redirect('admin/daily/editar/' .$id)->with(['success' => 'Matéria editada com sucesso']);

            } else {

                return back()->withErrors($validator);

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
