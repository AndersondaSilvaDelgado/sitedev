<?php
if (!session_id()):
    session_start();
endif;

if (empty($_SESSION['userlogin'])):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=acesso_politicas_rh');
endif;
?>
<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <div class="container">
        <div class="content">
            <h1 class="titulo_relatorio_princ">Políticas e Procedimentos de RH</h1>
        </div>
    </div>

    <section class="container relacao_pagina">
        <div class="content">
            <h1 class="fontzero">Políticas de RH</h1>
            <?php
            $contVazia = 0;

            $readDoc = new Read;
            $readDoc->ExeReadMod(' SELECT '
                    . ' CODIGO '
                    . ' , DESCRICAO '
                    . ' , DOCUMENTO '
                    . ' , DATA '
                    . ' , POSICAO '
                    . ' FROM '
                    . ' SITE_POLITICAS_RH_NV '
                    . ' ORDER BY '
                    . ' POSICAO '
                    . ' DESC ');
            $listDoc = null;
            if ($readDoc->getResult()) {
                $listDoc = $readDoc->getResult();
                foreach ($listDoc as $doc) {
                    ?>
                    <p class="tagline politicas">
                        <a href="uploads/<?= $doc['DOCUMENTO']; ?>?v=1" target="_blank">
                            <?= $doc['DESCRICAO']; ?>
                        </a>
                    </p>
                    <?php
                }
            }
            ?>

            <div class="clear"></div>
        </div>

    </section>
    <div class="clear"></div>
    <div class="espaco_relacao"></div>
</main>