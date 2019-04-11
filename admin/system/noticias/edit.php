<?php
$idNoticia = filter_input(INPUT_GET, 'idnoticia', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);


$conteudoRet = '';
$codigoRet = 0;
$dataRet = '';
$tituloRet = '';
$cont = '';

if ($status == 'update'):

    $read = new Read;
    $read->ExeReadMod("SELECT "
            . " CODIGO "
            . " , TITULO "
            . " , CONTEUDO "
            . " , TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI:SS') AS DATA "
            . " FROM "
            . " SITE_NOTICIAS "
            . " WHERE "
            . " CODIGO = " . $idNoticia);

    if ($read->getResult()):

        foreach ($read->getResult() as $noticias):

            extract($noticias);

            $conteudoRet = stream_get_contents($CONTEUDO);
            $tituloRet = $TITULO;
            $codigoRet = $CODIGO;
            $dataRet = $DATA;

        endforeach;

    endif;

elseif ($status == 'create'):

    $read = new Read;
    $read->ExeReadMod('SELECT MAX(CODIGO) AS CODIGO FROM SITE_NOTICIAS');

    if ($read->getResult()):

        foreach ($read->getResult() as $noticias):
            extract($noticias);

            $codigoRet = $CODIGO + 1;

        endforeach;

    endif;

endif;
?>
<div >

    <h1 class="title_crud">EDIÇÃO DE NOTÍCIA</h1>

    <div class="content">

        <form name="PostForm" action="painel.php?exe=noticias/index&status=<?= $status; ?><?= ($status == 'update' ? '&idnoticia=' . $idNoticia . '' : '') ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="CODIGO" value="<?= $codigoRet; ?>" />
            <input type="hidden" name="DATA" value="<?= date('d/m/Y H:i:s'); ?>" />
            <input type="hidden" name="STATUS" value="1" />

            <div class="label_line">
                <label class="label_larger">
                    <span class="field">Enviar Capa:</span>
                    <input 
                        type="file" 
                        name="CAPA" 

                        />
                </label>
            </div>

            <div class="label_line">
                <label class="label_larger">
                    <span class="field">Título:</span>
                    <input 
                        type="text" 
                        name="TITULO" 
                        value="<?= $tituloRet; ?>"
                        required
                        />
                </label>
            </div>

            <div class="label_line">
                <label class="textarea>">
                    <span class="field">Conteúdo:</span>
                    <textarea class="tinyMCE"
                              name="CONTEUDO" 
                              required
                              >
                                  <?php echo $conteudoRet; ?>
                    </textarea>
                </label>
            </div>

            <div class="label_line">
                <div class="gbform">
                    <label class="label_larger">             
                        <span class="field">Enviar Galeria:</span>
                        <input type="file" multiple name="fotos_galeria[]" />
                    </label>             

                    <?php
                    $delGaleria = filter_input(INPUT_GET, 'galeriadel', FILTER_VALIDATE_INT);
                    if ($delGaleria):
                        require_once('_models/AdminNoticia.class.php');
                        $delGal = new AdminNoticia;
                        $delGal->DelFoto($delGaleria);
                    endif;
                    ?>

                    <ul class="gallery">
                        <?php
                        if ($status == 'update'):

                            $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                            $Pager = new Pager('painel.php?exe=noticias/edit&status=update&idnoticia=' . $idNoticia . '&page=');
                            $Pager->ExePager($getPage, 6);

                            $inicial = $Pager->getOffset();
                            $final = $Pager->getLimit() + $Pager->getOffset();

                            $i = 0;
                            $Gallery = new Read;
                            $Gallery->ExeRead("SITE_NOTICIA_GALERIA", "WHERE COD_NOTICIA = :idnoticia", "idnoticia={$idNoticia}");
                            if ($Gallery->getResult()):
                                foreach ($Gallery->getResult() as $gb):
                                    extract($gb);
                                    if ($i >= $inicial && $i < $final):
                                        ?>
                                        <li>
                                            <div class="img thumb_small">
                                                <img class="imagem_capa" src="../uploads/<?= $LINK; ?>"/>
                                            </div>
                                            <a href="painel.php?exe=noticias/edit&status=update&idnoticia=<?= $idNoticia; ?>&galeriadel=<?= $CODIGO; ?>" class="del">Deletar</a>
                                        </li>
                                        <?php
                                    endif;
                                    $i++;
                                endforeach;
                            endif;
                        endif;
                        ?>

                    </ul>
                </div>

                <div class="label_line">
                    <?php
                    if ($status == 'update'):
                        $Pager->ExePaginator("SITE_NOTICIA_GALERIA", "WHERE COD_NOTICIA = :idnoticia", "idnoticia={$idNoticia}");
                        echo $Pager->getPaginator();
                    endif;
                    ?>
                </div>

            </div>

            <div class="label_line botoes">
                <input type="submit" class="btn blue" value="Salvar" name="SendPostForm" />
                <input type="button" onclick="window.location.href = 'painel.php?exe=noticias/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
                <!--<div class="clear"></div>-->
            </div>

        </form>

    </div>
    <!--<div class="clear"></div>-->
</div>
