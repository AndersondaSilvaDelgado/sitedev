<?php
$idCategoria = filter_input(INPUT_GET, 'idcategoria', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);

$descricaoRet = '';
$destaqueRet = 0;
$codigoRet = 0;
$codParenteRet = null;
$posicaoRet = 1;
$dataRet = '';

if ($status == 'update'):

    $read = new Read;
    $read->ExeReadMod("SELECT "
                        . " CODIGO "
                        . " , CODPARENTE "
                        . " , DESCRICAO "
                        . " , TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI:SS') AS DATA "
                        . " , DESTAQUE "
                        . " , POSICAO "
                        . " , NIVEL "
                    . " FROM "
                        . " SITE_CATEGORIA_RELATORIO "
                    . " WHERE CODIGO = " . $idCategoria);

    if ($read->getResult()):

        foreach ($read->getResult() as $categoria):
            extract($categoria);

            $descricaoRet = $DESCRICAO;
            $destaqueRet = $DESTAQUE;
            $codigoRet = $CODIGO;
            $codParenteRet = $CODPARENTE;
            $posicaoRet = $POSICAO;
            $dataRet = $DATA;

        endforeach;

    endif;

elseif ($status == 'create'):

    $read = new Read;
    $read->ExeReadMod('SELECT '
                        . ' MAX(CODIGO) AS CODIGO '
                    . ' FROM '
                        . ' SITE_CATEGORIA_RELATORIO');

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
            <h1 class="title_crud">EDIÇÃO DE CATEGORIA</h1>
        </header>

        <form name="PostForm" action="painel.php?exe=categoria/index&status=<?= $status; ?><?= ($status == 'update' ? '&idcategoria=' . $idCategoria . '' : '') ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="CODIGO" value="<?= $codigoRet; ?>" />
            <input type="hidden" name="DESTAQUE" value="0" />

            <label class="label label_larger">
                <span class="field">Descrição:</span>
                <input 
                    type="text" 
                    name="DESCRICAO" 
                    value="<?= $descricaoRet; ?>" 
                    required
                    />
            </label>


            <label class="label label_larger">
                <span class="field ">Categoria:</span>
                <select name="CODPARENTE">
                    <option value="null"> - </option>
                    <?php
                    $readSes = new Read;
                    $readSes->ExeReadMod("SELECT "
                                            . " CODIGO "
                                            . " , CODPARENTE "
                                            . " , DESCRICAO "
                                            . " , TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI:SS') AS DATA "
                                            . " , DESTAQUE "
                                            . " , POSICAO "
                                            . " , NIVEL "
                                        . " FROM "
                                            . " SITE_CATEGORIA_RELATORIO "
                                        . " WHERE "
                                            . " NIVEL = 1 "
                                            . " AND "
                                            . " CODIGO > 1");
                    if (!$readSes->getResult()):
                        echo '<option disabled="disabled" value="null"> Cadastre antes uma seção! </option>';
                    else:
                        foreach ($readSes->getResult() as $sub1Ses):
                            echo "<option value=\"{$sub1Ses['CODIGO']}\" ";

                            if ($sub1Ses['CODIGO'] == $codParenteRet):
                                echo ' selected="selected" ';
                            endif;

                            echo "> {$sub1Ses['DESCRICAO']} </option>";

                            $readSub2Ses = new Read;
                            $readSub2Ses->ExeReadMod("SELECT "
                                                        . " CODIGO "
                                                        . " , CODPARENTE "
                                                        . " , DESCRICAO "
                                                        . " , TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI:SS') AS DATA "
                                                        . " , DESTAQUE "
                                                        . " , POSICAO "
                                                        . " , NIVEL "
                                                    . " FROM "
                                                        . " SITE_CATEGORIA_RELATORIO "
                                                    . " WHERE "
                                                        . " NIVEL = 2 "
                                                        . " AND "
                                                        . " CODPARENTE = " . $sub1Ses['CODIGO']);

                            if ($readSub2Ses->getResult()):

                                foreach ($readSub2Ses->getResult() as $sub2Ses):

                                    echo "<option value=\"{$sub2Ses['CODIGO']}\" ";

                                    if ($sub2Ses['CODIGO'] == $codParenteRet):
                                        echo ' selected="selected" ';
                                    endif;

                                    echo "> - {$sub2Ses['DESCRICAO']} </option>";

                                    $readSub3Ses = new Read;
                                    $readSub3Ses->ExeReadMod("SELECT "
                                                                . " CODIGO "
                                                                . " , CODPARENTE "
                                                                . " , DESCRICAO "
                                                                . " , TO_CHAR(DATA, 'DD/MM/YYYY HH24:MI:SS') AS DATA "
                                                                . " , DESTAQUE "
                                                                . " , POSICAO "
                                                                . " , NIVEL "
                                                            . " FROM "
                                                                . " SITE_CATEGORIA_RELATORIO "
                                                            . " WHERE "
                                                                . " NIVEL = 3 "
                                                                . " AND "
                                                                . " CODPARENTE = " . $sub2Ses['CODIGO']);

                                    if ($readSub3Ses->getResult()):

                                        foreach ($readSub3Ses->getResult() as $sub3Ses):

                                            echo "<option value=\"{$sub3Ses['CODIGO']}\" ";

                                            if ($sub3Ses['CODIGO'] == $codParenteRet):
                                                echo ' selected="selected" ';
                                            endif;

                                            echo "> - - {$sub3Ses['DESCRICAO']} </option>";

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
                            $codigoRet = $codigoRet - 1;
                            ?>
                            value="<?= $codigoRet; ?>" 
                            <?php
                        elseif ($status == 'update'):
                            ?>
                            value="<?= $posicaoRet; ?>" 
                            <?php
                        endif;
                        ?>
                        required
                        />
                </label>

                <!--<div class="clear"></div>-->
            </div>


            <div class="label_line botoes">
                <input type="submit" class="btn blue" value="Salvar" name="SendPostForm" />
                <input type="button" onclick="window.location.href = 'painel.php?exe=categoria/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
                <!--<div class="clear"></div>-->
            </div>

        </form>

    </article>
    <!--<div class="clear"></div>-->
</div>
