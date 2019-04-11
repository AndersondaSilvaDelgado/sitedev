<main>
    <?php
    $read = new Read;
    $read->ExeReadMod("SELECT COUNT(CODIGO) AS QTDE FROM SITE_NOTICIAS ORDER BY DATA DESC");
    $qtdeReg = 0;
    if ($read->getResult()):
        foreach ($read->getResult() as $noticia):
            extract($noticia);
            $qtdeReg = $QTDE;
        endforeach;
    endif;
    ?>  

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <section class="container">
        <div class="content">
            <h1 class="titulo_padrao">Notícias</h1>

            <?php
            $read = new Read;
            $read->ExeReadMod("SELECT CODIGO, TITULO, CONTEUDO, STATUS, CAPA, TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI') AS DATA FROM SITE_NOTICIAS ORDER BY CODIGO DESC");

            if ($read->getResult()):

                foreach ($read->getResult() as $noticia):
                    extract($noticia);
                    ?>
                    <a href="index.php?exe=noticia&idnoticia=<?= $CODIGO; ?>">
                        <article class="item_noticia">
                            <img src="../uploads/<?= $CAPA; ?>"/>
                            <h1><?= $TITULO; ?></h1>
                            <p class="tagline"><?= $DATA; ?></p>
                        </article>
                    </a>
                    <?php
                endforeach;

            endif;
            ?>

            <div class="clear"></div>
        </div>
    </section>

    <div class="clear"></div>
</main>
