<?php
$idDocumento = filter_input(INPUT_GET, 'iddocumento', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$codParente = filter_input(INPUT_GET, 'idcodparente', FILTER_VALIDATE_INT);

$descricaoRet = '';
$codSecaoRet = 1;
$codigoRet = 1;
$posicaoRet = 1;
$documentoRet = '';
$dataRet = '';

if ($status == 'updatedoc'):

    $read = new Read;
    $read->ExeReadMod("SELECT "
            . " CODIGO "
            . " , DESCRICAO "
            . " , DOCUMENTO "
            . " , SECAO "
            . " , TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI:SS') AS DATA "
            . " , POSICAO "
            . " FROM "
            . " SITE_RELATORIO "
            . " WHERE "
            . " CODIGO = " . $idDocumento);

    if ($read->getResult()):

        foreach ($read->getResult() as $documento):

            extract($documento);
            $descricaoRet = $DESCRICAO;
            $codSecaoRet = $SECAO;
            $posicaoRet = $POSICAO;
            $documentoRet = '../upload/' . $DOCUMENTO;
            $dataRet = $DATA;

        endforeach;

    endif;

elseif ($status == 'createdoc'):

    $codSecaoRet = $codParente;

    $readCod = new Read;
    $readCod->ExeReadMod("SELECT MAX(CODIGO) AS CODIGO "
            . " FROM SITE_RELATORIO");

    if ($readCod->getResult()):
        foreach ($readCod->getResult() as $catCod):
            $codigoRet = $catCod['CODIGO'] + 1;
        endforeach;
    endif;

    $readPos = new Read;
    $readPos->ExeReadMod("SELECT MAX(POSICAO) AS CODIGO "
            . " FROM SITE_RELATORIO");

    if ($readPos->getResult()):
        foreach ($readPos->getResult() as $catPos):
            $posicaoRet = $catPos['CODIGO'] + 1;
        endforeach;
    endif;

endif;
?>
<div>

    <h1 class="title_crud">EDIÇÃO DE DOCUMENTOS</h1>

    <div class="content">

        <form name="PostForm" action="painel.php?exe=documentos/index&status=<?= $status; ?><?= ($status == 'updatedoc' ? '&iddocumento=' . $idDocumento . '' : '') ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="CODIGO" value="<?= $codigoRet; ?>" />

            <div class="label_line">
                <label class="label_larger">
                    <span class="field">Descrição:</span>
                    <input 
                        type="text" 
                        name="DESCRICAO" 
                        value="<?= $descricaoRet; ?>" 
                        required
                        />
                </label>
            </div>

            <div class="label_line">
                <label >
                    <span class="field">Enviar Documento:</span>
                    <input 
                        type="file" 
                        name="DOCUMENTO" 
                        value=""
                        <?php
                        if ($status == 'createdoc'):
                            echo 'required';
                        endif;
                        ?>
                        />
                </label>
            </div>

            <input type="hidden" name="SECAO" value="<?= $codSecaoRet; ?>" />
            <input type="hidden" name="POSICAO" value="<?= $posicaoRet; ?>" />

            <div class="label_line">

                <label class="label_medium">
                    <span class="field">Data:</span>
                    <input 
                        type="text" 
                        class="formDate center" 
                        name="DATA" 
                        <?php
                        if ($status == 'createdoc'):
                            ?>
                            value="<?= date('d/m/Y H:i:s'); ?>" 
                            <?php
                        elseif ($status == 'updatedoc'):
                            ?>
                            value="<?= $dataRet; ?>" 
                            <?php
                        endif;
                        ?>
                        required
                        readonly
                        />
                </label>

                <!--<div class="clear"></div>-->
            </div>

            <div class="label_line botoes">
                <input type="submit" class="btn blue" value="Salvar" name="SendPostForm" />
                <input type="button" onclick="window.location.href = 'painel.php?exe=documentos/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
                <!--<div class="clear"></div>-->
            </div>

        </form>

    </div>
    <!--<div class="clear"></div>-->
</div>
