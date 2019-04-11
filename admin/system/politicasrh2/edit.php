<?php
$idDocumento = filter_input(INPUT_GET, 'iddocumento', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);

$descricaoRet = '';
$posicaoRet = 1;
$codigoRet = 1;
$documentoRet = '';
$dataRet = '';

if ($status == 'update'):

    $read = new Read;
    $read->ExeReadMod("SELECT "
                            . " CODIGO "
                            . " , DESCRICAO "
                            . " , DOCUMENTO "
                            . " , TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI:SS') AS DATA "
                            . " , POSICAO "
                        . " FROM "
                            . " SITE_POLITICAS_RH "
                        . " WHERE "
                            . " CODIGO = " . $idDocumento);

    if ($read->getResult()):

        foreach ($read->getResult() as $documento):

            extract($documento);
            $descricaoRet = $DESCRICAO;
            $posicaoRet = $POSICAO;
            $documentoRet = '../upload/' . $DOCUMENTO;
            $dataRet = $DATA;

        endforeach;

    endif;

elseif ($status == 'create'):

    $read = new Read;
    $read->ExeReadMod('SELECT NVL(MAX(CODIGO), 0) AS CODIGO FROM SITE_POLITICAS_RH');

    if ($read->getResult()):

        foreach ($read->getResult() as $documento):
            extract($documento);

            $codigoRet = $CODIGO + 1;

        endforeach;

    endif;

endif;
?>
<div class="form_create">

    <article>

        <!--<div class="clear"></div>-->

        <header >
            <h1 class="title_crud">EDIÇÃO DE POLÍTICAS DE RH</h1>
        </header>

        <form name="PostForm" action="painel.php?exe=politicasrh/index&status=<?= $status; ?><?= ($status == 'update' ? '&iddocumento=' . $idDocumento . '' : '') ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="CODIGO" value="<?= $codigoRet; ?>" />
            
            <label class="label label_larger">
                <span class="field">Descrição:</span>
                <input 
                    type="text" 
                    name="DESCRICAO" 
                    value="<?= $descricaoRet; ?>" 
                    required
                    />
            </label>

            <label class="label">
                <span class="field">Enviar Documento:</span>
                <input 
                    type="file" 
                    name="DOCUMENTO" 
                    value=""
                    <?php
                    if ($status == 'create'):
                        echo 'required';
                    endif;
                    ?>
                    />
            </label>

            <div class="label_line">

                <label class="label_medium">
                    <span class="field">Data:</span>
                    <input 
                        type="text" 
                        class="formDate center" 
                        name="DATA" 
                        <?php
                        if ($status == 'create'):
                            ?>
                            value="<?= date('d/m/Y H:i:s'); ?>" 
                            <?php
                        elseif ($status == 'update'):
                            ?>
                            value="<?= $dataRet; ?>" 
                            <?php
                        endif;
                        ?>
                        required
                        readonly
                        />
                </label>

                <label class="label_medium">
                    <span class="field">Posição:</span>
                    <input 
                        type="number" 
                        class="direita" 
                        name="POSICAO" 
                        <?php
                        if ($status == 'create'):
                            ?>
                            value="<?= $codigoRet; ?>" 
                            <?php
                        elseif ($status == 'update'):
                            ?>
                            value="<?= $posicaoRet; ?>"
                            <?php
                        endif;
                        ?>
                        />
                </label>

                <!--<div class="clear"></div>-->
            </div>



            <div class="label_line botoes">
                <input type="submit" class="btn blue" value="Salvar" name="SendPostForm" />
                <input type="button" onclick="window.location.href = 'painel.php?exe=politicasrh/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
                <!--<div class="clear"></div>-->
            </div>

        </form>

    </article>
    <!--<div class="clear"></div>-->
</div>
