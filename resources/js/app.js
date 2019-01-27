
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function(){

    var _windowWidth = window.innerWidth;
    var stage;

    if(_windowWidth <= 768){
        stage = $('.stage .carousel-stage').width();
    } else {
        stage = $('.stage').width();
    }
    $('.item-jcarousel').css('width', stage+'px');

    if( navigator.userAgent.match(/Android/i)){
        $('.btnApp').attr('href','https://play.google.com/store/apps/details?id=social.hallo.android.empreendarevista');
        $('.btnApp img').attr('src', '../images/googleplay.png');
    }else if(navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i)){
        $('.btnApp').attr('href','https://itunes.apple.com/br/app/empreenda-revista/id1443517671?mt=8');
        $('.btnApp img').attr('src', '../images/download_appstorepng.png');
    }

    // if( navigator.userAgent.match(/Android/i)){
    //     $('.btnPlayStore').css('display','inline');
    // }else if(navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i)){
    //     $('.btnAppStore').css('display','inline');
    // }
});

require('../../node_modules/mdbootstrap/js/mdb');
// require('../../node_modules/jquery-unslider/dist/js/unslider-min');
require('../../node_modules/jquery-mask-plugin/dist/jquery.mask.min');
require('../../public/lib/jcarousel/jquery.jcarousel');
require('../../public/lib/jcarousel/jcarousel.connected-carousels');
// require('../../public/lib/jcarousel/jcarousel.basic');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


// *************SITE***************

//ALTURA HEADER
$(document).ready(function () {
    var alturaNav = $('.containerMenu').height();

    $('body').css('margin-top', alturaNav+"px");


});
$(window).on('resize', function () {
    var alturaNav = $('.containerMenu').height();

    $('body').css('margin-top', alturaNav+"px");

});



// ***UNSLIDER***

// ***SLIDER REVISTAS***


// ***REVISTA***
// if($('.bannerBtns button').length > 0){
//     var p = $( '.bannerBtns button.ativo' );
//     var linha = $( '.timeLine' );
//     var offset = p.offset();
//     var linha_offset = linha.offset();
//     // $('.bannerBtns .progresso').animate({ width: offset.left - linha_offset.left + 'px' });
// }
//
// $('body').on('click', '.bannerBtns button', function(){
//     var esse = this;
//     var p = $( esse );
//     var linha = $('.timeLine');
//     var offset = p.offset();
//     var linha_offset = linha.offset();
//     $('.bannerBtns .progresso').animate({ width: offset.left - linha_offset.left + 'px' });
//     $('.bannerBtns button').removeClass('ativo');
//     $(esse).addClass('ativo');
//     $('.bannerRevistas').unslider('animate:' + $(esse).val());
// });
//
// // ***REVISTA***
//  $('body').on('click', '.bannerRevistas .revista', function(){
//  var esse = this;
//  $('.boxRevistas .conteudo .embed').html('<div data-configid="'+$(esse).attr('embed')+'" style="width:400px; height:300px;" class="issuuembed"></div><script src="//e.issuu.com/embed.js"></script>');
//  if($(esse).attr('pdf') != ''){
//      $('.boxRevistas .conteudo .previa #pdf').val($(esse).attr('pdf'));
//      $('.boxRevistas .conteudo .previa').fadeIn(400);
//      $('.previa #submit').fadeIn(100);
//  } else {
//     $('.boxRevistas .conteudo .previa').fadeOut();
//  }
//     $('.boxRevistas .holder-revistas').fadeIn(400);
//  });
//
// $('body').on('click', '.boxRevistas .holder-revistas .fechar', function(){
//     $('.boxRevistas .holder-revistas').fadeOut(400);
//     $('.holder-revistas .previa .alert').remove();
// });


$(window).on('load', function () {
    var _windowWidth = window.innerWidth;
    var stage;

    if(_windowWidth <= 768){
        stage = $('.stage .carousel-stage').width();
    } else {
        stage = $('.stage').width();
    }

    $('.item-jcarousel').css('width', stage+'px');
});

$(window).on('resize', function () {
    var _windowWidth = window.innerWidth;
    var stage;

    if(_windowWidth <= 768){
        stage = $('.stage .carousel-stage').width();
    } else {
        stage = $('.stage').width();
    }

    $('.item-jcarousel').css('width', stage+'px');
});

$(document).ready(function() {
    //***MASK
    $('.tel').mask('(00) 0000-0000');
    $('.cel').mask('(00) 0 0000-0000');
    $('.cpf').mask('000.000.000-00');
    $('.cep').mask('00000-000');

    //CAROUSEL REVISTAS DESTAQUES

    // var stage = $('.stage').width();
    // console.log("stage "+stage);
    // $('.item-jcarousel').css('width', stage+'px');
    //
    // $('.carousel-stage').jcarousel({
    //     itemLoadCallback: getCurrImage()
    // });
    //
    // function getCurrImage(carousel, state){
    //     console.log(carousel);
    //     var currentImage = carousel.first-1;
    // }


});

//***AJAX FORM ASSINANTES
// $('#assinantes').on('submit', function(e){
//     e.preventDefault();
//
//     var submit_btn = $('#assinantes button');
//     var submit_btn_text = submit_btn.val();
//     var dados = new FormData($(this)[0]);
//     var enviando_formulario = false;
//
//     function volta_submit() {
//         submit_btn.removeAttr('disabled');
//         submit_btn.val(submit_btn_text);
//         enviando_formulario = false;
//     }
//
//     $.ajax({
//             url:$(this).attr('action'),
//             method: 'post',
//             data: dados,
//             processData: false,
//             contentType: false,
//             beforeSend: function(){
//                 enviando_formulario = true;
//                 submit_btn.attr('disabled', true);
//                 submit_btn.val('Enviando...');
//                 $('.error').remove();
//             },
//             success: function(data){
//                 volta_submit();
//
//                 $('.contact-notif').html(data);
//
//                 if( $(data).hasClass('alert-success') ){
//
//                     $('#assinantes input[type="text"], #assinantes textarea, #assinantes input[type="tel"], #assinantes input[type="password"], #assinantes input[type="email"]').val('');
//                 }
//             },
//             error: function(data){
//                 volta_submit();
//                 $('.contact-notif').html('<p class="alert alert-danger">Falha ao enviar dados! Tente novamente.</p>');
//
//             }
//         }
//     );
//     return false;
// });


//AJAX FORM CONTATO
$('#formContato').on('submit', function(e){
    e.preventDefault();

    var submit_btn = $('#formContato button');
    var dados = new FormData($(this)[0]);
    var enviando_formulario = false;
    var _url =  $(this).attr('action');

    function volta_submit() {
        submit_btn.removeAttr('disabled');
        enviando_formulario = false;
    }
    $.ajax({
        url: _url,
        method: 'post',
        data: dados,
        processData: false,
        contentType: false,
        beforeSend: function(){
            enviando_formulario = true;
            submit_btn.attr('disabled', true);
            $('.error').remove();
        },
        success: function(response){
            volta_submit();

            $('.contact-notif').html(response.success);

            $('#formContato input, #formContato textarea').val('');
        },
        error: function(data){
            volta_submit();
            $.each(data.error, function (key, value) {
                $('.contact-notif').html('<p class="alert alert-danger">'+value+'</p>');
            });

        }
    });
    return false;
});


//***FACEBOOK
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.2';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));




//***VIDEOS YOUTUBE
// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');
//
tag.src = "";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '100%',
        width: '640',
        videoId: 'YBZHejyg-9g',
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
    event.target.playVideo();
}

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
var done = false;
function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING && !done) {
        setTimeout(stopVideo, 6000);
        done = true;
    }
}
function stopVideo() {
    player.stopVideo();
}

//CAROUSEL
// $('.carouselRevistas').carousel({
//
//     // Número de imagens mostradas
//     num: 3,
//
//     // max width da imagem ativa
//     maxWidth: 250,
//
//     // min width de imagem ativa
//     maxHeight: 150,
//
//     // habilitando auto play
//     autoPlay: true,
//
//     // intervalo autoplay
//     showTime: 1000,
//
//     // velocidade da animação
//     animationTime: 300,
//
//     // 0.0 - 1.0
//     scale: 0.8,
//
//     // distância entre as imagens
//     distance: 50
//
// });


//TOOLTIPS
$('.allTtooltips').tooltip();

//CKEDITOR
$('.conteudo').ckeditor();

// $( 'textarea' ).ckeditor();
//
// //...
//
// $( 'form' ).ajaxSubmit( {
//     beforeSubmit: function() {
//         // The textarea is already updated now and has the same value as the editor, so you can validate it.
//     }
// } );

// CKEDITOR.replace( 'texto' );
