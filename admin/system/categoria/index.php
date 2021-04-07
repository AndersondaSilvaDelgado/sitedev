<?php
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$categoria = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$idCategoria = filter_input(INPUT_GET, 'idcategoria', FILTER_VALIDATE_INT);

require_once '_models/AdminCategoria.class.php';
$adminCategoria = new AdminCategoria;

require_once '_models/AdminDocumento.class.php';
$adminDocumento = new AdminDocumento();

if (isset($categoria) && $categoria['SendPostForm']):

    $categoria['CODPARENTE'] = ($categoria['CODPARENTE'] == "null") ? 0 : $categoria['CODPARENTE'];
    unset($categoria['SendPostForm']);

    if ($status):

        switch ($status):

            case 'create':
                $adminCategoria->ExeCreate($categoria);
                break;

            case 'update':
                $categoria['DATA'] = date('d/m/Y H:i:s');
                $adminCategoria->ExeUpdate($idCategoria, $categoria);
                break;

        endswitch;

    endif;

endif;

if (isset($status) && ($status == 'delete')):

    $adminCategoria->ExeDelete($idCategoria);
    $dados = array("SECAO" => 1);
    $adminDocumento->UpdateSecao($dados, $idCategoria);

endif;
?>
<div class="list_content">

    <section>
        <h1 class="title_crud">CATEGORIAS</h1>
        <a href="painel.php?exe=categoria/edit&status=create" title="Inserir">
            <article class="box_item inserir">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </article>
        </a>

        <?php
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $Pager = new Pager('painel.php?exe=categoria/index&page=');
        $Pager->ExePager($getPage, 11);

        $inicial = $Pager->getOffset();
        $final = $Pager->getLimit() + $Pager->getOffset();

        $readCategorias = new Read;
        $readCategorias->ExeReadMod("SELECT * FROM SITE_CATEGORIA_RELATORIO WHERE CODIGO > 1 ORDER BY DESTAQUE, POSICAO, DESCRICAO ASC");

        $i = 0;
        if ($readCategorias->getResult()):
            foreach ($readCategorias->getResult() as $categoria):
                extract($categoria);
                if ($i >= $inicial && $i < $final):
                    ?>
                    <a href="painel.php?exe=categoria/edit&status=update&idcategoria=<?= $CODIGO; ?>">
                        <article class="box_item" >
                            <div class="post_actions">
                                <i class="fa fa-times fa-1x" onclick="return confirm_delete('painel.php?exe=categoria/index&status=delete&idcategoria=<?= $CODIGO; ?>');"></i>
                            </div>
                            <h1><span><?= Check::Words($DESCRICAO, 4); ?></span></h1>
                            <p>Posição: <span><?= $POSICAO; ?>º</span></p>
                            <?php
                            if ($CODPARENTE == 0):
                                echo '<p>Categoria Pai: <span>Nenhuma</span></p>';
                            else:
                                $readPaiCat = new Read;
                                $readPaiCat->ExeReadMod('SELECT * FROM SITE_CATEGORIA_RELATORIO WHERE CODIGO = ' . $CODPARENTE);
                                foreach ($readPaiCat->getResult() as $paiCat):
                                    echo '<p>Categoria Pai: <span>' . Check::Words($paiCat['DESCRICAO'], 4) . '</span></p>';
                                endforeach;
                            endif;
                            ?>
                            <!--<p><span><?= ($DESTAQUE == 1 ? 'DESTAQUE' : 'NÃO DESTAQUE') ?></span></p>-->
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
        $Pager->ExePaginator("SITE_CATEGORIA_RELATORIO", "WHERE CODIGO > :cod", "cod=1");
        echo $Pager->getPaginator();
        ?>
    </div>
    <!--<div class="clear"></div>-->
</div>
