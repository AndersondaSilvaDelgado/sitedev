<?php
$idDocumento = filter_input(INPUT_GET, 'iddocumento', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);

$descricaoRet = '';
$codSecao = 1;
$codigoRet = 1;
$posicaoRet = 1;
$documentoRet = '';
$dataRet = '';

if ($status == 'update'):

    $read = new Read;
    $read->ExeReadMod("SELECT CODIGO, DESCRICAO, DOCUMENTO, SECAO, TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI:SS') AS DATA, POSICAO FROM SITE_RELATORIO WHERE CODIGO = " . $idDocumento);

    if ($read->getResult()):

        foreach ($read->getResult() as $documento):

            extract($documento);
            $descricaoRet = $DESCRICAO;
            $codSecao = $SECAO;
            $posicaoRet = $POSICAO;
            $documentoRet = '../upload/' . $DOCUMENTO;
            $dataRet = $DATA;

        endforeach;

    endif;

elseif ($status == 'create'):

    $read = new Read;
    $read->ExeReadMod('SELECT MAX(CODIGO) AS CODIGO FROM SITE_RELATORIO');

    if ($read->getResult()):

        foreach ($read->getResult() as $categoria):
            extract($categoria);

            $codigoRet = $CODIGO + 1;

        endforeach;

    endif;

endif;
?>
<div class="form_create">

    <article>

        <!--<div class="clear"></div>-->

        <header >
            <h1 class="title_crud">EDIÇÃO DE DOCUMENTOS</h1>
        </header>

        <form name="PostForm" action="painel.php?exe=documentos/index&status=<?= $status; ?><?= ($status == 'update' ? '&iddocumento=' . $idDocumento . '' : '') ?>" method="post" enctype="multipart/form-data">

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

            <input type="hidden" name="CODIGO" value="<?= $codigoRet; ?>" />

            <label class="label label_larger">
                <span class="field ">Categoria:</span>
                <select name="SECAO" required>
                    <?php
                    $readSes = new Read;
                    $readSes->ExeReadMod('SELECT * FROM SITE_CATEGORIA_RELATORIO WHERE NIVEL = 1 ORDER BY POSICAO, DESCRICAO ASC');
                    if ($readSes->getResult()):

                        foreach ($readSes->getResult() as $ses):
                            echo "<option value=\"{$ses['CODIGO']}\" ";

                            if ($ses['CODIGO'] == $codSecao):
                                echo ' selected="selected" ';
                            endif;

                            echo "> {$ses['DESCRICAO']} </option>";
                            
                            $readSub1Ses = new Read;
                            $readSub1Ses->ExeReadMod('SELECT * FROM SITE_CATEGORIA_RELATORIO WHERE NIVEL = 2 AND CODPARENTE = ' . $ses['CODIGO'] . ' ORDER BY POSICAO, DESCRICAO ASC');

                            if ($readSub1Ses->getResult()):

                                foreach ($readSub1Ses->getResult() as $sub1Ses):

                                    echo "<option value=\"{$sub1Ses['CODIGO']}\" ";

                                    if ($sub1Ses['CODIGO'] == $codSecao):
                                        echo ' selected="selected" ';
                                    endif;

                                    echo ">&nbsp;-&nbsp; {$sub1Ses['DESCRICAO']} </option>";

                                    $readSub2Ses = new Read;
                                    $readSub2Ses->ExeReadMod('SELECT * FROM SITE_CATEGORIA_RELATORIO WHERE NIVEL = 3 AND CODPARENTE = ' . $sub1Ses['CODIGO'] . ' ORDER BY POSICAO, DESCRICAO ASC');

                                    if ($readSub2Ses->getResult()):

                                        foreach ($readSub2Ses->getResult() as $sub2Ses):

                                            echo "<option value=\"{$sub2Ses['CODIGO']}\" ";

                                            if ($sub2Ses['CODIGO'] == $codSecao):
                                                echo ' selected="selected" ';
                                            endif;

                                            echo ">&nbsp;-&nbsp;-&nbsp; {$sub2Ses['DESCRICAO']} </option>";

                                            $readSub3Ses = new Read;
                                            $readSub3Ses->ExeReadMod('SELECT * FROM SITE_CATEGORIA_RELATORIO WHERE NIVEL = 4 AND CODPARENTE = ' . $sub2Ses['CODIGO'] . ' ORDER BY POSICAO, DESCRICAO ASC');

                                            if ($readSub3Ses->getResult()):

                                                foreach ($readSub3Ses->getResult() as $sub3Ses):

                                                    echo "<option value=\"{$sub3Ses['CODIGO']}\" ";

                                                    if ($sub3Ses['CODIGO'] == $codSecao):
                                                        echo ' selected="selected" ';
                                                    endif;

                                                    echo ">&nbsp;-&nbsp;-&nbsp;-&nbsp; {$sub3Ses['DESCRICAO']} </option>";

                                                endforeach;

                                            endif;

                                        endforeach;

                                    endif;

                                endforeach;

                            endif;

                        endforeach;
                    endif;
                    ?>
                </select>
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
                <input type="button" onclick="window.location.href = 'painel.php?exe=documentos/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
                <!--<div class="clear"></div>-->
            </div>

        </form>

    </article>
    <!--<div class="clear"></div>-->
</div>
