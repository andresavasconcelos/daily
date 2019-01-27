<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class Assinatura extends Model
{
    const STATUS_ORDER = [
        1 => 'Aguardando pagamento',
        2 => 'Em análise',
        3 => 'Pedido Pago',
        4 => 'Pedido em separação',
        5 => 'Em disputa',
        6 => 'Pedido Devolvido',
        7 => 'Cancelada'
    ];

    const SITUACAO = [
        0 => "Inativa",
        1 => "Ativa",
        2 => "Expirada",
        3 => "Cancelada",
     ];

    const PAYMENT = [
        'boleto' => "Boleto Bancário",
        'creditCard' => "Cartão de Crédito"
    ];

    protected $table = "assinaturas";

    protected $fillable = [
        "id_produto",
        "id_cliente",
        "data_efetivacao",
        "data_expiracao",
        "codigo_assinatura",
        "status",
        "situacao",
        "eletronico",
        "impresso",
        "token_transaction",
        "url_boleto",
        "paymentMethod"
    ];

    public function produtos()
    {
        return $this->hasOne('App\Produto', 'id_produto', 'id');
    }

    public function clientes()
    {
        return $this->belongsTo('App\Cliente', 'id_cliente', 'id');
    }

    public function assinaturasEnviadas()
    {
        return $this->belongsTo('App\AssinaturaEnviada', 'id_assinatura', 'id');
    }

    public static function getProduto($id_produto)
    {
        $produto = Produto::where('id', $id_produto)->first();

        return $produto;
    }

    public static function checkStatus($token_transaction, $status)
    {

        $order = Assinatura::where('token_transaction', $token_transaction)->first();
        $orderId = $order->id;
        $stateAct = $order->status;
        $statusCode = $status;

        self::changeStatus($orderId, $statusCode, $stateAct);

        return ['message' => 'Alteração de Status realizada com sucesso'];
    }

    public static function changeStatus($orderId, $trayStatus, $stateAct)
    {
        $comment = '';

        if($trayStatus == 1){
            $status = 1;
            $comment = "Aguardando pagamento";
        } elseif($trayStatus == 2) {
            $status = 2;
            $comment = "Em Análise";
        } elseif($trayStatus == 3) {
            $status = 3;
            $comment = "Transaçao aprovada";
        } elseif($trayStatus == 4) {
            $status = 4;
            $comment = "Disponível para envio";
        } elseif($trayStatus == 5) {
            $status = 5;
            $comment = "Em disputa pelo comprador";
        } elseif($trayStatus == 6) {
            $status = 6;
            $comment = "Devolvida";
        } elseif($trayStatus == 7) {
            $status = 7;
            $comment = "Transaçao cancelada";
        }

        $order = Assinatura::findorFail($orderId);

        if ($status != $stateAct) {
            $user = Cliente::find($order->id_cliente);

            $data = [
                'status' => $status,
                'status_comment' => (!empty($comment)) ? $comment : null,
            ];

            if ($status == 3) {
                $data['data_efetivacao'] = Carbon::now()->format('Y-m-d');

                $produto = Produto::find($order->id_produto);

                $data['data_expiracao'] = Carbon::now()->addMonths($produto->vigencia);
                $data['situacao'] = 1;
            }

            if($status > 3){
                $data['situacao'] = 3;
            }

            $order->update($data);

            if ($status == 3) {
                Mail::send('emails.aprovado',
                    array('order'   => $order,
                        'user'    => $user),
                    function ($message) use ($user) {

                        $message->from(env('MAIL_SENDER'), 'Empreenda Revista')
                            ->to($user->email)
                            ->subject('Seu pedido foi aprovado');
                    });
            }

            if ($status == 7) {
//                Mail::to($user)->send(new OrderDenied($order, $user, $address));
                Mail::send('emails.cancelado',
                    array('order'   => $order,
                        'user'    => $user),
                    function ($message) use ($user) {

                        $message->from(env('MAIL_SENDER'), 'Empreenda Revista')
                            ->to($user->email)
                            ->subject('Seu pedido foi cancelado');
                    });
            }
        }
    }

    public function getAssinatura($id_cliente)
    {
        $assinatura = Assinatura::where('id_cliente', $id_cliente)
                                  ->where('status', '<>', '0')
                                  ->where('status', '<>', '9')
                                  ->get();

        return $assinatura;
    }
}
