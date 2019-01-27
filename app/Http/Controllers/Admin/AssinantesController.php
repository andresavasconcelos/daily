<?php

namespace App\Http\Controllers\Admin;

use App\Assinatura;
use App\AssinaturaEnviada;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Exports\ClienteExport;
use App\Produto;
use App\Revista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AssinantesController extends Controller
{
    public function index(Request $request)
    {
        $assinantes = DB::table('clientes')->leftJoin("assinaturas", "clientes.id", "=", "assinaturas.id_cliente")
            ->select('clientes.id', 'clientes.name', 'clientes.cpf',
                'clientes.cnpj', 'clientes.email', 'clientes.celular',
                'clientes.cep' , 'clientes.address', 'clientes.numero',
                'clientes.complemento', 'clientes.bairro', 'clientes.cidade',
                'clientes.estado', 'clientes.telefone', DB::raw('COUNT(assinaturas.id) as qtdAssinaturas'),
                'clientes.created_at', 'assinaturas.status')
            ->where(function($query) use($request) {
                if ($request->name != "") {
                    $query->where('clientes.name', 'like', "%{$request->name}%");
                }

                if ($request->email != "") {
                    $query->where("clientes.email", "like", "%{$request->email}%");
                }

                if ($request->cpf != "") {
                    $query->where("clientes.cpf", "like", "%{$request->cpf}%");
                }

                if ($request->cnpj != "") {
                    $query->where("clientes.cnpj", "like", "%{$request->cnpj}%");
                }

                if ($request->status != "") {
                    $query->where("assinaturas.status", $request->status);
                }

            })->groupBy('clientes.name')
            ->orderBy('clientes.id', 'DESC')->paginate(10);


        return view('admin.assinantes.index', compact('assinantes'));
    }

    public function getAssinante($id)
    {
        $assinante = Cliente::where('id', $id)->with('assinatura')->first();

        return view('admin.assinantes.editar', compact('assinante'));
    }

    public function postAssinante(Cliente $assinante, Request $request, $id)
    {
        $assinante = $assinante->find($id);
        $arrCliente = $request->all();

        if($request->cpf == null){
            unset($arrCliente['cpf']);
        }

        if($request->cnpj == null){
            unset($arrCliente['cpf']);
        }

        if($request->cpf == null && $request->cnpj == null){
            return redirect('/admin/assinante/'.$id)->with(['error' => "Ao menos um campo de documento é necessário"]);
        }

        if($request->email == $assinante->email){
            unset($arrCliente['email']);
        }

        $rules = [
            "name"     => "required",
            "email"    => "sometimes|email|required|unique:clientes:".$id,
            "cpf"      => "sometimes|required",
            "cnpj"      => "sometimes|required",
            "celular"  => "required",
            "telefone" => "required",
            "numero"   => "required",
            "address"  => "required",
            "cep"      => "required",
            "estado"   => "required",
            "bairro"   => "required",
            "cidade"   => "required"
        ];

        $msgs = [
            "name.required"     => "Preencha o campo Nome",
            "email.required"    => "Preencha o campo Email",
            "email.email"       => "O campo email deve conter um email válido",
            "email.unique"      => "Este email já possui uma assinatura",
            "cpf.required"      => "O campo cpf é obrigatório",
            "cnpj.required"      => "O campo cnpj é obrigatório",
            "celular.required"   => "Preencha o campo celular",
            "telefone.required"  => "Preencha o campo telefone",
            "numero.required"   => "Preencha o campo Número",
            "address.required"  => "Preencha o campo Endereço",
            "cep.required"      => "Preencha o campo CEP",
            "estado.required"   => "Preencha o campo Estado",
            "bairro.required"   => "Preencha o campo Bairro",
            "cidade.required"   => "Preencha o campo Cidade",
        ];

        $validator = Validator::make($arrCliente, $rules, $msgs);

        if($validator->passes()){
            $assinante->update($arrCliente);


            return redirect('admin/assinante/'.$id)->with(['success' => "Cliente editado com sucesso"]);
        } else {
            return redirect('admin/assinante/'.$id)->withErrors($validator)->withInput();
        }
    }

    public function editarAssinatura(Assinatura $assinatura, Request $request, $id)
    {
        $assinatura = $assinatura->with('clientes')->find($id);

        $arrAssinatura = $request->all();

        $rules = [
            "data_efetivacao" => "required",
            "data_expiracao" => "required",
            "codigo_assinatura" => "required",
            "status" => "required",
            "situacao" => "required",
            "paymentMethod" => "required"
        ];

        $msgs = [
            "data_efetivacao.required" => "O campo data de efetivação é obrigatório",
            "data_expiracao.required" => "O campo data de expiração é obrigatório",
            "codigo_assinatura.required" => "O campo código da assinatura é obrigatório",
            "status.required" => "O campo status é obrigatório",
            "situacao.required" => "O campo situação é obrigatório",
            "paymentMethod.required" => "O campo forma de pagamento é obrigatório"
        ];

        $validator = Validator::make($arrAssinatura, $rules, $msgs);

        if($validator->passes()){

            $arrEdicao = [];

            if(isset($arrAssinatura['edicao'])){
                $arrEdicao = $arrAssinatura['edicao'];
                unset($arrAssinatura['edicao']);

                foreach($arrEdicao as $edicao){
                    $assinaturasEnviadas = AssinaturaEnviada::where('id_assinatura', $id)->where('edicao', $edicao)->first();
                    $assinaturasEnviadas->update(['enviado' => 1]);
                }
            }

            $assinatura->update($arrAssinatura);



            return redirect('/admin/assinante/'.$assinatura->clientes->id)->with(['success' => "Assinatura editada com sucesso"]);

        } else {
            return redirect('/admin/assinante/'.$assinatura->clientes->id)->withErrors($validator)->withInput();
        }

    }

    public function exportListAssinantes(Request $request)
    {
        $assinantes = DB::table('clientes')->leftJoin("assinaturas", "clientes.id", "=", "assinaturas.id_cliente")
            ->select('clientes.id', 'clientes.name', 'clientes.cpf',
                'clientes.cnpj', 'clientes.email', 'clientes.celular',
                'clientes.cep' , 'clientes.address', 'clientes.numero',
                'clientes.complemento', 'clientes.referencia', 'clientes.bairro', 'clientes.cidade',
                'clientes.estado', 'clientes.telefone', DB::raw('COUNT(assinaturas.id) as qtdAssinaturas'),
                'clientes.created_at', 'assinaturas.status')
            ->where(function($query) use($request) {
                if ($request->name != "") {
                    $query->where('clientes.name', 'like', "%{$request->name}%");
                }

                if ($request->email != "") {
                    $query->where("clientes.email", "like", "%{$request->email}%");
                }

                if ($request->cpf != "") {
                    $query->where("clientes.cpf", "like", "%{$request->cpf}%");
                }

                if ($request->cnpj != "") {
                    $query->where("clientes.cnpj", "like", "%{$request->cnpj}%");
                }

                if ($request->status != "") {
                    $query->where("assinaturas.status", $request->status);
                }

            })->groupBy('clientes.name')
            ->orderBy('clientes.id', 'DESC')->get();


//        $clienteExport = new ClienteExport($assinantes);

        return Excel::download(new ClienteExport($assinantes), 'clientes.xlsx');
    }
}
