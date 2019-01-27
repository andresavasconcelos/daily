<?php

namespace App\Http\Controllers;

use App\Assinatura;
use App\AssinaturaEnviada;
use App\Cliente;
use App\Produto;
use App\Revista;
use Artistas\PagSeguro\PagSeguro;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function checkoutPayment(Request $request, Cliente $cliente, PagSeguro $ps, $code)
    {
        $paymentMethod = $request->paymentMethod;
        $cardToken = $request->cardToken;

        $arrCliente = [
            "name" => $request->Input('name'),
            "email" => $request->Input('email'),
            "password" => $request->Input('password'),
            "cpf" => $request->Input('cpf') ? $request->Input('cpf') : "",
            "cnpj" => $request->Input('cnpj') ? $request->Input('cnpj') : "",
            "celular" => $request->Input('celular'),
            "telefone" => $request->Input('telefone'),
            "numero" => $request->Input('numero'),
            "address" => $request->Input('address'),
            "cep" => $request->Input('cep'),
            "estado" => $request->Input('estado'),
            "bairro" => $request->Input('bairro'),
            "cidade" => $request->Input('cidade'),

            "embossing" => $request->Input('embossing'),
            "cepCard" => $request->Input('cepCard'),
            "estadoCard" => $request->Input('estadoCard'),
            "bairroCard" => $request->Input('bairroCard'),
            "cidadeCard" => $request->Input('cidadeCard'),
            "politica" => $request->Input('politica'),

            "creditCardHolderPhone" => $request->Input('creditCardHolderPhone'),
            "creditCardHolderCPF" => $request->Input('creditCardHolderCPF'),
            "creditCardHolderBirthDate" => $request->Input('creditCardHolderBirthDate'),
        ];


        if($arrCliente['cpf'] == null || $arrCliente['cpf'] == ""){
            unset($arrCliente['cpf']);
        }

        if($arrCliente['cnpj'] == null || $arrCliente['cnpj'] == ""){
            unset($arrCliente['cnpj']);
        }

        if($request->paymentMethod == "boleto"){
            unset($arrCliente['bairroCard']);
            unset($arrCliente['cepCard']);
            unset($arrCliente['cidadeCard']);
            unset($arrCliente['creditCardHolderBirthDate']);
            unset($arrCliente['creditCardHolderCPF']);
            unset($arrCliente['creditCardHolderPhone']);
            unset($arrCliente['embossing']);
            unset($arrCliente['estadoCard']);
        }

        $rules = [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "cpf " => "sometimes|required",
            "cnpj " => "sometimes|required",
            "celular" => "required",
            "telefone" => "required",
            "numero" => "required",
            "address" => "required",
            "cep" => "required",
            "estado" => "required",
            "bairro" => "required",
            "cidade" => "required",
            "politica" => "required",
            "cepCard" => "sometimes|required",
            "estadoCard" => "sometimes|required",
            "bairroCard" => "sometimes|required",
            "cidadeCard" => "sometimes|required",
            "embossing" => "sometimes|required",
            "creditCardHolderPhone" => "sometimes|required",
            "creditCardHolderCPF" => "sometimes|required",
            "creditCardHolderBirthDate" => "sometimes|required"
        ];

        $messages = [
            "name.required" => "Preencha o campo Nome",
            "email.required" => "Preencha o campo Email",
            "password.required" => "Preencha o campo Senha",
            "cpf.required" => "Preencha o campo CPF",
            "cnpj.required" => "Preencha o campo CNPJ",
            "celular.required" => "Preencha o campo Celular",
            "telefone.required" => "Preencha o campo Telefone",
            "numero.required" => "Preencha o campo Numero",
            "address.required" => "Preencha o campo Endereço",
            "cep.required" => "Preencha o campo CEP",
            "estado.required" => "Preencha o campo Estado",
            "bairro.required" => "Preencha o campo Bairro",
            "cidade.required" => "Preencha o campo Cidade",
            "politica.required" => "Por favor, aceite a política de assinatura",
            "cepCard.required" => "Preencha o campo CEP de cobrança",
            "estadoCard.required" => "Preencha o campo Estado do endereço de cobrança",
            "bairroCard.required" => "Preencha o campo Bairro do endereço de cobrança",
            "cidadeCard.required" => "Preencha o campo Cidade do endereço de cobrança",
            "embossing.required" => "Preencha o campo Nome impresso no cartão",
            "creditCardHolderPhone.required" => "Preencha um telefone para contato financeiro",
            "creditCardHolderCPF.required" => "Preencha o cpf do proprietário do cartão",
            "creditCardHolderBirthDate.required" => "Preencha a data de nascimento do proprietário do cartão"
        ];

        $validator = Validator::make($arrCliente, $rules, $messages);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()]);
        }

        $user = $cliente->where('email', $request->email)->first();

        $total =  (float)$request->installmentValue;
//        $total = str_replace(" ", "", $total);

        if(!$user){

            if($validator->passes()){
                $user = new Cliente();
                $user->name =  $arrCliente["name"];
                $user->email =  $arrCliente["email"];
                $user->password =  $arrCliente["password"];

                if(isset($arrCliente["cpf"])){
                    $user->cpf =  $arrCliente["cpf"] != '' ? $arrCliente["cpf"] : "N/I";
                }

                if(isset($arrCliente["cnpj"])){
                    $user->cnpj =  $arrCliente["cnpj"] != '' ? $arrCliente["cnpj"] : "N/I";
                }

                $user->celular =  $arrCliente["celular"];
                $user->telefone =  $arrCliente["telefone"];
                $user->numero =  $arrCliente["numero"];
                $user->address =  $arrCliente["address"];
                $user->cep =  $arrCliente["cep"];

                if(isset($arrCliente['complemento'])){
                    $user->complemento =  $arrCliente['complemento'] != "" ? $arrCliente['complemento'] : "N/I";
                }

                if(isset($arrCliente['referencia'])){
                    $user->referencia =  $arrCliente['referencia'] != "" ? $arrCliente['referencia'] : "N/I";
                }


                $user->estado =  $arrCliente["estado"];
                $user->bairro =  $arrCliente["bairro"];
                $user->cidade =  $arrCliente["cidade"];
                $user->politica = 1;

                $user->save();
            } else {
                return redirect('assinaturas/'.$code)->withErrors($validator)->withInput();
            }
        } else {
            $assinatura = Assinatura::where('id_cliente', $user->id)->first();

            if($assinatura ){
                if($assinatura->status == 1 || $assinatura->status != 0){
                    return redirect('assinaturas/'.$code)->with(['error' => "Este usuário possui uma assinatura ativa"]);
                }
            }
        }

        $produto = Produto::where('code', $code)->first();

        $lastOrder = Assinatura::orderBy('id', 'desc')->first();
        $lastOrder = is_null($lastOrder) ? 1 : $lastOrder->id + 1;

        $orderId = Carbon::now()->format('y').' '.str_pad($produto->id, 2, '0', STR_PAD_LEFT).' '.str_pad($lastOrder, 6, '0', STR_PAD_LEFT);

        $assinatura = new Assinatura();
        $assinatura->id_produto = $produto->id;
        $assinatura->id_cliente = $user->id;
        $assinatura->data_efetivacao = null;
        $assinatura->data_expiracao = null;
        $assinatura->codigo_assinatura = $orderId;
        $assinatura->status = 0;
        $assinatura->situacao = 0;
        $assinatura->eletronico = 0;
        $assinatura->impresso = 1;
        $assinatura->paymentMethod = $paymentMethod;
        $assinatura->save();

        $prods = [];

        $prods[0]['itemId'] = $produto->id;
        $prods[0]['itemDescription'] = utf8_encode($produto->nome);
        $prods[0]['itemQuantity'] = (int)1;
        $prods[0]['itemAmount'] = $total;

        $address = null;
        $tel = str_replace(['(', ')', '-', ' '], '', $request->telefone);
        $info = [];

        if($request->sameAddress){
            $address = [
                'billingAddressStreet' => utf8_encode($request->address),
                'billingAddressNumber' => $request->numero,
                'billingAddressDistrict' => utf8_encode($request->bairro),
                'billingAddressPostalCode' => str_replace('-', '', $request->cep),
                'billingAddressCity' => utf8_encode($request->cidade),
                'billingAddressState' => utf8_encode($request->estado)
            ];
        } else {
            $address = [
                'billingAddressStreet' => utf8_encode($request->addressCard),
                'billingAddressNumber' => utf8_encode($request->numeroCard),
                'billingAddressDistrict' => utf8_encode($request->bairroCard),
                'billingAddressPostalCode' => str_replace('-', '', $request->cepCard),
                'billingAddressCity' => utf8_encode($request->cidadeCard),
                'billingAddressState' => utf8_encode($request->estadoCard)
            ];
        }

        if(isset($arrCliente["cpf"]) && $arrCliente["cpf"] != "" && $arrCliente["cpf"] != null){
            $info = [
                'senderName' => $user->name, //Deve conter nome e sobrenome
                'senderPhone' => $tel, //Código de área enviado junto com o telefone
                'senderEmail' => $user->email,
                'senderHash' => $request->senderHash,
                'senderCPF' => $user->cpf //Ou CNPJ se for Pessoa Júridica
            ];

        } elseif (isset($arrCliente["cnpj"]) && $arrCliente["cnpj"] != "" && $arrCliente["cnpj"] != null){

            $info = [
                'senderName' => $user->name, //Deve conter nome e sobrenome
                'senderPhone' => $tel, //Código de área enviado junto com o telefone
                'senderEmail' => $user->email,
                'senderHash' => $request->senderHash,
                'senderCNPJ' => $user->cnpj //Ou CNPJ se for Pessoa Júridica
            ];
        }

        if($paymentMethod == 'creditCard'){
            $pagseguro = $ps->setReference($orderId)
                ->setSenderInfo($info)
                ->setCreditCardHolder([
                    'creditCardHolderName' => $request->nomeCard, //Deve conter nome e sobrenome
                    'creditCardHolderPhone' => $request->creditCardHolderPhone, //Código de área enviado junto com o telefone
                    'creditCardHolderCPF' => $request->creditCardHolderCPF, //Ou CNPJ se for Pessoa Júridica
                    'creditCardHolderBirthDate' => $request->creditCardHolderBirthDate,
                ])->setBillingAddress($address)
                ->setItems(
                    $prods
                )->send([
                    'paymentMethod' => $paymentMethod,
                    'amount' => $total,
                    'creditCardToken' => $cardToken,
                    'installmentQuantity' => 1,
                    'installmentValue' => $total
                ]);
        } elseif ($paymentMethod == 'boleto'){
            $pagseguro = $ps->setReference($orderId)
                ->setSenderInfo([
                    'senderName' => $user->name, //Deve conter nome e sobrenome
                    'senderPhone' => $tel, //Código de área enviado junto com o telefone
                    'senderEmail' => $user->email,
                    'senderHash' => $request->senderHash,
                    'senderCPF' => $user->cpf //Ou CNPJ se for Pessoa Júridica
                ])->setItems(
                    $prods
                )->send([
                    'paymentMethod' => $paymentMethod,
                    'amount' => $total,
                ]);
        }

        if($pagseguro->code) {

            $assinatura->update([
                'token_transaction' => (string) $pagseguro->code,
                'url_boleto' => (string) $pagseguro->paymentLink
            ]);

            $edicao = Revista::orderby('id', 'DESC')->first();


            for($i=0; $i < $produto->vigencia; $i++){
                $assinaturasEnviadas = new AssinaturaEnviada();

                if(Carbon::now()->today() < 15){
                    $edicaoEnv = $edicao->id + $i;
                }else{
                    $edicaoEnv = $edicao->id + $i + 1;
                }

                $assinaturasEnviadas->id_assinatura = $assinatura->id;
                $assinaturasEnviadas->edicao = '#'.$edicaoEnv;
                $assinaturasEnviadas->enviado = 0;

                $assinaturasEnviadas->save();

            }

            Mail::send('emails.assinantes', array(
                "produto"    => $produto,
                "cliente"    => $user,
                "assinatura" => $assinatura
            ), function ($message){
               $message->from(env('MAIL_SENDER'), 'Empreenda Revista')
                        ->to(env('MAIL_RECEIVER'))
                        ->subject("Nova assinatura realizada no site");
            });

            Mail::send('emails.assinantes_cliente', array(
                "cliente"    => $user
            ), function ($message) use ($user){
                $message->from(env('MAIL_SENDER'), 'Empreenda Revista')
                    ->to($user->email)
                    ->subject("Assinatura - Empreenda Revista");
            });

            session(['token_transaction' => (string) $pagseguro->code]);

            return response()->json([
                'success' => true,
                'url' => url('assinatura/confirmacao/'.Crypt::encrypt($assinatura->id)),
                'linkBoleto' => (isset($pagseguro->paymentLink) ? $pagseguro->paymentLink : '')
            ]);

        } else {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => (string) '',
                    'message' => (string) ''
                ]
            ]);
        }
    }

    public function confirmarPagamento($id)
    {
        $assinatura = Assinatura::find(Crypt::decrypt($id));

        if($assinatura){
            return view('paginas.confirmacao_pagamento', compact('assinatura'));
        } else {
            return redirect('404');
        }
    }


    public function listenerPagSeguro(Request $request, PagSeguro $ps)
    {

        $response = $ps->notification($request->notificationCode, $request->notificationType);

        if(!empty($response->code)) {
            $status = Assinatura::checkStatus($response->code, $response->status);
        } else {
            $status = '';
        }
        return response()->json($status);
    }


    public function updateClienteCompra(Request $request)
    {
        if($request->ajax()) {
            $this->validate($request, [
                'name' => 'required|max:255',
                'cpf' => 'required|max:14|cpf',
                'data_nasc' => 'required',
                'cell' => 'required'
            ]);

            $data = [
                'name' => $request->name,
                'cpf' => $request->cpf,
                'phone' => $request->phone,
                'data_nasc' => ($request->data_nasc) ? Carbon::createFromFormat('d/m/Y', $request->data_nasc)->format('Y-m-d') : null,
                'cell' => $request->cell
            ];

            $user = User::findOrFail(\Auth::user()->id);
            $user->update($data);
            if($user) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    public static function MoneyToBd($money) {
        $money = str_replace('R$', '', $money);
        $money = str_replace(['.', ','], ['', '.'], $money);
        return $money;
    }
}
