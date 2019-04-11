<?php
$idCategoria = filter_input(INPUT_GET, 'idcategoria', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$codParente = filter_input(INPUT_GET, 'idcodparente', FILTER_VALIDATE_INT);

$descricaoRet = '';
$destaqueRet = 0;
$codigoRet = 0;
$codParenteRet = 0;
$posicaoRet = 1;
$dataRet = '';

if ($status == 'updatesecao'):

    $read = new Read;
    $read->ExeReadMod("SELECT "
            . " CODIGO "
            . " , CODPARENTE "
            . " , DESCRICAO "
            . " , TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI:SS') AS DATA "
            . " , POSICAO "
            . " , NIVEL "
            . " FROM "
            . " SITE_CATEGORIA_RELATORIO "
            . " WHERE CODIGO = " . $idCategoria);

    if ($read->getResult()):

        foreach ($read->getResult() as $categoria):
            extract($categoria);

            $descricaoRet = $DESCRICAO;
            $codigoRet = $CODIGO;
            $codParenteRet = $CODPARENTE;
            $posicaoRet = $POSICAO;
            $dataRet = $DATA;

        endforeach;

    endif;

elseif ($status == 'createsecao'):

    $codParenteRet = $codParente;

    $readCod = new Read;
    $readCod->ExeReadMod("SELECT MAX(CODIGO) AS CODIGO "
            . " FROM SITE_CATEGORIA_RELATORIO");

    if ($readCod->getResult()):
        foreach ($readCod->getResult() as $catCod):
            $codigoRet = $catCod['CODIGO'] + 1;
        endforeach;
    endif;

    $readPos = new Read;
    $readPos->ExeReadMod("SELECT MAX(POSICAO) AS CODIGO "
            . " FROM SITE_CATEGORIA_RELATORIO");

    if ($readPos->getResult()):
        foreach ($readPos->getResult() as $catPos):
            $posicaoRet = $catPos['CODIGO'] + 1;
        endforeach;
    endif;

endif;
?>
<div >

    <h1 class="title_crud">EDIÇÃO DE CATEGORIA</h1>

    <div class="content">

        <form name="PostForm" action="painel.php?exe=demo_financeira/index&status=<?= $status; ?><?= ($status == 'updatesecao' ? '&idcategoria=' . $idCategoria . '' : '') ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="CODIGO" value="<?= $codigoRet; ?>" />

            <div class="label_line">
                <label class="label label_larger">
                    <span class="field">Descrição:</span>
                    <input 
                        type="text" 
                        name="DESCRICAO" 
                        value="<?= $descricaoRet; ?>" 
                        required
                        />
                </label>
            </div>
            
            <input type="hidden" name="CODPARENTE" value="<?= $codParenteRet; ?>" />
            <input type="hidden" name="POSICAO" value="<?= $posicaoRet; ?>" />
            <input type="hidden" name="TIPO" value="1" />

            <div class="label_line">

                <label class="label_medium">
                    <span class="field">Data:</span>
                    <input 
                        type="text" 
                        class="formDate center" 
                        name="DATA" 
                        <?php
                        if ($status == 'createsecao'):
                            ?>
                            value="<?= date('d/m/Y H:i:s'); ?>" 
                            <?php
                        elseif ($status == 'updatesecao'):
                            ?>
                            value="<?= $dataRet; ?>" 
                            <?php
                        endif;
                        ?>
                        required
                        readonly
                        />
                </label>

            </div>


            <div class="label_line botoes">
                <input type="submit" class="btn blue" value="Salvar" name="SendPostForm" />
                <input type="button" onclick="window.location.href = 'painel.php?exe=demo_financeira/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
                <!--<div class="clear"></div>-->
            </div>

        </form>

    </div>
</div>
