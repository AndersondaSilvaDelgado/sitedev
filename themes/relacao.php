<?php
if (!session_id()):
    session_start();
endif;

$codigoRet = 1;

if (empty($_SESSION['userlogin'])):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=acesso_relacao');
else:
    $read = new Read;
    $read->ExeReadMod('SELECT '
                        . ' MAX(CODIGO) AS CODIGO '
                    . ' FROM '
                        . ' SITE_LOG_RELATORIO ');

    if ($read->getResult()):

        foreach ($read->getResult() as $categoria):
            extract($categoria);

            $codigoRet = $CODIGO + 1;

        endforeach;

    endif;

    $inserirLog = new Create;
    $dados = array("CODIGO" => $codigoRet,
        "CODUSUARIO" => $_SESSION['userlogin']['CODIGO'],
        "DESCACESSO" => "index",
        "DATA" => date('d/m/Y H:i:s')
    );
    $inserirLog->ExeCreate('SITE_LOG_RELATORIO', $dados);

endif;
?>
<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <div class="container">
        <div class="content">
            <h1 class="titulo_relatorio_princ">Relação com Instituições Financeiras</h1>
            <p class="tagline usuario_relacao fontzero"><?= $_SESSION['userlogin']['CODIGO']; ?></p>
        </div>
    </div>

    <section class="container relacao_pagina">
        <div class="content">
            <h1 class="fontzero">Relação com Instituições Financeiras</h1>
            <?php
            $contVazia = 0;

            $readDoc = new Read;
            $readDoc->ExeReadMod(" SELECT "  
                    . " CODIGO "
                    . " , cast(DESCRICAO AS varchar2(100)) as DESCRICAO "
                    . " , DOCUMENTO "
                    . " , SECAO "
                    . " , DATA "
                    . " , POSICAO "
                    . " FROM "
                    . " SITE_DOC_DEMO_FINANC "
                    . " ORDER BY "
                    . " POSICAO "
                    . " DESC ");
					
            $listDoc = null;
            if ($readDoc->getResult()) {
                $listDoc = $readDoc->getResult();
                foreach ($listDoc as $doc) {
                    if ($doc['SECAO'] == 1) {
                        $contVazia++;
                    }
                }
            }

            if ($_SESSION['userlogin']['NIVEL'] == 1) {
                /////////////////////////////////////////////////////////////////////////////////////////////////
                
                $readSes = new Read;
                $readSes->ExeReadMod("SELECT "
                        . " CODIGO "
                        . " , DESCRICAO "
                        . " , DESTAQUE "
                        . " FROM "
                        . " SITE_CATEG_DEMO_FINANC "
                        . " WHERE "
                        . " NIVEL = 1 "
                        . " AND "
                        . " CODIGO > 1 "
						. " ORDER BY POSICAO DESC");

                foreach ($readSes->getResult() as $secao1) {

                    $readVerSes = new Read;
                    $readVerSes->ExeReadMod("SELECT "
                            . " V.CODIGO "
                            . " , V.SECAO "
                            . " , V.POSICAO "
                            . " , V.CODUSUARIO "
                            . " FROM "
                            . " V_SITE_CATEGORIA_USUARIO V "
                            . " WHERE "
                            . " V.CODIGO = " . $secao1['CODIGO'] . " "
                            . " AND "
                            . " POSICAO = ( "
                            . " SELECT "
                            . " MIN(V1.POSICAO) "
                            . " FROM "
                            . " V_SITE_CATEGORIA_USUARIO V1 "
                            . " WHERE "
                            . " V.CODUSUARIO = " . $_SESSION['userlogin']['CODIGO'] . " "
                            . " AND "
                            . " V1.CODIGO = V.CODIGO ) "
							. " ORDER BY V.POSICAO DESC");

                    if ($readVerSes->getResult()) {
                        ?>
                        <article class="<?= ($secao1['DESTAQUE'] == 1 ? 'secao_destaque' : '') ?> secao">
                            <h1 class="titulo1"><?= $secao1['DESCRICAO']; ?></h1>
                            <?php
                            if ($listDoc) {
                                foreach ($listDoc as $doc) {
                                    if ($doc['SECAO'] == $secao1['CODIGO']) {
                                        ?>
                                        <div class="relacao_secao1">
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
                            foreach ($readVerSes->getResult() as $verSes) {

                                if ($verSes['POSICAO'] == 1) {

                                    $sql1 = "SELECT "
                                            . " CODIGO "
                                            . " , DESCRICAO "
                                            . " , DESTAQUE "
                                            . " , 1 AS POSICAO "
                                            . " FROM "
                                            . " SITE_CATEG_DEMO_FINANC "
                                            . " WHERE "
                                            . " NIVEL = 2 "
                                            . " AND "
                                            . " CODPARENTE = " . $secao1['CODIGO'] . " "
											. " ORDER BY POSICAO DESC";
                                } else {

                                    $sql1 = "SELECT "
                                            . " CODIGO "
                                            . " , DESCRICAO "
                                            . " , DESTAQUE "
                                            . " FROM "
                                            . " SITE_CATEG_DEMO_FINANC "
                                            . " WHERE "
                                            . " CODPARENTE = " . $secao1['CODIGO'] . " "
                                            . " AND "
                                            . " CODIGO IN "
                                            . "(SELECT "
                                            . " V.CODIGO "
                                            . " FROM "
                                            . " V_SITE_CATEGORIA_USUARIO V "
                                            . " WHERE "
                                            . " V.CODUSUARIO = " . $_SESSION['userlogin']['CODIGO'] . " "
                                            . " AND "
                                            . " SECAO = 2 ) " 
											. " ORDER BY CAT.POSICAO DESC ";
                                }
                            }

                            $readSub2Ses = new Read;
                            $readSub2Ses->ExeReadMod($sql1);

                            if ($readSub2Ses->getResult()) {

                                foreach ($readSub2Ses->getResult() as $secao2) {

                                    if ($verSes['POSICAO'] > 1) {

                                        $sql1 = "SELECT "
                                                . " V.CODIGO "
                                                . " , V.SECAO "
                                                . " , V.POSICAO "
                                                . " , V.CODUSUARIO "
                                                . " FROM "
                                                . " V_SITE_CATEGORIA_USUARIO V "
                                                . " WHERE "
                                                . " V.CODIGO = {$secao2['CODIGO']} "
                                                . " AND "
                                                . " POSICAO = ( "
                                                . " SELECT "
                                                . " MIN(V1.POSICAO) "
                                                . " FROM "
                                                . " V_SITE_CATEGORIA_USUARIO V1 "
                                                . " WHERE "
                                                . " V.CODUSUARIO = " . $_SESSION['userlogin']['CODIGO'] . " "
                                                . " AND "
                                                . " V1.CODIGO = V.CODIGO) "
												. " ORDER BY V.POSICAO DESC ";
                                    }


                                    $readVerSubSes = new Read;
                                    $readVerSubSes->ExeReadMod($sql1);

                                    if ($readVerSubSes->getResult()) {
                                        ?>
                                        <article id="<?= $secao2['CODIGO']; ?>" class="relacao_subsecao1">
                                            <h2 id="titulo_<?= $secao2['CODIGO']; ?>" class="titulo2"><?= $secao2['DESCRICAO']; ?></h2>
                                            <?php
                                            if ($listDoc) {
                                                foreach ($listDoc as $doc) {
                                                    if ($doc['SECAO'] == $secao2['CODIGO']) {
                                                        ?>
                                                        <div class="relacao_secao2">
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

                                            foreach ($readVerSubSes->getResult() as $verSubSes) {

                                                if ($verSubSes['POSICAO'] == 1) {

                                                    $sql2 = "SELECT "
                                                            . " CODIGO "
                                                            . " , DESCRICAO "
                                                            . " , DESTAQUE "
                                                            . " FROM "
                                                            . " SITE_CATEG_DEMO_FINANC "
                                                            . " WHERE "
                                                            . " NIVEL = 3 "
                                                            . " AND "
                                                            . " CODPARENTE = " . $secao2['CODIGO'] . " "
															. " ORDER BY POSICAO DESC";
                                                } else {

                                                    $sql2 = "SELECT "
                                                            . " CODIGO "
                                                            . " , DESCRICAO "
                                                            . " , DESTAQUE "
                                                            . " FROM "
                                                            . " SITE_CATEG_DEMO_FINANC "
                                                            . " WHERE "
                                                            . " CODPARENTE = " . $secao2['CODIGO'] . " "
                                                            . " AND "
                                                            . " CODIGO IN "
                                                            . "(SELECT "
                                                            . " V.CODIGO "
                                                            . " FROM "
                                                            . " V_SITE_CATEGORIA_USUARIO V "
                                                            . " WHERE "
                                                            . " V.CODUSUARIO = " . $_SESSION['userlogin']['CODIGO'] . " "
                                                            . " AND SECAO = 3 ) "
															. " ORDER BY CAT.POSICAO DESC ";
                                                }
                                            }

                                            $readSub3Ses = new Read;
                                            $readSub3Ses->ExeReadMod($sql2);

                                            if ($readSub3Ses->getResult()) {

                                                foreach ($readSub3Ses->getResult() as $secao3) {
                                                    ?>
                                                    <article id="<?= $secao3['CODIGO']; ?>" class="relacao_subsecao2">
                                                        <h3  id="titulo_<?= $secao3['CODIGO']; ?>" class="titulo3"><?= $secao3['DESCRICAO']; ?></h3>
                                                        <?php
                                                        if ($listDoc) {
                                                            foreach ($listDoc as $doc) {
                                                                if ($doc['SECAO'] == $secao3['CODIGO']) {
                                                                    ?>
                                                                    <div class="relacao_secao3">
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
                            }
                            ?>
                        </article>
                        <?php
                    }
                }
                
                /////////////////////////////////////////////////////////////////////////////
            } else {

                $readSes = new Read;
                $readSes->ExeReadMod("SELECT "
                        . " CODIGO "
                        . " , DESCRICAO "
                        . " , DESTAQUE "
                        . " FROM "
                        . " SITE_CATEG_DEMO_FINANC CAT "
                        . " WHERE "
                        . " NIVEL = 1 "
                        . " AND "
                        . " CODIGO > 1 "
						. " ORDER BY POSICAO DESC ");

                if ($readSes->getResult()) {

                    foreach ($readSes->getResult() as $secao1) {
                        ?>
                        <article class="<?= ($secao1['DESTAQUE'] == 1 ? 'secao_destaque' : '') ?> secao">
                            <h1 class="titulo1"><?= $secao1['DESCRICAO']; ?></h1>
                            <?php
                            if ($listDoc) {
                                foreach ($listDoc as $doc) {
                                    if ($doc['SECAO'] == $secao1['CODIGO']) {
                                        ?>
                                        <div class="relacao_secao1">
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
                                    . " , DESTAQUE "
                                    . " , 1 AS POSICAO "
                                    . " FROM "
                                    . " SITE_CATEG_DEMO_FINANC "
                                    . " WHERE "
                                    . " NIVEL = 2 "
                                    . " AND "
                                    . " CODPARENTE = " . $secao1['CODIGO'] . " " 
									. " ORDER BY POSICAO DESC ";


                            $readSub2Ses = new Read;
                            $readSub2Ses->ExeReadMod($sql1);

                            if ($readSub2Ses->getResult()) {

                                foreach ($readSub2Ses->getResult() as $secao2) {
                                    ?>
                                    <article id="<?= $secao2['CODIGO']; ?>" class="relacao_subsecao1">
                                        <h2 id="titulo_<?= $secao2['CODIGO']; ?>" class="titulo2"><?= $secao2['DESCRICAO']; ?></h2>
                                        <?php
                                        if ($listDoc) {
                                            foreach ($listDoc as $doc) {
                                                if ($doc['SECAO'] == $secao2['CODIGO']) {
                                                    ?>
                                                    <div class="relacao_secao2">
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
                                                . " , DESTAQUE "
                                                . " FROM "
                                                . " SITE_CATEG_DEMO_FINANC "
                                                . " WHERE "
                                                . " NIVEL = 3 "
                                                . " AND "
                                                . " CODPARENTE = " . $secao2['CODIGO'] . " "
												. " ORDER BY POSICAO DESC ";

                                        $readSub3Ses = new Read;
                                        $readSub3Ses->ExeReadMod($sql2);

                                        if ($readSub3Ses->getResult()) {

                                            foreach ($readSub3Ses->getResult() as $secao3) {
                                                ?>
                                                <article id="<?= $secao3['CODIGO']; ?>" class="relacao_subsecao2">
                                                    <h3  id="titulo_<?= $secao3['CODIGO']; ?>" class="titulo3"><?= $secao3['DESCRICAO']; ?></h3>
                                                    <?php
                                                    if ($listDoc) {
                                                        foreach ($listDoc as $doc) {
                                                            if ($doc['SECAO'] == $secao3['CODIGO']) {
                                                                ?>
                                                                <div class="relacao_secao3">
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