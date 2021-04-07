$(function () {

    //var viewPort = $(this).outerWidth();
    var pausar = true;

    $(document).ready(function () {
	$('.slide_controll').slideUp();
        $('.bullet_controll').slideUp();
        $('.stop_controll').slideUp();
        produto();
    });

    $('.botao_menu').click(function ( ) {
        $('.menu').slideToggle();
        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });

    $('.menu_item').click(function () {
        $(this).children('.sub_item_menu').slideToggle();
    });

    $('.slide').hover(function () {
        $(this).children('.slide_controll').slideToggle();
        $(this).children('.bullet_controll').slideToggle();
        $(this).children('.stop_controll').slideToggle();
    });

    $('.stop').click(function () {
        if (pausar) {
            pausar = false;
            $(this).html('<i class="fa fa-play" aria-hidden="true"></i>');
            $('.slide_controll').slideUp();
            $('.bullet_controll').slideUp();
            $('.stop_controll').slideUp();
        } else {
            pausar = true;
            $(this).html('<i class="fa fa-pause" aria-hidden="true"></i>');
            $('.slide_controll').slideUp();
            $('.bullet_controll').slideUp();
            $('.stop_controll').slideUp();
        }
    });

    $('.go').click(function () {

        var x = document.getElementsByTagName("h1");
        var texto = x[1].innerHTML.toString();
        if (texto === "Imagens da Empresa") {
            var imagem = $("#imagem_principal").attr("src").substring(17, 19);
            if (imagem === '01') {
                imagem2();
            } else if (imagem === '02') {
                imagem3();
            } else if (imagem === '03') {
                imagem4();
            } else if (imagem === '04') {
                imagem5();
            } else if (imagem === '05') {
                imagem6();
            } else if (imagem === '06') {
                imagem7();
            } else if (imagem === '07') {
                imagem1();
            }
        } else if (texto === "Produtos") {
            var imagem_prod = $("#imagem_produto").attr("src").substring(22, 24);
            if (imagem_prod === '01') {
                imagem_prod2();
            } else if (imagem_prod === '02') {
                imagem_prod3();
            } else if (imagem_prod === '03') {
                imagem_prod4();
            } else if (imagem_prod === '04') {
                imagem_prod5();
            } else if (imagem_prod === '05') {
                imagem_prod6();
            } else if (imagem_prod === '06') {
                imagem_prod1();
            }
        }

    });

    $('.back').click(function () {
        var x = document.getElementsByTagName("h1");
        var texto = x[1].innerHTML.toString();
        if (texto === "Imagens da Empresa") {
            var imagem = $("#imagem_principal").attr("src").substring(17, 19);
            if (imagem === '02') {
                imagem1();
            } else if (imagem === '03') {
                imagem2();
            } else if (imagem === '04') {
                imagem3();
            } else if (imagem === '05') {
                imagem4();
            } else if (imagem === '06') {
                imagem5();
            } else if (imagem === '07') {
                imagem6();
            } else if (imagem === '01') {
                imagem7();
            }
        } else if (texto === "Produtos") {
            var imagem_prod = $("#imagem_produto").attr("src").substring(22, 24);
            if (imagem_prod === '02') {
                imagem_prod1();
            } else if (imagem_prod === '03') {
                imagem_prod2();
            } else if (imagem_prod === '04') {
                imagem_prod3();
            } else if (imagem_prod === '05') {
                imagem_prod4();
            } else if (imagem_prod === '06') {
                imagem_prod5();
            } else if (imagem_prod === '01') {
                imagem_prod6();
            }
        }
    });

    $('.img01').click(function () {
        var x = document.getElementsByTagName("h1");
        var texto = x[1].innerHTML.toString();
        if (texto === "Imagens da Empresa") {
            imagem1();
        } else if (texto === "Produtos") {
            imagem_prod1();
        }
    });

    $('.img02').click(function () {
        var x = document.getElementsByTagName("h1");
        var texto = x[1].innerHTML.toString();
        if (texto === "Imagens da Empresa") {
            imagem2();
        } else if (texto === "Produtos") {
            imagem_prod2();
        }
    });

    $('.img03').click(function () {
        var x = document.getElementsByTagName("h1");
        var texto = x[1].innerHTML.toString();
        if (texto === "Imagens da Empresa") {
            imagem3();
        } else if (texto === "Produtos") {
            imagem_prod3();
        }
    });

    $('.img04').click(function () {
        var x = document.getElementsByTagName("h1");
        var texto = x[1].innerHTML.toString();
        if (texto === "Imagens da Empresa") {
            imagem4();
        } else if (texto === "Produtos") {
            imagem_prod4();
        }
    });

    $('.img05').click(function () {
        var x = document.getElementsByTagName("h1");
        var texto = x[1].innerHTML.toString();
        if (texto === "Imagens da Empresa") {
            imagem5();
        } else if (texto === "Produtos") {
            imagem_prod5();
        }
    });

    $('.img06').click(function () {
        var x = document.getElementsByTagName("h1");
        var texto = x[1].innerHTML.toString();
        if (texto === "Imagens da Empresa") {
            imagem6();
        } else if (texto === "Produtos") {
            imagem_prod6();
        }
    });

    $('.img07').click(function () {
        imagem7();
    });

    $('.secao').click(function () {
        if (event.target.className === 'titulo1') {
            $(this).children('.relacao_secao1').slideToggle();
            $(this).children('.relacao_subsecao1').slideToggle();
        } else if (event.target.className === 'titulo2') {
            objeto = '#' + event.target.id.substring(7);
            $(objeto).children('.relacao_secao2').slideToggle();
            $(objeto).children('.relacao_subsecao2').slideToggle();
        } else if (event.target.className === 'titulo3') {
            objeto = '#' + event.target.id.substring(7);
            $(objeto).children('.relacao_secao3').slideToggle();
            $(objeto).children('.relacao_subsecao3').slideToggle();
        }

    });

    $('.documento').click(function () {
        var str = event.target.toString();
        var pos = str.indexOf("doc_");
        str = str.substring((pos + 4), (pos + 8));
        var user = $('.usuario_relacao').text();
        $.post('_cdn/ajax.php', {doc: str, user: user}, function (data) {
            console.log(data);
        });
    });

    $('.msg_principal').click(function () {
        if ($(this).css("bottom") === '300px') {
            $(this).animate({bottom: '0'});
            $('.msg_formulario').animate({height: '0'});
        } else {
            $(this).animate({bottom: '300px'});
            $('.msg_formulario').animate({height: '300px'});
        }
    });

    setInterval(function () {

        if (pausar) {

            var imagem = $("#imagem_principal").attr("src").substring(17, 19);
            if (imagem === '01') {
                $("#imagem_principal").attr("src", "themes/img/imagem02.jpg");
                $('.img02').addClass('bullet_atual');
                $('.img01').removeClass('bullet_atual');
                $('.img03').removeClass('bullet_atual');
                $('.img04').removeClass('bullet_atual');
                $('.img05').removeClass('bullet_atual');
                $('.img06').removeClass('bullet_atual');
                $('.img07').removeClass('bullet_atual');
            } else if (imagem === '02') {
                $("#imagem_principal").attr("src", "themes/img/imagem03.jpg");
                $('.img03').addClass('bullet_atual');
                $('.img01').removeClass('bullet_atual');
                $('.img02').removeClass('bullet_atual');
                $('.img04').removeClass('bullet_atual');
                $('.img05').removeClass('bullet_atual');
                $('.img06').removeClass('bullet_atual');
                $('.img07').removeClass('bullet_atual');
            } else if (imagem === '03') {
                $("#imagem_principal").attr("src", "themes/img/imagem04.jpg");
                $('.img04').addClass('bullet_atual');
                $('.img01').removeClass('bullet_atual');
                $('.img02').removeClass('bullet_atual');
                $('.img03').removeClass('bullet_atual');
                $('.img05').removeClass('bullet_atual');
                $('.img06').removeClass('bullet_atual');
                $('.img07').removeClass('bullet_atual');
            } else if (imagem === '04') {
                $("#imagem_principal").attr("src", "themes/img/imagem05.jpg");
                $('.img05').addClass('bullet_atual');
                $('.img01').removeClass('bullet_atual');
                $('.img02').removeClass('bullet_atual');
                $('.img03').removeClass('bullet_atual');
                $('.img04').removeClass('bullet_atual');
                $('.img06').removeClass('bullet_atual');
                $('.img07').removeClass('bullet_atual');
            } else if (imagem === '05') {
                $("#imagem_principal").attr("src", "themes/img/imagem06.jpg");
                $('.img06').addClass('bullet_atual');
                $('.img01').removeClass('bullet_atual');
                $('.img02').removeClass('bullet_atual');
                $('.img03').removeClass('bullet_atual');
                $('.img04').removeClass('bullet_atual');
                $('.img05').removeClass('bullet_atual');
                $('.img07').removeClass('bullet_atual');
            } else if (imagem === '06') {
                $("#imagem_principal").attr("src", "themes/img/imagem07.jpg");
                $('.img07').addClass('bullet_atual');
                $('.img01').removeClass('bullet_atual');
                $('.img02').removeClass('bullet_atual');
                $('.img03').removeClass('bullet_atual');
                $('.img04').removeClass('bullet_atual');
                $('.img05').removeClass('bullet_atual');
                $('.img06').removeClass('bullet_atual');
            } else if (imagem === '07') {
                $("#imagem_principal").attr("src", "themes/img/imagem01.jpg");
                $('.img01').addClass('bullet_atual');
                $('.img02').removeClass('bullet_atual');
                $('.img03').removeClass('bullet_atual');
                $('.img04').removeClass('bullet_atual');
                $('.img05').removeClass('bullet_atual');
                $('.img06').removeClass('bullet_atual');
                $('.img07').removeClass('bullet_atual');
            }

        }

    }, 7000);
    //}, 1000);

    function imagem1() {
        $("#link_imagem").attr("href", "index.php?exe=principios");
        $("#imagem_principal").attr("title", "Imagem Panorâmica da Usina Santa S.A.");
        $("#imagem_principal").attr("alt", "Imagem Panorâmica da Usina Santa S.A.");
        $("#imagem_principal").attr("src", "themes/img/imagem01.jpg");
        $('.img01').addClass('bullet_atual');
        $('.img02').removeClass('bullet_atual');
        $('.img03').removeClass('bullet_atual');
        $('.img04').removeClass('bullet_atual');
        $('.img05').removeClass('bullet_atual');
        $('.img06').removeClass('bullet_atual');
        $('.img07').removeClass('bullet_atual');
    }

    function imagem2() {
        $("#link_imagem").attr("href", "index.php?exe=resp_social");
        $("#imagem_principal").attr("title", "Responsabilidade Social - CECOI");
        $("#imagem_principal").attr("alt", "Responsabilidade Social - CECOI");
        $("#imagem_principal").attr("src", "themes/img/imagem02.jpg");
        $('.img02').addClass('bullet_atual');
        $('.img01').removeClass('bullet_atual');
        $('.img03').removeClass('bullet_atual');
        $('.img04').removeClass('bullet_atual');
        $('.img05').removeClass('bullet_atual');
        $('.img06').removeClass('bullet_atual');
        $('.img07').removeClass('bullet_atual');
    }

    function imagem3() {
        $("#link_imagem").attr("href", "index.php?exe=resp_ambiental");
        $("#imagem_principal").attr("title", "Responsabilidade Ambiental - Reflorestamento");
        $("#imagem_principal").attr("alt", "Responsabilidade Ambiental - Reflorestamento");
        $("#imagem_principal").attr("src", "themes/img/imagem03.jpg");
        $('.img03').addClass('bullet_atual');
        $('.img01').removeClass('bullet_atual');
        $('.img02').removeClass('bullet_atual');
        $('.img04').removeClass('bullet_atual');
        $('.img05').removeClass('bullet_atual');
        $('.img06').removeClass('bullet_atual');
        $('.img07').removeClass('bullet_atual');
    }

    function imagem4() {
        $("#link_imagem").attr("href", "index.php?exe=resp_social");
        $("#imagem_principal").attr("title", "Campanha de Prevenção de Acidentes de Trabalho");
        $("#imagem_principal").attr("alt", "Campanha de Prevenção de Acidentes de Trabalho");
        $("#imagem_principal").attr("src", "themes/img/imagem04.jpg");
        $('.img04').addClass('bullet_atual');
        $('.img01').removeClass('bullet_atual');
        $('.img02').removeClass('bullet_atual');
        $('.img03').removeClass('bullet_atual');
        $('.img05').removeClass('bullet_atual');
        $('.img06').removeClass('bullet_atual');
        $('.img07').removeClass('bullet_atual');
    }

    function imagem5() {
        $("#link_imagem").attr("href", "index.php?exe=resp_ambiental");
        $("#imagem_principal").attr("title", "Colheita de Cana-de-açúcar");
        $("#imagem_principal").attr("alt", "Colheita de Cana-de-açúcar");
        $("#imagem_principal").attr("src", "themes/img/imagem05.jpg");
        $('.img05').addClass('bullet_atual');
        $('.img01').removeClass('bullet_atual');
        $('.img02').removeClass('bullet_atual');
        $('.img03').removeClass('bullet_atual');
        $('.img04').removeClass('bullet_atual');
        $('.img06').removeClass('bullet_atual');
        $('.img07').removeClass('bullet_atual');
    }

    function imagem6() {
        $("#link_imagem").attr("href", "index.php?exe=resp_ambiental");
        $("#imagem_principal").attr("title", "Hilo de Entrada de Cana-de-açúcar");
        $("#imagem_principal").attr("alt", "Hilo de Entrada de Cana-de-açúcar");
        $("#imagem_principal").attr("src", "themes/img/imagem06.jpg");
        $('.img06').addClass('bullet_atual');
        $('.img01').removeClass('bullet_atual');
        $('.img02').removeClass('bullet_atual');
        $('.img03').removeClass('bullet_atual');
        $('.img04').removeClass('bullet_atual');
        $('.img05').removeClass('bullet_atual');
        $('.img07').removeClass('bullet_atual');
    }

    function imagem7() {
        $("#link_imagem").attr("href", "index.php?exe=resp_ambiental");
        $("#imagem_principal").attr("title", "Plantido de Cana-de-açúcar");
        $("#imagem_principal").attr("alt", "Plantido de Cana-de-açúcar");
        $("#imagem_principal").attr("src", "themes/img/imagem07.jpg");
        $('.img07').addClass('bullet_atual');
        $('.img01').removeClass('bullet_atual');
        $('.img02').removeClass('bullet_atual');
        $('.img03').removeClass('bullet_atual');
        $('.img04').removeClass('bullet_atual');
        $('.img05').removeClass('bullet_atual');
        $('.img06').removeClass('bullet_atual');
    }

    function imagem_prod1() {
        $("#imagem_produto").attr("src", "themes/img/imagem_prod01.jpg");
        $('.img01').addClass('bullet_atual');
        $('.img02').removeClass('bullet_atual');
        $('.img03').removeClass('bullet_atual');
        $('.img04').removeClass('bullet_atual');
        $('.img05').removeClass('bullet_atual');
        $('.img06').removeClass('bullet_atual');
    }

    function imagem_prod2() {
        $("#imagem_produto").attr("src", "themes/img/imagem_prod02.jpg");
        $('.img02').addClass('bullet_atual');
        $('.img01').removeClass('bullet_atual');
        $('.img03').removeClass('bullet_atual');
        $('.img04').removeClass('bullet_atual');
        $('.img05').removeClass('bullet_atual');
        $('.img06').removeClass('bullet_atual');
    }

    function imagem_prod3() {
        $("#imagem_produto").attr("src", "themes/img/imagem_prod03.jpg");
        $('.img03').addClass('bullet_atual');
        $('.img01').removeClass('bullet_atual');
        $('.img02').removeClass('bullet_atual');
        $('.img04').removeClass('bullet_atual');
        $('.img05').removeClass('bullet_atual');
        $('.img06').removeClass('bullet_atual');
        F
    }

    function imagem_prod4() {
        $("#imagem_produto").attr("src", "themes/img/imagem_prod04.jpg");
        $('.img04').addClass('bullet_atual');
        $('.img01').removeClass('bullet_atual');
        $('.img02').removeClass('bullet_atual');
        $('.img03').removeClass('bullet_atual');
        $('.img05').removeClass('bullet_atual');
        $('.img06').removeClass('bullet_atual');
    }

    function imagem_prod5() {
        $("#imagem_produto").attr("src", "themes/img/imagem_prod05.jpg");
        $('.img05').addClass('bullet_atual');
        $('.img01').removeClass('bullet_atual');
        $('.img02').removeClass('bullet_atual');
        $('.img03').removeClass('bullet_atual');
        $('.img04').removeClass('bullet_atual');
        $('.img06').removeClass('bullet_atual');
    }

    function imagem_prod6() {
        $("#imagem_produto").attr("src", "themes/img/imagem_prod06.jpg");
        $('.img06').addClass('bullet_atual');
        $('.img01').removeClass('bullet_atual');
        $('.img02').removeClass('bullet_atual');
        $('.img03').removeClass('bullet_atual');
        $('.img04').removeClass('bullet_atual');
        $('.img05').removeClass('bullet_atual');
    }

    $('.myBtn').click(function () {
        obj = 'msg_' + event.target.id.substring(4);
        modal = document.getElementById(obj);
        modal.style.display = "block";
    });

    $('.close').click(function () {
        modal.style.display = "none";
    });

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        
        if (event.target === modal) {
            modal = document.getElementById(obj);
            modal.style.display = "none";
        }
    }


});

function produto() {
    var x = document.getElementsByTagName("h1");
    var texto = x[1].innerHTML.toString();
    if (texto === "Produtos") {
        mostraImagem(1);
    }
}

function mostraImagem(img) {
    setTimeout(function () {
        if (img === 1) {
            $("#imagem_produto").attr("src", "themes/img/imagem_prod02.jpg");
            $('.img02').addClass('bullet_atual');
            $('.img01').removeClass('bullet_atual');
            $('.img03').removeClass('bullet_atual');
            $('.img04').removeClass('bullet_atual');
            $('.img05').removeClass('bullet_atual');
            $('.img06').removeClass('bullet_atual');
            img = 2;
        } else if (img === 2) {
            $("#imagem_produto").attr("src", "themes/img/imagem_prod03.jpg");
            $('.img03').addClass('bullet_atual');
            $('.img01').removeClass('bullet_atual');
            $('.img02').removeClass('bullet_atual');
            $('.img04').removeClass('bullet_atual');
            $('.img05').removeClass('bullet_atual');
            $('.img06').removeClass('bullet_atual');
            img = 3;
        } else if (img === 3) {
            $("#imagem_produto").attr("src", "themes/img/imagem_prod04.jpg");
            $('.img04').addClass('bullet_atual');
            $('.img01').removeClass('bullet_atual');
            $('.img02').removeClass('bullet_atual');
            $('.img03').removeClass('bullet_atual');
            $('.img05').removeClass('bullet_atual');
            $('.img06').removeClass('bullet_atual');
            img = 4;
        } else if (img === 4) {
            $("#imagem_produto").attr("src", "themes/img/imagem_prod05.jpg");
            $('.img02').addClass('bullet_atual');
            $('.img01').removeClass('bullet_atual');
            $('.img02').removeClass('bullet_atual');
            $('.img03').removeClass('bullet_atual');
            $('.img04').removeClass('bullet_atual');
            $('.img06').removeClass('bullet_atual');
            img = 5;
        } else if (img === 5) {
            $("#imagem_produto").attr("src", "themes/img/imagem_prod06.jpg");
            $('.img06').addClass('bullet_atual');
            $('.img01').removeClass('bullet_atual');
            $('.img02').removeClass('bullet_atual');
            $('.img03').removeClass('bullet_atual');
            $('.img04').removeClass('bullet_atual');
            $('.img05').removeClass('bullet_atual');
            img = 6;
        } else if (img === 6) {
            $("#imagem_produto").attr("src", "themes/img/imagem_prod01.jpg");
            $('.img01').addClass('bullet_atual');
            $('.img02').removeClass('bullet_atual');
            $('.img03').removeClass('bullet_atual');
            $('.img04').removeClass('bullet_atual');
            $('.img05').removeClass('bullet_atual');
            $('.img06').removeClass('bullet_atual');
            img = 1;
        }
        mostraImagem(img);
    }, 7000);
    
}

function envioMSG() {
    
    alert("Mensagem enviada com sucesso!");
    document.getElementById('FormMSG').submit();
    
}
