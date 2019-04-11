<?php
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$vaga = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$idVaga = filter_input(INPUT_GET, 'idvaga', FILTER_VALIDATE_INT);

require_once '_models/AdminVaga.class.php';
$adminVaga = new AdminVaga();

if (isset($vaga) && $vaga['SendPostForm']):

    unset($vaga['SendPostForm']);

    if ($status):

        switch ($status):

            case 'create':
                $adminVaga->ExeCreate($vaga);
                break;

            case 'update':
                $vaga['DATA'] = date('d/m/Y H:i:s');
                $adminVaga->ExeUpdate($idVaga, $vaga);
                break;

        endswitch;

    endif;

endif;

if (isset($status) && ($status == 'delete')):

    $adminVaga->ExeDelete($idVaga);

endif;
?>
<div class="list_content">

        <h1 class="title_crud">VAGAS DE EMPREGO</h1>
        
        <div class="content">
        
        <a href="painel.php?exe=vagas/edit&status=create" title="Inserir">
            <article class="box_item ">
                <div class="imagem_novo">
                    <img class="imagem_capa" src="icons/inserir.png"/>
                </div>
            </article>
        </a>

        <?php
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $Pager = new Pager('painel.php?exe=vagas/index&page=');
        $Pager->ExePager($getPage, 11);

        $inicial = $Pager->getOffset();
        $final = $Pager->getLimit() + $Pager->getOffset();

        $readCategorias = new Read;
        $readCategorias->ExeReadMod("SELECT * FROM SITE_VAGAS ORDER BY CODIGO DESC");

        $i = 0;
        if ($readCategorias->getResult()):
            foreach ($readCategorias->getResult() as $vaga):
                extract($vaga);
                if ($i >= $inicial && $i < $final):
                    ?>
                    <a href="painel.php?exe=vagas/edit&status=update&idvaga=<?= $CODIGO; ?>">
                        <article class="box_item" >
                            <div class="post_actions">
                                <i class="fa fa-times" onclick="return confirm_delete('painel.php?exe=vagas/index&status=delete&idvaga=<?= $CODIGO; ?>');"></i>
                            </div>
                            <h1><span><?= Check::Words($DESCRICAO, 4); ?></span></h1>
                            <div class="clear"></div>
                        </article>
                    </a>
                    <?php
                endif;
                $i++;
            endforeach;
        endif;
        ?>
        </div>
    <div class="label_line">
        <?php
        $Pager->ExePaginator("SITE_VAGAS", "WHERE CODIGO > :cod", "cod=1");
        echo $Pager->getPaginator();
        ?>
    </div>
    <!--<div class="clear"></div>-->
</div>
