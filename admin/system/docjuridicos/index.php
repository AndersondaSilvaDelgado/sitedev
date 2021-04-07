<?php
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$retornpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$idCategoria = filter_input(INPUT_GET, 'idcategoria', FILTER_VALIDATE_INT);
$idDocumento = filter_input(INPUT_GET, 'iddocumento', FILTER_VALIDATE_INT);

require_once '_models/AdminCatJuridico.class.php';
$adminCatJuridico = new AdminCatJuridico();

require_once '_models/AdminDocJuridico.class.php';
$adminDocJuridico = new AdminDocJuridico();

if ($status):

    switch ($status):

        case 'createdoc':
            $retornpost['DOCUMENTO'] = ( $_FILES['DOCUMENTO']['tmp_name'] ? $_FILES['DOCUMENTO'] : 'null' );
            unset($retornpost['SendPostForm']);
            $adminDocJuridico->ExeCreate($retornpost);
            break;

        case 'createsecao':
            unset($retornpost['SendPostForm']);
            $adminCatJuridico->ExeCreate($retornpost);
            break;

        case 'updatedoc':
            if (isset($retornpost) && $retornpost['SendPostForm']):
                $retornpost['DOCUMENTO'] = ( $_FILES['DOCUMENTO']['tmp_name'] ? $_FILES['DOCUMENTO'] : 'null' );
                unset($retornpost['SendPostForm']);
                $retornpost['DATA'] = date('d/m/Y H:i:s');
                $adminDocJuridico->ExeUpdate($idDocumento, $retornpost);
            endif;
            break;

        case 'updatesecao':
            if (isset($retornpost) && $retornpost['SendPostForm']):
                unset($retornpost['SendPostForm']);
                $retornpost['DATA'] = date('d/m/Y H:i:s');
                $adminCatJuridico->ExeUpdate($idCategoria, $retornpost);
            endif;
            break;

        case 'deldoc':
            $adminDocJuridico->ExeDelete($idDocumento);
            break;

        case 'delsecao':
            $adminCatJuridico->ExeDelete($idCategoria);
            break;

        case 'downdoc':
            $adminDocJuridico->DownDoc($idDocumento);
            break;

        case 'updoc':
            $adminDocJuridico->UpDoc($idDocumento);
            break;

        case 'downsecao':
            $adminCatJuridico->DownSecao($idCategoria);
            break;

        case 'upsecao':
            $adminCatJuridico->UpSecao($idCategoria);
            break;

    endswitch;

endif;
?>
<div>

    <h1 class="title_crud">INFORMAÇÕES FINANCEIRAS</h1>

    <div class="content">

        <?php
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
                . ' DESC ');
        $listDoc = null;
        if ($readDoc->getResult()) {
            $listDoc = $readDoc->getResult();
        }

        $readSes = new Read;
        $readSes->ExeReadMod("SELECT "
                . " CAT.CODIGO "
                . " , CAT.DESCRICAO "
                . " FROM "
                . " SITE_CATEGORIA_DOC_JURIDICO CAT "
                . " WHERE "
                . " CAT.NIVEL = 1 "
                . " ORDER BY CAT.POSICAO DESC");
        ?>
        <article class="secao">
            <h1 class="titulo1">
                <a href="painel.php?exe=docjuridicos/editsecao&status=createsecao&idcodparente=0" >
                    <i class="fa fa-file icon_green">&nbsp;&nbsp;</i>Nova seção
                </a>
            </h1>
            <?php
            if ($readSes->getResult()) {
                foreach ($readSes->getResult() as $secao1) {
                    ?>
                    <h1 class="titulo1"><?= $secao1['DESCRICAO']; ?>
                        <a href="painel.php?exe=docjuridicos/editsecao&status=updatesecao&idcategoria=<?= $secao1['CODIGO']; ?>" >
                            <i class="fa fa-edit icon_blue"></i>
                        </a>
                        <a href="#" onclick="return confirm_delete('painel.php?exe=docjuridicos/index&status=delsecao&idcategoria=<?= $secao1['CODIGO']; ?>');" >
                            <i class="fa fa-trash icon_red"></i>
                        </a>
                        <a href="painel.php?exe=docjuridicos/index&status=downsecao&idcategoria=<?= $secao1['CODIGO']; ?>" >
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <a href="painel.php?exe=docjuridicos/index&status=upsecao&idcategoria=<?= $secao1['CODIGO']; ?>" >
                            <i class="fa fa-caret-up"></i>
                        </a>
                    </h1>
                    <?php
                    if ($listDoc) {
                        foreach ($listDoc as $doc) {
                            if ($doc['SECAO'] == $secao1['CODIGO']) {
                                ?>
                                <div class="relatorio_secao1">
                                    <p class="tagline documento">
                                        <?= $doc['DESCRICAO']; ?>
                                        <a href="painel.php?exe=docjuridicos/editdoc&status=updatedoc&iddocumento=<?= $doc['CODIGO']; ?>" >
                                            <i class="fa fa-edit icon_blue"></i>
                                        </a>
                                        <a href="#" onclick="confirm_delete('painel.php?exe=docjuridicos/index&status=deldoc&iddocumento=<?= $doc['CODIGO']; ?>');" >
                                            <i class="fa fa-trash icon_red"></i>
                                        </a>
                                        <a href="painel.php?exe=docjuridicos/index&status=downdoc&iddocumento=<?= $doc['CODIGO']; ?>" >
                                            <i class="fa fa-caret-down"></i>
                                        </a>
                                        <a href="painel.php?exe=docjuridicos/index&status=updoc&iddocumento=<?= $doc['CODIGO']; ?>" >
                                            <i class="fa fa-caret-up"></i>
                                        </a>
                                    </p>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                    <div class="relatorio_secao1">
                        <p class="tagline documento">
                            <a href="painel.php?exe=docjuridicos/editdoc&status=createdoc&idcodparente=<?= $secao1['CODIGO']; ?>" >
                                <i class="fa fa-file icon_green">&nbsp;</i>Novo Documento
                            </a>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="painel.php?exe=docjuridicos/editsecao&status=createsecao&idcodparente=<?= $secao1['CODIGO']; ?>" >
                                <i class="fa fa-file icon_green">&nbsp;</i> Nova Seção 
                            </a>
                        </p>
                    </div>
                    <?php
                    $sql1 = "SELECT "
                            . " CAT.CODIGO "
                            . " , CAT.DESCRICAO "
                            . " FROM "
                            . " SITE_CATEGORIA_DOC_JURIDICO CAT "
                            . " WHERE "
                            . " CAT.NIVEL = 2 "
                            . " AND "
                            . " CAT.CODPARENTE = " . $secao1['CODIGO'] . " "
                            . " ORDER BY CAT.POSICAO DESC";

                    $readSub2Ses = new Read;
                    $readSub2Ses->ExeReadMod($sql1);

                    if ($readSub2Ses->getResult()) {

                        foreach ($readSub2Ses->getResult() as $secao2) {
                            ?>
                            <article class="subsecao1">
                                <h2 class="titulo2"><?= $secao2['DESCRICAO']; ?>
                                    <a href="painel.php?exe=docjuridicos/editsecao&status=updatesecao&idcategoria=<?= $secao2['CODIGO']; ?>" >
                                        <i class="fa fa-edit icon_blue"></i>
                                    </a>
                                    <a href="#" onclick="return confirm_delete('painel.php?exe=docjuridicos/index&status=delsecao&idcategoria=<?= $secao2['CODIGO']; ?>');" >
                                        <i class="fa fa-trash icon_red"></i>
                                    </a>
                                    <a href="painel.php?exe=docjuridicos/index&status=downsecao&idcategoria=<?= $secao2['CODIGO']; ?>" >
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <a href="painel.php?exe=docjuridicos/index&status=upsecao&idcategoria=<?= $secao2['CODIGO']; ?>" >
                                        <i class="fa fa-caret-up"></i>
                                    </a>
                                </h2>
                                <?php
                                if ($listDoc) {
                                    foreach ($listDoc as $doc) {
                                        if ($doc['SECAO'] == $secao2['CODIGO']) {
                                            ?>
                                            <div class="relatorio_secao2">
                                                <p class="tagline documento">
                                                    <?= $doc['DESCRICAO']; ?>
                                                    <a href="painel.php?exe=docjuridicos/editdoc&status=updatedoc&iddocumento=<?= $doc['CODIGO']; ?>" >
                                                        <i class="fa fa-edit icon_blue"></i>
                                                    </a>
                                                    <a href="#" onclick="confirm_delete('painel.php?exe=docjuridicos/index&status=deldoc&iddocumento=<?= $doc['CODIGO']; ?>');" >
                                                        <i class="fa fa-trash icon_red"></i>
                                                    </a>
                                                    <a href="painel.php?exe=docjuridicos/index&status=downdoc&iddocumento=<?= $doc['CODIGO']; ?>" >
                                                        <i class="fa fa-caret-down"></i>
                                                    </a>
                                                    <a href="painel.php?exe=docjuridicos/index&status=updoc&iddocumento=<?= $doc['CODIGO']; ?>" >
                                                        <i class="fa fa-caret-up"></i>
                                                    </a>
                                                </p>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <div class="relatorio_secao2">
                                    <p class="tagline documento">
                                        <a href="painel.php?exe=docjuridicos/editdoc&status=createdoc&idcodparente=<?= $secao2['CODIGO']; ?>" >
                                            <i class="fa fa-file icon_green">&nbsp;</i>Novo Documento
                                        </a>
                                        &nbsp;&nbsp;|&nbsp;&nbsp;
                                        <a href="painel.php?exe=docjuridicos/editsecao&status=createsecao&idcodparente=<?= $secao2['CODIGO']; ?>" >
                                            <i class="fa fa-file icon_green">&nbsp;</i> Nova Seção 
                                        </a>
                                    </p>
                                </div>
                                <?php
                                $sql2 = "SELECT "
                                        . " CAT.CODIGO "
                                        . " , CAT.DESCRICAO "
                                        . " FROM "
                                        . " SITE_CATEGORIA_DOC_JURIDICO CAT "
                                        . " WHERE "
                                        . " CAT.NIVEL = 3 "
                                        . " AND "
                                        . " CAT.CODPARENTE = " . $secao2['CODIGO'] . " "
                                        . " ORDER BY CAT.POSICAO DESC";

                                $readSub3Ses = new Read;
                                $readSub3Ses->ExeReadMod($sql2);

                                if ($readSub3Ses->getResult()) {

                                    foreach ($readSub3Ses->getResult() as $secao3) {
                                        ?>
                                        <article class="subsecao2">
                                            <h3 class="titulo3"><?= $secao3['DESCRICAO']; ?>
                                                <a href="painel.php?exe=docjuridicos/editsecao&status=updatesecao&idcategoria=<?= $secao3['CODIGO']; ?>" >
                                                    <i class="fa fa-edit icon_blue"></i>
                                                </a>
                                                <a href="#" onclick="return confirm_delete('painel.php?exe=docjuridicos/index&status=delsecao&idcategoria=<?= $secao3['CODIGO']; ?>');" >
                                                    <i class="fa fa-trash icon_red"></i>
                                                </a>
                                                <a href="painel.php?exe=docjuridicos/index&status=downsecao&idcategoria=<?= $secao3['CODIGO']; ?>" >
                                                    <i class="fa fa-caret-down"></i>
                                                </a>
                                                <a href="painel.php?exe=docjuridicos/index&status=upsecao&idcategoria=<?= $secao3['CODIGO']; ?>" >
                                                    <i class="fa fa-caret-up"></i>
                                                </a>
                                            </h3>
                                            <?php
                                            if ($listDoc) {
                                                foreach ($listDoc as $doc) {
                                                    if ($doc['SECAO'] == $secao3['CODIGO']) {
                                                        ?>
                                                        <div class="relatorio_secao3">
                                                            <p class="tagline documento">
                                                                <?= $doc['DESCRICAO']; ?>
                                                                <a href="painel.php?exe=docjuridicos/editdoc&statusdoc=update&iddocumento=<?= $doc['CODIGO']; ?>" >
                                                                    <i class="fa fa-edit icon_blue"></i>
                                                                </a>
                                                                <a href="#" onclick="confirm_delete('painel.php?exe=docjuridicos/index&status=deldoc&iddocumento=<?= $doc['CODIGO']; ?>');" >
                                                                    <i class="fa fa-trash icon_red"></i>
                                                                </a>
                                                                <a href="painel.php?exe=docjuridicos/index&status=downdoc&iddocumento=<?= $doc['CODIGO']; ?>" >
                                                                    <i class="fa fa-caret-down"></i>
                                                                </a>
                                                                <a href="painel.php?exe=docjuridicos/index&status=updoc&iddocumento=<?= $doc['CODIGO']; ?>" >
                                                                    <i class="fa fa-caret-up"></i>
                                                                </a>
                                                            </p>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="relatorio_secao3">
                                                <p class="tagline documento">
                                                    <a href="painel.php?exe=docjuridicos/editdoc&status=createdoc&idcodparente=<?= $secao3['CODIGO']; ?>" >
                                                        <i class="fa fa-file icon_green">&nbsp;</i>Novo Documento
                                                    </a>
                                                </p>
                                            </div>
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
            }
            ?>
        </article>
    </div>

</div>
