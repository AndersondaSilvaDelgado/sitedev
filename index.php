<?php
ob_start();
require('_app/Config.inc.php');
//$endereco = $_SERVER ['REQUEST_URI'];
//$local = explode('/', $endereco);
//$local = (!empty($local[3]) ? $local[3] : 'index.php');
$url = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
$idioma = filter_input(INPUT_GET, 'idioma', FILTER_DEFAULT);

if (empty($url)) {
    $pagina = 'index.php';
    $pg = 'index';
} else {
    $pagina = $url . '.php';
    $pg = $url;
}

if ($idioma === 'pt') {
    $idioma = 1;
} elseif ($idioma === 'en') {
    $idioma = 2;
} else {
    $idioma = 1;
}

$iphone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
$ipad = strpos($_SERVER['HTTP_USER_AGENT'], "iPad");
$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'], "webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
$symbian = strpos($_SERVER['HTTP_USER_AGENT'], "Symbian");

$verDisp = true;
if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true):
    $verDisp = true;
else:
    $verDisp = false;
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Usina Santa Fé S.A.</title>
        <link rel="stylesheet" href="themes/css/boot.css?v=1"/>

        <?php if ($verDisp): ?>
            <link rel="stylesheet" href="themes/css/swiper.min.css"/>
            <link rel="stylesheet" href="themes/css/stylemobile.css?v=1"/>
        <?php else: ?>
            <link rel="stylesheet" href="themes/css/stylemain.css?v=2"/>
            <link rel="stylesheet" media="screen and (min-width: 0px) and (max-width: 1023px)" href="themes/css/style0_1023.css?v=1"/>
            <link rel="stylesheet" media="screen and (min-width: 1024px) and (max-width: 1279px)" href="themes/css/style1024_1279.css?v=1"/>
            <link rel="stylesheet" media="screen and (min-width: 1280px) and (max-width: 1359px)" href="themes/css/style1280_1359.css?v=1"/>
            <link rel="stylesheet" media="screen and (min-width: 1360px) and (max-width: 1599px)" href="themes/css/style1360_1599.css?v=3"/>
            <link rel="stylesheet" media="screen and (min-width: 1600px) and (max-width: 1919px)" href="themes/css/style1600_1919.css?v=1"/>
            <link rel="stylesheet" media="screen and (min-width: 1920px)" href="themes/css/style1920.css?v=1"/>
            <link rel="stylesheet" href="themes/css/lightbox.min.css"/>
        <?php endif; ?>

        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,500,700,700italic,900' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="themes/img/icone.ico"/>
        <link rel="stylesheet" href="themes/css/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="themes/css/w3.css"/>
    </head>
    <body>
        <header class="cabecalho container">
            <div class="content">
                <div class="area_logo">
                    <a href="index.php?exe=index&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>" >
                        <img src="themes/img/logo.png" />
                        <h1>Usina Santa Fé S.A.</h1>
                    </a>
                </div>
                <div class="translate">
                    <a href="index.php?exe=<?= $url; ?>&idioma=pt">
                        <img src="themes/img/flag_of_brazil.png" title="Português"/>
                    </a>
                    <a href="index.php?exe=<?= $url; ?>&idioma=en">
                        <img src="themes/img/flag_of_the_united_states.png" title="Inglês" />
                    </a>
                </div>
                <div class="efeito_menu">
                    <ul class="menu">
                        <li class="menu_item"><a href="index.php?exe=index&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>" title="Home">Home</a></li>
                        <li class="menu_item"><a href="#" title="Quem somos"><?= ($idioma == 1) ? 'Quem somos' : 'Who we are'; ?></a>
                            <ul class="sub_item_menu sub_item_menu_somos">
                                <li ><a href="index.php?exe=historia&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'História' : 'History'; ?></a></li>
                                <li ><a href="index.php?exe=principios&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Princípios Empresariais' : 'Business Principles'; ?></a></li>
                                <li ><a href="index.php?exe=produto&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Produtos' : 'Products'; ?></a></li>
                                <li ><a href="index.php?exe=contato&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Trabalhe Conosco' : 'Work with Us'; ?></a></li>
                                <li ><a href="index.php?exe=localizacao&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Localização' : 'Location'; ?></a></li>
                            </ul>
                        </li>
                        <li class="menu_item"><a href="#" title="Governança"><?= ($idioma == 1) ? 'Governança' : 'Governance'; ?></a>
                            <ul class="sub_item_menu sub_item_menu_sustenta">
                                <li ><a href="index.php?exe=acesso_portal_governanca&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>">Portal de Governança</a></li>
                                <li ><a href="index.php?exe=g_estrutura_societaria&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>">Estrutura Societária</a></li>
                                <li ><a href="#">Diretrizes</a>
                                    <ul class="sub_sub_item_menu">
                                        <li ><a href="index.php?exe=g_estrutura_corporativa_acionaria&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>">Estrutura Corporativa e Acionária</a></li>
                                        <li ><a href="index.php?exe=g_visao_missao_principios&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>">Visão, Missão e Princípios</a></li>
                                        <li ><a href="index.php?exe=g_conselho_de_administracao&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>">Conselho de Administração</a></li>
                                        <li ><a href="index.php?exe=g_diretoria_executiva&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>">Diretoria Executiva</a></li>
                                        <li ><a href="index.php?exe=g_documento_de_governanca_corporativa&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>">Documentos de Governança Corporativa</a></li>
                                        <li ><a href="index.php?exe=g_estrutura_de_governanca_corporativa&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>">Estrutura de Governança Corporativa</a></li>
                                    </ul>
                                </li>
                                <li ><a href="#"><?= ($idioma == 1) ? 'Sustentabilidade' : 'Sustainability'; ?></a>
                                    <ul class="sub_sub_item_menu">
                                        <li ><a href="index.php?exe=rh&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Recursos Humanos' : 'Human Resources'; ?></a></li>
                                        <li ><a href="index.php?exe=resp_social&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Responsabilidade Social' : 'Social Responsibility'; ?></a></li>
                                        <li ><a href="index.php?exe=resp_ambiental&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Responsabilidade Ambiental' : 'Environmental Responsibility'; ?></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu_item"><a href="index.php?exe=noticias&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>" title="Notícias"><?= ($idioma == 1) ? 'Notícias' : 'News'; ?></a>
                            <ul class="sub_item_menu sub_item_menu_noticia">
                                <li ><a href="index.php?exe=noticias&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Aconteceu' : 'New'; ?></a></li>
                                <li ><a href="index.php?exe=informativo&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>">Informativo Itaquerê</a></li>
                            </ul>
                        </li>
                        <li class="menu_item"><a href="#" title="Área Pública"><?= ($idioma == 1) ? 'Área Pública' : 'Public Area'; ?></a>
                            <ul class="sub_item_menu sub_item_menu_restrita">
                                <li ><a href="index.php?exe=doc_juridico&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>">Informações Financeiras</a></li>
                                <li ><a href="index.php?exe=aplicativo&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Aplicativos' : 'Applications'; ?></a></li>
                            </ul>
                        </li>
                        <li class="menu_item"><a href="#" title="Área restrita"><?= ($idioma == 1) ? 'Área Restrita' : 'Restricted Area'; ?></a>
                            <ul class="sub_item_menu sub_item_menu_restrita">
				<li ><a href="http://www.usinasantafe.com.br/prestadordeservicos"  target="_blank"><?= ($idioma == 1) ? 'Prestador de serviços' : 'Prestador de serviços'; ?></a></li>
                                <li ><a href="index.php?exe=acesso_relacao&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Relação com Instituições Financeiras' : 'Relations with Financial Institutions'; ?></a></li>
                                <li ><a href="index.php?exe=acesso_politicas_rh&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Políticas do RH' : 'HR Policies'; ?></a></li>
                                <li ><a href="index.php?exe=acesso_dashboard&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Configuração' : 'Configuration'; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </header>
        <div class="rede_social">
            <ul>
                <li><a href="https://www.facebook.com/usinasantafe/" target="_blank" ><div class="social rede_facebook"></div></a></li>
                <li><a href="https://www.linkedin.com/company/1009452/" target="_blank" ><div class="social rede_linkedin"></div></a></li>
                <li><a href="https://webmail.usinasantafe.com.br/owa/" target="_blank" ><div class="social rede_email"></div></a></li>
            </ul>
        </div>
        <?php
        $codigoRet = 1;
        $read = new Read;
        $read->ExeReadMod('SELECT MAX(CODIGO) AS CODIGO FROM SITE_LOG');
        if ($read->getResult()):
            foreach ($read->getResult() as $categoria):
                extract($categoria);
                $codigoRet = $CODIGO + 1;
            endforeach;
        endif;
        $inserirLog = new Create;
        $dados = array("CODIGO" => $codigoRet,
            "DATA" => date('d/m/Y H:i:s'),
            "DESCACESSO" => $pagina,
            "IP" => $_SERVER['REMOTE_ADDR']
        );
        $inserirLog->ExeCreate('SITE_LOG', $dados);

        if (file_exists('themes/' . $pagina)) {
            require('/themes/' . $pagina);
        } else {
            require('/themes/erro_404.php');
        }

        if (($pagina === 'relacao.php') 
                || ($pagina === 'acesso_dashboard.php') 
                || ($pagina === 'acesso_relacao.php')
                || ($pagina === 'acesso_politicas_rh.php')
                || ($pagina === 'politicas_rh.php')
                ) {
            ?>
            <footer class="espacamento_relacao">
                <?php
            } else {
                ?>
                <footer class="rodape">
                    <?php
                }
                ?>

                <ul class="rede_social_rodape">
                    <li><a class="rodape_facebook" href="https://www.facebook.com/usinasantafe/" target="_blank">Facebook</a></li>
                    <li>|</li>
                    <li><a class="rodape_linkedin" href="https://www.linkedin.com/company/1009452/" target="_blank">Linkedin</a></li>
                </ul>
                <div class="rodape_direito">
                    <p>&copy; 2017 , Usina Santa Fé S.A. - <?= ($idioma == 1) ? 'Todos os direitos reservados' : 'All Rights Reserved'; ?><p>
                </div>

            </footer>

            <script src="_cdn/jquery.js"></script>
            <script src="_cdn/script.js?v=1"></script>
            <script src="_cdn/lightbox-plus-jquery.min.js"></script>
			<script type="text/javascript" src="//e.issuu.com/embed.js" async="true"></script>

            <?php
            if ($verDisp) {
                ?>
                <script src="_cdn/swiper.min.js"></script>
                <script>
                    var swiper = new Swiper('.swiper-container', {
                        pagination: '.swiper-pagination',
                        nextButton: '.swiper-button-next',
                        prevButton: '.swiper-button-prev',
                        slidesPerView: 1,
                        paginationClickable: true,
                        spaceBetween: 0,
                        loop: true
                    });
                </script>
            <?php } 
            ?>

    </body>

</html>
<?php
ob_end_flush();

