<?php
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$retornpost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$idCategoria = filter_input(INPUT_GET, 'idcategoria', FILTER_VALIDATE_INT);
$idDocumento = filter_input(INPUT_GET, 'iddocumento', FILTER_VALIDATE_INT);

require_once '_models/AdminPoliticaRH.class.php';
$adminPoliticaRH = new AdminPoliticaRH;

if ($status):

    switch ($status):

        case 'createdoc':
            $retornpost['DOCUMENTO'] = ( $_FILES['DOCUMENTO']['tmp_name'] ? $_FILES['DOCUMENTO'] : 'null' );
            unset($retornpost['SendPostForm']);
            $adminPoliticaRH->ExeCreate($retornpost);
            break;

        case 'updatedoc':
            if (isset($retornpost) && $retornpost['SendPostForm']):
                $retornpost['DOCUMENTO'] = ( $_FILES['DOCUMENTO']['tmp_name'] ? $_FILES['DOCUMENTO'] : 'null' );
                unset($retornpost['SendPostForm']);
                $retornpost['DATA'] = date('d/m/Y H:i:s');
                $adminPoliticaRH->ExeUpdate($idDocumento, $retornpost);
            endif;
            break;

        case 'deldoc':
            $adminPoliticaRH->ExeDelete($idDocumento);
            break;

        case 'downdoc':
            $adminPoliticaRH->DownDoc($idDocumento);
            break;

        case 'updoc':
            $adminPoliticaRH->UpDoc($idDocumento);
            break;

    endswitch;

endif;
?>
<div>

    <h1 class="title_crud">POLÍTICAS DE RH</h1>

    <div class="content">

        <?php
        $readDoc = new Read;
        $readDoc->ExeReadMod('SELECT * FROM SITE_POLITICAS_RH_NV ORDER BY POSICAO DESC');
        $listDoc = null;
        if ($readDoc->getResult()) {
            $listDoc = $readDoc->getResult();
        }
        ?>
        <article class="secao">
            <div class="relatorio_secao1">
                <p class="tagline documento">
                    <a href="painel.php?exe=politicasrh/editdoc&status=createdoc" >
                        <i class="fa fa-file icon_green">&nbsp;</i>Novo Documento
                    </a>
                </p>
            </div>
            <?php
            if ($listDoc) {
                foreach ($listDoc as $doc) {
                    ?>
                    <div class="relatorio_secao1">
                        <p class="tagline documento">
                            <?= $doc['DESCRICAO']; ?>
                            <a href="painel.php?exe=politicasrh/editdoc&status=updatedoc&iddocumento=<?= $doc['CODIGO']; ?>" >
                                <i class="fa fa-edit icon_blue"></i>
                            </a>
                            <a href="#" onclick="confirm_delete('painel.php?exe=politicasrh/index&status=deldoc&iddocumento=<?= $doc['CODIGO']; ?>');" >
                                <i class="fa fa-trash icon_red"></i>
                            </a>
                            <a href="painel.php?exe=politicasrh/index&status=downdoc&iddocumento=<?= $doc['CODIGO']; ?>" >
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <a href="painel.php?exe=politicasrh/index&status=updoc&iddocumento=<?= $doc['CODIGO']; ?>" >
                                <i class="fa fa-caret-up"></i>
                            </a>
                        </p>
                    </div>
                    <?php
                }
            }
            ?>
        </article>
    </div>

</div>
