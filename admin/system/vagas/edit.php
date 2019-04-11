<?php
$idVaga = filter_input(INPUT_GET, 'idvaga', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);

$codigoRet = 0;
$tipoRet = 0;
$descricaoRet = '';
$descritivoRet = '';
$qtdeRet = 0;
$dataRet = '';
$qtdeRet = 1;

if ($status == 'update'):

    $read = new Read;
    $read->ExeReadMod("SELECT "
            . " CODIGO "
            . " , DESCRICAO "
            . " , QTDE "
            . " , DESCRITIVO "
            . " , TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI:SS') AS DATA "
            . " , TIPO "
            . " FROM "
            . " SITE_VAGAS "
            . " WHERE"
            . " CODIGO = " . $idVaga);

    if ($read->getResult()):

        foreach ($read->getResult() as $vaga):
            extract($vaga);

            $descricaoRet = $DESCRICAO;
            $descritivoRet = stream_get_contents($DESCRITIVO);
            $codigoRet = $CODIGO;
            $tipoRet = $TIPO;
            $dataRet = $DATA;
            $qtdeRet = $QTDE;

        endforeach;

    endif;

elseif ($status == 'create'):

    $read = new Read;
    $read->ExeReadMod('SELECT MAX(CODIGO) AS CODIGO FROM SITE_VAGAS');

    if ($read->getResult()):

        foreach ($read->getResult() as $vaga):
            extract($vaga);

            $codigoRet = $CODIGO + 1;

        endforeach;

    endif;

endif;
?>
<div class="form_create">

    <h1 class="title_crud">EDIÇÃO DE VAGAS DE EMPREGO</h1>

    <div class="content">

        <form name="PostForm" action="painel.php?exe=vagas/index&status=<?= $status; ?><?= ($status == 'update' ? '&idvaga=' . $idVaga . '' : '') ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="CODIGO" value="<?= $codigoRet; ?>" />

            <div class="label_line">
                <label class="label_larger">
                    <span class="field">Título:</span>
                    <input 
                        type="text" 
                        name="DESCRICAO" 
                        value="<?= $descricaoRet; ?>" 
                        required
                        />
                </label>
            </div>

            <div class="label_line">
                <label class="textarea">
                    <span class="field">Descrição:</span>
                    <textarea class="tinyMCE"
                              name="DESCRITIVO" 
                              required
                              >
                                  <?php echo $descritivoRet; ?>
                    </textarea>
                </label>
            </div>

            <div class="label_line">

                <label class="label_small">
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

                <label class="label_small">
                    <span class="field">Tipo:</span>
                    <select class="lista_detalhe" name="TIPO" required>
                        <option value='1' <?= ($tipoRet == 1 ? 'selected="selected"' : '') ?>> Efetivo </option>
                        <option value='2' <?= ($tipoRet == 2 ? 'selected="selected"' : '') ?>> Safrista </option>
                        <option value='3' <?= ($tipoRet == 3 ? 'selected="selected"' : '') ?>> Estagio </option>
                    </select>
                </label>

                <label class="label_small">
                    <span class="field">Qtde:</span>
                    <input 
                        type="number" 
                        class="direita" 
                        name="QTDE"
                        value="<?= $qtdeRet; ?>"
                        required
                        />
                </label>

                <!--<div class="clear"></div>-->
            </div>


            <div class="label_line botoes">
                <input type="submit" class="btn blue" value="Salvar" name="SendPostForm" />
                <input type="button" onclick="window.location.href = 'painel.php?exe=vagas/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
                <!--<div class="clear"></div>-->
            </div>

        </form>

    </div>
    <!--<div class="clear"></div>-->
</div>
