<?php
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$noticia = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$idNoticia = filter_input(INPUT_GET, 'idnoticia', FILTER_VALIDATE_INT);

require_once '_models/AdminNoticia.class.php';
$adminNoticia = new AdminNoticia();

if (isset($noticia) && $noticia['SendPostForm']):

    unset($noticia['SendPostForm']);
    $noticia['fotos_galeria'] = $_FILES['fotos_galeria'];
    $noticia['CAPA'] = $_FILES['CAPA'];

    if ($status):

        switch ($status):

            case 'create':
                $adminNoticia->ExeCreate($noticia);
                break;

            case 'update':
                $noticia['DATA'] = date('d/m/Y H:i:s');
                $adminNoticia->ExeUpdate($idNoticia, $noticia);
                break;

        endswitch;

    endif;

endif;

if (isset($status) && ($status == 'delete')):

    $adminNoticia->ExeDelete($idNoticia);

endif;
?>
<div >

    <h1 class="title_crud">NOTÍCIAS</h1>

    <div class="content">

        <a href="painel.php?exe=noticias/edit&status=create" title="Inserir">
            <article class="box_item ">
                <div class="imagem_novo">
                    <img class="imagem_capa" src="icons/inserir.png"/>
                </div>
            </article>
        </a>

        <?php
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $Pager = new Pager('painel.php?exe=noticias/index&page=');
        $Pager->ExePager($getPage, 7);

        $inicial = $Pager->getOffset();
        $final = $Pager->getLimit() + $Pager->getOffset();

        $readCategorias = new Read;
        $readCategorias->ExeReadMod("SELECT * FROM SITE_NOTICIAS WHERE STATUS = 1 ORDER BY CODIGO DESC");

        $i = 0;
        if ($readCategorias->getResult()):
            foreach ($readCategorias->getResult() as $noticia):
                extract($noticia);
                if ($i >= $inicial && $i < $final):
                    ?>
                    <a href="painel.php?exe=noticias/edit&status=update&idnoticia=<?= $CODIGO; ?>">
                        <article class="box_item" >
                            <div class="post_actions">
                                <i class="fa fa-times" onclick="return confirm_delete('painel.php?exe=noticias/index&status=delete&idnoticia=<?= $CODIGO; ?>');"></i>
                            </div>
                            <div class="imagem_noticia">
                                <img class="imagem_capa" src="../uploads/<?= $CAPA; ?>"/>
                            </div>
                            <h1><span><?= Check::Words($TITULO, 4); ?></span></h1>
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
        $Pager->ExePaginator("SITE_NOTICIAS", "WHERE CODIGO > :cod", "cod=1");
        echo $Pager->getPaginator();
        ?>
    </div>
    <!--<div class="clear"></div>-->
</div>
