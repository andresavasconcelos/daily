<table>
    <thead>
    <tr style="color: #007fff;width: 100;">
        <th>Clientes</th>
    </tr>
    <tr>
        {{--Linha--}}
    </tr>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>CPF</th>
        <th>CNPJ</th>
        <th>Celular</th>
        <th>Telefone</th>
        <th>CEP</th>
        <th>Endereço</th>
        <th>Número</th>
        <th>Complemento</th>
        <th>Referência</th>
        <th>Bairro</th>
        <th>Cidade</th>
        <th>Estado</th>
    </tr>
    <tr>
        {{--Linha--}}
    </tr>
    </thead>
    <tbody>
    @foreach($clientes as $cliente)
        <tr>
            <td>{{ $cliente->name }}</td>
            <td>{{ $cliente->email }}</td>
            @if($cliente->cpf != '')
                <td>{{ $cliente->cpf }}</td>
            @else
                <td>N/I</td>
            @endif
            @if($cliente->cnpj != '')
                <td>{{ $cliente->cnpj }}</td>
            @else
                <td>N/I</td>
            @endif
            <td>{{ $cliente->celular }}</td>
            <td>{{ $cliente->telefone }}</td>
            <td>{{ $cliente->cep }}</td>
            <td>{{ $cliente->address }}</td>
            <td>{{ $cliente->numero }}</td>
            @if($cliente->complemento != '')
                <td>{{ $cliente->complemento }}</td>
            @else
                <td>N/I</td>
            @endif
            @if($cliente->referencia != '')
                <td>{{ $cliente->referencia }}</td>
            @else
                <td>N/I</td>
            @endif
            <td>{{ $cliente->bairro }}</td>
            <td>{{ $cliente->cidade }}</td>
            <td>{{ $cliente->estado }}</td>
        </tr>
    @endforeach
    </tbody>
</table>