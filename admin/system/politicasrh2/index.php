<?php
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$documento = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$idDocumento = filter_input(INPUT_GET, 'iddocumento', FILTER_VALIDATE_INT);

require_once '_models/AdminPoliticaRH.class.php';
$adminPoliticaRH = new AdminPoliticaRH;

if (isset($documento) && $documento['SendPostForm']):

    $documento['DOCUMENTO'] = ( $_FILES['DOCUMENTO']['tmp_name'] ? $_FILES['DOCUMENTO'] : 'null' );
    unset($documento['SendPostForm']);

    if ($status):

        switch ($status):

            case 'create':
                $adminPoliticaRH->ExeCreate($documento);
                break;

            case 'update':
                $documento['DATA'] = date('d/m/Y H:i:s');
                $adminPoliticaRH->ExeUpdate($idDocumento, $documento);
                break;

        endswitch;

    endif;

endif;

if (isset($status) && ($status == 'delete')):
    $adminPoliticaRH->ExeDelete($idDocumento);
endif;
?>

<div class="list_content">

    <section>
        <!--<div class="clear"></div>-->
        <h1 class="title_crud">POLÍTICAS DE RH</h1>
        <a href="painel.php?exe=politicasrh/edit&status=create" title="Inserir">
            <article class="box_item inserir">
                <i class="fa fa-plus" aria-hidden="true" fa-5x></i>
            </article>
        </a>

        <?php
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $Pager = new Pager('painel.php?exe=politicasrh/index&page=');
        $Pager->ExePager($getPage, 11);

        $inicial = $Pager->getOffset();
        $final = $Pager->getLimit() + $Pager->getOffset();

        $readDocumentos = new Read;
        $readDocumentos->ExeReadMod('SELECT * FROM SITE_POLITICAS_RH ORDER BY DESCRICAO ASC');

        $i = 0;
        if ($readDocumentos->getResult()):
            foreach ($readDocumentos->getResult() as $documento):
                extract($documento);
                if ($i >= $inicial && $i < $final):
                    ?>
                    <a href="painel.php?exe=politicasrh/edit&status=update&iddocumento=<?= $CODIGO; ?>">
                        <article  class="box_item">
                            <ul class="info post_actions">
                                <li>
                                    <i class="fa fa-times" onclick="return confirm_delete('painel.php?exe=politicasrh/index&status=delete&iddocumento=<?= $CODIGO; ?>');"></i>
                                </li>
                            </ul>
                            <h1><span><?= Check::Words($DESCRICAO, 4); ?></span></h1>
                            <p>Posição: <span><?= $POSICAO; ?>º</span></p>
                            <div class="clear"></div>
                        </article>
                    </a>
                    <?php
                endif;
                $i++;
            endforeach;
        endif;
        ?>
    </section>
    <div class="label_line">
        <?php
        $Pager->ExePaginator("SITE_POLITICAS_RH");
        echo $Pager->getPaginator();
        ?>
    </div>
    <!--<div class="clear"></div>-->
</div>
