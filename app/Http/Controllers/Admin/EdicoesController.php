<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Revista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EdicoesController extends Controller
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
        $edicoes = Revista::orderBy('id', 'DESC')->get();

        return view('admin.edicoes.index', compact('edicoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edicoes = Revista::all();

        return view('admin.edicoes.adicionar', compact('edicoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        dd($request->hasFile);

        $rules = [
            'titulo'         => 'required',
            'descricao'       => 'required',
            'imagem'         => 'required',
        ];

        $messages = [
            'titulo.required'          => 'Preencha o título da edição',
            'descricao.required'        => 'Preencha com o editorial da edição',
            'imagem.required'          => 'Preencha com a imagem da capa',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){

            $input = $request->all();

            if($request->hasFile('imagem')){

                $file      = $request->file('imagem');
                $extension = $file->getClientOriginalExtension();
                $size      = $file->getSize();

                if($extension != 'png' && $extension != 'jpeg' && $extension != 'jpg' || $size > 2024000){

                    return response()->json(["status" => 400, 'msg' => "O formato da imagem é inválida ou o tamanho ultrapassa o limite, por favor envie somente png, jpeg ou jpg com tamanho máximo de 2mb"]);

                } else {

                    $fileName = time().'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path('images/revista/');

                    $file->move($destinationPath, $fileName);

                }
            }

            unset($input['imagem']);
            $input['imagem'] = isset($fileName) ? $fileName : '';

            $input['alias'] = $this->sanitizeString(strtolower($input['titulo']));

            Revista::create($input);

            return redirect('/admin/edicoes')->with(['success' => 'Edição cadastrada com sucesso']);

        } else{

            return redirect('admin/edicao/adicionar')->withErrors($validator)->withInput();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */

    public function edit(Revista $edicao, $id)
    {
        $editEdicao = $edicao->find($id);

        if($editEdicao){
            return view('admin.edicoes.editar', compact('editEdicao'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Revista $edicao, $id)
    {
        $trazEdicao = $edicao->find($id);

        if(!empty($trazEdicao)) {

            $response = $request->all();


            if($request->hasFile('imagem')){

                if($response['imagem'] != $trazEdicao->imagem){

                    $file      = $request->file('imagem');
                    $extension = $file->getClientOriginalExtension();
                    $size      = $file->getSize();

                    if($extension != 'png' && $extension != 'jpeg' && $extension != 'jpg' || $size > 2024000){

                        return response()->json(["status" => 400, 'msg' => "O formato da imagem é inválida ou o tamanho ultrapassa o limite, por favor envie somente png, jpeg ou jpg com tamanho máximo de 2mb"]);

                    } else {

                        $fileName = time().'.'.$file->getClientOriginalExtension();
                        $destinationPath = public_path('images/revista/');

                        $file->move($destinationPath, $fileName);

                    }
                    unset($response['imagem']);

                } else {
                    $fileName = $trazEdicao->imagem;
                }


                $response['imagem'] = isset($fileName) ? $fileName : '';

            } else {
                $response['imagem'] = $trazEdicao->imagem;
            }

            $rules = [
                'titulo'         => 'required',
                'descricao'       => 'required'
            ];

            $messages = [
                'titulo.required'          => 'Preencha o título da edição',
                'descricao.required'        => 'Preencha com o editorial da edição'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            $response['alias'] = $this->sanitizeString(strtolower($response['titulo']));


            if ($validator->passes()) {

                $trazEdicao->update($response);

                return redirect('admin/edicao/editar/' . $id)->with(['success' => 'Edição editada com sucesso']);

            } else {

                return redirect('admin/edicao/editar/' . $id)->withErrors($validator);

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revista $edicao)
    {
        //
    }

    public function geraDados()
    {

    }
}
