<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <div class="container">
        <div class="content">
            <h1 class="titulo_relatorio_princ">Informações Financeiras</h1>
        </div>
    </div>

    <section class="container doc_juridico">
        <div class="content">
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
                    . ' SITE_DOC_JURIDICO '
                    . ' ORDER BY '
                    . ' POSICAO '
                    . ' ASC ');
            $listDoc = null;
            if ($readDoc->getResult()) {
                $listDoc = $readDoc->getResult();
                foreach ($listDoc as $doc) {
                        $contVazia++;
                }
            }

            if($contVazia > 0){
                $readSes = new Read;
                $readSes->ExeReadMod("SELECT "
                        . " CODIGO "
                        . " , DESCRICAO "
                        . " FROM "
                        . " SITE_CATEG_JURIDICO "
                        . " WHERE "
                        . " NIVEL = 1 "
                        . " ORDER BY POSICAO DESC");

                if ($readSes->getResult()) {

                    foreach ($readSes->getResult() as $secao1) {
                        ?>
                        <article class="secao_doc_jur">
                            <h1 class="titulo1"><?= $secao1['DESCRICAO']; ?></h1>
                            <?php
                            if ($listDoc) {
                                foreach ($listDoc as $doc) {
                                    if ($doc['SECAO'] == $secao1['CODIGO']) {
                                        ?>
                                        <div class="doc_juridico_secao1">
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
                                    . " CODIGO "
                                    . " , DESCRICAO "
                                    . " FROM "
                                    . " SITE_CATEG_JURIDICO "
                                    . " WHERE "
                                    . " NIVEL = 2 "
                                    . " AND "
                                    . " CODPARENTE = " . $secao1['CODIGO']
                                    . " ORDER BY POSICAO DESC ";


                            $readSub2Ses = new Read;
                            $readSub2Ses->ExeReadMod($sql1);

                            if ($readSub2Ses->getResult()) {

                                foreach ($readSub2Ses->getResult() as $secao2) {
                                    ?>
                                    <article class="doc_juridico_subsecao1">
                                        <h2 class="titulo2"><?= $secao2['DESCRICAO']; ?></h2>
                                        <?php
                                        if ($listDoc) {
                                            foreach ($listDoc as $doc) {
                                                if ($doc['SECAO'] == $secao2['CODIGO']) {
                                                    ?>
                                                    <div class="doc_juridico_secao2">
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
                                                . " CODIGO "
                                                . " , DESCRICAO "
                                                . " FROM "
                                                . " SITE_CATEG_JURIDICO "
                                                . " WHERE "
                                                . " NIVEL = 3 "
                                                . " AND "
                                                . " CODPARENTE = " . $secao2['CODIGO']
                                                . " ORDER BY POSICAO DESC ";

                                        $readSub3Ses = new Read;
                                        $readSub3Ses->ExeReadMod($sql2);

                                        if ($readSub3Ses->getResult()) {

                                            foreach ($readSub3Ses->getResult() as $secao3) {
                                                ?>
                                                <article class="doc_juridico_subsecao2">
                                                    <h3 class="titulo3"><?= $secao3['DESCRICAO']; ?></h3>
                                                    <?php
                                                    if ($listDoc) {
                                                        foreach ($listDoc as $doc) {
                                                            if ($doc['SECAO'] == $secao3['CODIGO']) {
                                                                ?>
                                                                <div class="doc_juridico_secao3">
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
            }
            ?>

            <div class="clear"></div>
        </div>

    </section>
    <div class="clear"></div>
    <div class="espaco_relacao"></div>
</main>
