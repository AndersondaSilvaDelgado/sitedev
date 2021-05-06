<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <div class="container">
        <div class="content">
            <h1 class="titulo_relacao">Portal de Governança</h1>
        </div>
    </div>

    <section class="container relacao_pagina">
        <div class="content">
            <h1 class="fontzero">Portal de Governança</h1>
            <?php
            $contVazia = 0;

            $readDoc = new Read;
            $readDoc->ExeReadMod(' SELECT '
                                    . ' CODIGO '
                                    . ' , DESCRICAO '
                                    . ' , DOCUMENTO '
                                    . ' , SECAO '
                                    . ' , DATA '
                                    . ' , POSICAO '
                                . ' FROM '
                                    . ' SITE_RELATORIO_NV '
                                . ' ORDER BY '
                                    . ' POSICAO '
                                . ' DESC ');
            $listDoc = null;
            if ($readDoc->getResult()) {
                $listDoc = $readDoc->getResult();
                foreach ($listDoc as $doc) {
                    if ($doc['SECAO'] == 1) {
                        $contVazia++;
                    }
                }
            }

            $readSes = new Read;
            $readSes->ExeReadMod("SELECT "
                                    . " CAT.CODIGO "
                                    . " , CAT.DESCRICAO "
                                . " FROM "
                                    . " SITE_CATEG_RELATORIO_NV CAT "
                                . " WHERE "
                                    . " CAT.NIVEL = 1 "
                                . " AND "
                                    . " CAT.TIPO = 2 "
                                . " ORDER BY CAT.POSICAO DESC");

            if ($readSes->getResult()) {

                foreach ($readSes->getResult() as $secao1) {
                    ?>
                    <article class="secao">
                        <h1 class="titulo1"><?= $secao1['DESCRICAO']; ?></h1>
                        <?php
                        if ($listDoc) {
                            foreach ($listDoc as $doc) {
                                if ($doc['SECAO'] == $secao1['CODIGO']) {
                                    ?>
                                    <div class="relatorio_secao1">
                                        <p class="tagline documento">
                                            <a href="uploads/<?= $doc['DOCUMENTO']; ?>" target="_blank">
                                                <?= $doc['DESCRICAO']; ?>
                                            </a>
                                        </p>
                                    </div>
                                    <?php
                                }
                            }
                        }

                        $sql1 = "SELECT "
                                    . " CAT.CODIGO "
                                    . " , CAT.DESCRICAO "
                                . " FROM "
                                    . " SITE_CATEG_RELATORIO_NV CAT "
                                . " WHERE "
                                    . " CAT.NIVEL = 2 "
                                . " AND "
                                    . " CAT.TIPO = 2 "
                                . " AND "
                                    . " CAT.CODPARENTE = " . $secao1['CODIGO'] . " "
                                . " ORDER BY CAT.POSICAO DESC";

                        $readSub2Ses = new Read;
                        $readSub2Ses->ExeReadMod($sql1);

                        if ($readSub2Ses->getResult()) {

                            foreach ($readSub2Ses->getResult() as $secao2) {
                                ?>
                                <article id="<?= $secao2['CODIGO']; ?>" class="subsecao1">
                                    <h2 id="titulo_<?= $secao2['CODIGO']; ?>" class="titulo2"><?= $secao2['DESCRICAO']; ?></h2>
                                    <?php
                                    if ($listDoc) {
                                        foreach ($listDoc as $doc) {
                                            if ($doc['SECAO'] == $secao2['CODIGO']) {
                                                ?>
                                                <div class="relatorio_secao2">
                                                    <p class="tagline documento">
                                                        <a href="uploads/<?= $doc['DOCUMENTO']; ?>" target="_blank">
                                                            <?= $doc['DESCRICAO']; ?>
                                                        </a>
                                                    </p>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }

                                    $sql2 = "SELECT "
                                                . " CAT.CODIGO "
                                                . " , CAT.DESCRICAO "
                                            . " FROM "
                                                . " SITE_CATEG_RELATORIO_NV CAT "
                                            . " WHERE "
                                                . " CAT.NIVEL = 3 "
                                                . " AND "
                                                . " CAT.TIPO = 2 "
                                                . " AND "
                                                . " CAT.CODPARENTE = " . $secao2['CODIGO'] . " "
                                            . " ORDER BY CAT.POSICAO DESC";

                                    $readSub3Ses = new Read;
                                    $readSub3Ses->ExeReadMod($sql2);

                                    if ($readSub3Ses->getResult()) {

                                        foreach ($readSub3Ses->getResult() as $secao3) {
                                            ?>
                                            <article id="<?= $secao3['CODIGO']; ?>" class="subsecao2">
                                                <h3  id="titulo_<?= $secao3['CODIGO']; ?>" class="titulo3"><?= $secao3['DESCRICAO']; ?></h3>
                                                <?php
                                                if ($listDoc) {
                                                    foreach ($listDoc as $doc) {
                                                        if ($doc['SECAO'] == $secao3['CODIGO']) {
                                                            ?>
                                                            <div class="relatorio_secao3">
                                                                <p class="tagline documento">
                                                                    <a href="uploads/<?= $doc['DOCUMENTO']; ?>" target="_blank">
                                                                        <?= $doc['DESCRICAO']; ?>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </article>
                                            <?php
                                        }
                                    }
                                    ?>
                                </article>
                                <?php
                            }
                        }
                        ?>
                    </article>
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