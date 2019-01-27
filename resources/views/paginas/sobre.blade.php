@extends('layout_site.app')
@section('content')
    <section class="blocoSobre">
        <div class="container">
            <div class="row rowTitle">
                <div class="container">
                    <h1>A EMPREENDA</h1>
                </div>
            </div>
            <div class="row rowSobre">
                <div class="col-12 col-md-8 col-lg-8">
                    <h2>QUEM SOMOS</h2>
                    <p>Empreenda Revista é uma empresa que tem por objetivo fomentar o empreendedorismo nas cidades. Ela oferece ao empreendedor a oportunidade de divulgar seu negócio criando assim uma rede de pessoas focadas em buscar melhores resultados.</p>
                    <p><span>MISSÃO:</span> Fomentar o empreendedorismo através de ações de publicidade, oferecendo ao empreendedor a chance de divulgar seu negócio e fazer parte de uma rede de empresários que criam envolvimento e geram resultados.</p>

                    <h2>SOBRE O PORTAL</h2>
                    <p>O Portal Empreenda Revista tem como finalidade trazer conteúdos relevantes ao empreendedor e pessoas que desejam empreender, traz informações que ajudam a obter conhecimentos sobre gestão, inovação e marketing, o leitor irá conhecer experiências vitoriosas de empresas e empresários da região.</p>

                    <h2>SOBRE A REVISTA</h2>
                    <p>A revista tem por objetivo transferir aos leitores a experiência adquirida por empreendedores de sucesso da região, através de depoimentos de empreendedores e formadores de opinião, com informações para o sucesso na sua carreira profissional e empresarial.</p>

                    <h2>SEJA UM COLABORADOR DO PORTAL EMPREENDA REVISTA.</h2>
                    <p>Se você quer fazer parte da equipe de conteúdo do portal EMPREENDA REVISTA, envie um e-mail para contato@empreendarevista.com.br. Você pode ser um colaborador de conteúdo para artigos, blogs, lançamentos de livros e vídeos, e sugestões de pautas. Analisaremos o conteúdo e se for aprovado entraremos em contato.</p>
                </div>
                <div class="col-12 col-md-4 col-lg-4 imgSobre">
                    <img src="{{ asset('images/sobre_revistas1.png') }}" alt="" class="img-fluid">
                    {{--<img src="{{ asset('images/sobre_revistas1.png') }}" alt="" class="img-fluid">--}}
                </div>
            </div>
        </div>
    </section>
@endsection