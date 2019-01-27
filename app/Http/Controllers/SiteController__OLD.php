<?php

namespace App\Http\Controllers;

use App\Assinante;
use App\Assinatura;
use App\Categoria;
use App\Contato;
use App\Evento;
use App\Materia;
use App\Noticia;
use App\NoticiaEmpreendedorismo;
use App\Produto;
use App\Revista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use SEO;

class SiteController extends Controller
{
    public function index()
    {

        $assinaturas = Produto::where('status','1')->get();
        $revista = Revista::orderBy('id', 'DESC')->first();
        $revistas = Revista::with('materia')->get();
        $categorias = Categoria::all();
        $noticiasEmpreendedorismo = NoticiaEmpreendedorismo::with('categoria')->orderBy('id', 'DESC')->limit(3)->get();
        return view('index', compact('assinaturas','revista', 'revistas', 'categorias'));
    }

    public function getSobre()
    {
        return view('paginas.sobre');
    }

    public function getAssinaturas($code)
    {

        $assinaturas = Produto::where('code', '=', $code)->first();

        if($assinaturas != null){
            return view('paginas.assinaturas', compact('assinaturas'));
        }
        else{
            return redirect('404');
        }

    }

    public function getNaoEncontrado()
    {
        return view('paginas.nao_encontrado');
    }

    public function postAssinantes(Request $request)
    {
        $input = array_map('trim', $request->all());

        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirmPass' => 'required',
            'cpf' => 'required',
            'cep' => 'required',
            'address' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required'
        ];

        $msg = [
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'password.required' => 'O campo senha é obrigatório',
            'confirmPass.required' => 'O campo confirmar senha é obrigatório',
            'cpf.required' => 'O campo cpf é obrigatório',
            'cep.required' => 'O campo cep é obrigatório',
            'address.required' => 'O campo endereço é obrigatório',
            'numero.required' => 'O campo número é obrigatório',
            'bairro.required' => 'O campo bairro é obrigatório',
            'cidade.required' => 'O campo cidade é obrigatório',
            'estado.required' => 'O campo estado é obrigatório'
        ];

        $validator = Validator::make($input, $rules, $msg);

        if(!$validator->fails()) {

            if ($input['password'] != $input['confirmPass']) {

                return ['status' => false, 'error' => "As senhas não conferem"];

            } elseif ($input['telefone'] == '' && $input['celular'] == '') {

                return ['status' => false, 'error' => "Ao menos um telefone é necessário"];

            } else {

                $assinante = Assinante::create($input);

                Mail::send('emails.assinantes', $input, function ($message) use ($request) {

                    $message->from(env('EMAILCLIENTE'), $request['name'])
                        ->to(env('MAIL_RECEIVER'), $request->name, $request->email)
                        ->subject('Novo assinante cadastrado - Empreenda Revista');
                });

                if($assinante){
                    return ['status' => true, 'success' => "Cadastro realizado com sucesso!"];
                }

            }
        } else {
            $errMsg = array();

            foreach($validator->errors()->messages() as $index => $msg){
                foreach($msg as $key => $value){
                    $errMsg[$index] = $value;
                }
            }
            return ['status' => false, 'error' => $errMsg];
        }
    }

    public function getRevistas()
    {

        $revistas = Revista::orderBy('id', 'DESC')->get();

        return view('paginas.revistas', compact('revistas'));

    }

    public function postContato(Request $request)
    {
        $input = array_map('trim', $request->all());

        $rules = [
            'nome' => 'required',
            'email' => 'required',
            'assunto' => 'required',
            'mensagem' => 'required'
        ];

        $msg = [
            'nome.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'assunto.required' => 'O campo assunto é obrigatório',
            'mensagem.required' => 'O campo mensagem é obrigatório'
        ];

        $validator = Validator::make($input, $rules, $msg);

        if(!$validator->fails()) {

            if ($input['telefone'] == '' && $input['celular'] == '') {


                return ['status' => false, 'error' => "Ao menos um telefone é necessário"];
            } else {

                $contato = Contato::create($input);

                Mail::send('emails.contact', $input, function ($message) use ($request) {

                    $message->from(env('MAIL_SENDER'), $request['nome'])
                        ->to(env('MAIL_RECEIVER'), $request->nome, $request->email)
                        ->subject('Novo contato realizado - Empreenda Revista');
                });


                if($contato){
                    return ['status' => true, 'success' => "Contato enviado com sucesso! retornaremos em breve"];
                }

            }
        } else {
            $errMsg = array();

            foreach($validator->errors()->messages() as $index => $msg){
                foreach($msg as $key => $value){
                    $errMsg[$index] = $value;
                }
            }
            return ['status' => false, 'error' => $errMsg];
        }
    }

    public function getAssineJa()
    {

        $assinaturas = Produto::where('status','1')->get();
        $revista = Revista::orderBy('id', 'DESC')->first();

        return view('paginas.assineja', compact('assinaturas','revista'));
    }

    public function getNoticias()
    {
        $noticiaDestaque = Noticia::where('is_featured', '1')->first();
        $noticias = Noticia::where('is_featured', '0')->orderBy('id', 'DESC')->get();

        return view('paginas.noticias', compact('noticias', 'noticiaDestaque'));
    }

    public function getNoticia($alias)
    {
        $noticia = Noticia::where('alias', $alias)->with('noticiasGaleria')->first();

        SEO::setTitle($noticia->titulo);
        SEO::setDescription($noticia->resenha);
        SEO::opengraph()->setUrl(url('/noticia/'.$alias));
        SEO::setCanonical(url('/noticia/'.$alias));
        SEO::opengraph()->addProperty('type', 'articles');
        SEO::twitter()->setSite('@empreendarev');

        return view('paginas.noticia', compact('noticia'));
    }

    public function getEventos()
    {
        $eventoDestaque = Evento::where('is_featured', '1')->first();
        $eventos = Evento::where('is_featured', '0')->orderBy('id', 'DESC')->limit(4)->get();

        return view('paginas.eventos', compact('eventoDestaque', 'eventos'));
    }

    public function getEvento($alias)
    {
        $evento = Evento::where('alias', $alias)->with('eventosGaleria')->first();

        return view('paginas.evento', compact('evento'));
    }

    public function getMaterias()
    {
        $materias = Materia::orderBy('id','DESC')->get();
        return view('paginas.materias', compact('materias'));
    }

    public function getMateria($alias)
    {
        $materia = Materia::where('alias', $alias)->first();

        SEO::setTitle($materia->titulo);
        SEO::setDescription($materia->resenha);
        SEO::opengraph()->setUrl(url('/materia/'.$alias));
        SEO::setCanonical(url('/materia/'.$alias));
        SEO::opengraph()->addProperty('type', 'articles');
        SEO::twitter()->setSite('@empreendarev');

        return view('paginas.materia', compact('materia'));

    }

    public function getNoticiaEmp($alias)
    {
        $noticiaEmp = NoticiaEmpreendedorismo::where('alias', $alias)->first();

        SEO::setTitle($noticiaEmp->titulo);
        SEO::setDescription($noticiaEmp->resenha);
        SEO::opengraph()->setUrl(url('/noticia_empreendedorismo/'.$alias));
        SEO::setCanonical(url('/noticia_empreendedorismo/'.$alias));
        SEO::opengraph()->addProperty('type', 'articles');
        SEO::twitter()->setSite('@empreendarev');

        return view('paginas.noticia_emp', compact('noticiaEmp'));
    }
}

