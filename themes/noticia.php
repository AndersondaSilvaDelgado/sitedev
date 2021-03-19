<?php
$idNoticia = filter_input(INPUT_GET, 'idnoticia', FILTER_VALIDATE_INT);

$read = new Read;
$read->ExeReadMod("SELECT CODIGO, TITULO, CONTEUDO, TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI') AS DATA FROM SITE_NOTICIAS WHERE CODIGO = " . $idNoticia);

$conteudoRet = '';
$dataRet = '';
$tituloRet = '';

if ($read->getResult()):

    foreach ($read->getResult() as $noticias):
        extract($noticias);
        $conteudoRet = stream_get_contents($CONTEUDO);
        $tituloRet = $TITULO;
        $dataRet = $DATA;
    endforeach;

else:
    ?>
    <script language="JavaScript">
        window.location = "index.php?exe=erro_404";
    </script>
<?php
endif;
?>
<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <section class="container">
        <div class="content noticia">
            <h1 class="titulo_padrao"><?= $tituloRet; ?></h1>
            <p class=""><span><?= $dataRet; ?></span></p>
            <div class="descr_noticia"><?= $conteudoRet; ?></div>
            <div class="clear"></div>
        </div>
        <ul class="galeria content">
            <?php
            $Gallery = new Read;
            $Gallery->ExeRead("SITE_NOTICIA_GALERIA", "WHERE COD_NOTICIA = :idnoticia", "idnoticia={$idNoticia}");
            if ($Gallery->getResult()):
                echo '<h2>Galeria de Fotos</h2>';
                foreach ($Gallery->getResult() as $gb):
                    extract($gb);
                    ?>
                    <li>
                        <div class="thumb_small">
                            <?php if (!$verDisp) { ?>
                                <a class="example-image-link" href="/uploads/<?= $LINK; ?>" data-lightbox="example-set">
                                    <img class="example-image" src="/uploads/<?= $LINK; ?>"/>
                                </a>
                            <?php } else { ?>
                                <img class="example-image" src="/uploads/<?= $LINK; ?>"/>
                            <?php } ?>
                        </div>
                    </li>
                    <?php
                endforeach;
            endif;
            ?>
        </ul>
    </section>
    <div class="clear"></div>

</main>
