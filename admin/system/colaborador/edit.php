<?php
$idUsuario = filter_input(INPUT_GET, 'idusuario', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);

$user = $_SESSION['userlogin'];

$matricRet = 0;
$nomeRet = '';
$statusRet = 1;
$codigoRet = 0;

$nivelRet1 = 0;
$nivelRet2 = 0;
$nivelRet3 = 0;
$nivelRet4 = 0;
$nivelRet5 = 0;
$nivelRet6 = 0;
$nivelRet7 = 0;
$nivelRet8 = 0;
$nivelRet9 = 0;
$nivelRet10 = 0;
$nivelRet11 = 0;
$nivelRet12 = 0;

if ($status == 'update'){

    $codigoRet = $idUsuario;

    $read = new Read;
    $read->ExeReadMod("SELECT "
                        . " SUC.CODIGO "
                        . " , SUC.MATRICULA "
                        . " , CORR.NOME AS NOME "
                        . " , SUC.STATUS "
                    . " FROM "
                        . " SITE_USUARIO_COLABORADOR SUC "
                        . " , COLAB COLAB "
                        . " , CORR CORR "
                    . " WHERE "
                        . " SUC.CODIGO = " . $idUsuario
                        . " AND "
                        . " SUC.MATRICULA = COLAB.CD "
                        . " AND "
                        . " COLAB.CORR_ID = CORR.CORR_ID ");

    if ($read->getResult()){

        foreach ($read->getResult() as $usuario){
            
            extract($usuario);
            $matricRet = $MATRICULA;
            $nomeRet = $NOME;
            $statusRet = $STATUS;

        }

    }
    
    $read->ExeReadMod("SELECT "
                        . " COD_NIVEL "
                    . " FROM "
                        . " SITE_R_COLABORADOR_NIVEL "
                    . " WHERE "
                        . " COD_COLABORADOR = " . $idUsuario);

    foreach ($read->getResult() as $usuario){
        
        extract($usuario);
        switch ($COD_NIVEL) {
            case 1:
                $nivelRet1 = 1;
                break;
            case 2:
                $nivelRet2 = 1;
                break;
            case 3:
                $nivelRet3 = 1;
                break;
            case 4:
                $nivelRet4 = 1;
                break;
            case 5:
                $nivelRet5 = 1;
                break;
            case 6:
                $nivelRet6 = 1;
                break;
            case 7:
                $nivelRet7 = 1;
                break;
            case 8:
                $nivelRet8 = 1;
                break;
            case 9:
                $nivelRet9 = 1;
                break;
            case 10:
                $nivelRet10 = 1;
                break;
            case 11:
                $nivelRet11 = 1;
                break;
            case 12:
                $nivelRet12 = 1;
                break;
        }

    }

}
elseif ($status == 'create'){

    $read = new Read;
    $read->ExeReadMod("SELECT "
                        . " MAX(CODIGO) AS CODIGO "
                    . " FROM "
                        . " SITE_USUARIO_COLABORADOR ");

    if ($read->getResult()){

        foreach ($read->getResult() as $usuario){
            extract($usuario);
            $codigoRet = $CODIGO + 1;
        }

    }

}
?>
<div class="form_create">

    <h1 class="title_crud">EDIÇÃO DE COLADORADOR</h1>

    <div class="content">

        <form action="painel.php?exe=colaborador/index&status=<?= $status; ?><?= ($status == 'update' ? '&idusuario=' . $idUsuario . '' : '') ?>" method = "post" name="form">

            <input type="hidden" name="CODIGO" value="<?= $codigoRet; ?>" />
            <input type="hidden" name="DATA" value="<?= date('d/m/Y H:i:s'); ?>" />

            <div class="label_line">
                <label  class="label_larger" for="browser">
                    <span class="field">Funcionário:</span>
                    <input list="funcionarios" <?= ($matricRet > 0 ? 'value="' . $matricRet . ' - ' . $nomeRet . '" disabled' : '') ?> name="MATRICULA" id="MATRICULA">
                    <datalist id="funcionarios">
                    <?php              

                        $read = new Read;
                        $read->ExeReadMod(" SELECT "
                                            . " COLAB.CD AS MATRIC "
                                            . " , CORR.NOME AS NOME "
                                        . " FROM "
                                            . " COLAB COLAB "
                                            . " , CORR CORR "
                                            . " , REG_DEMIS DEM "
                                        . " WHERE "
                                            . " COLAB.CD > 10000 "
                                            . " AND COLAB.CORR_ID = CORR.CORR_ID "
                                            . " AND DEM.COLAB_ID IS NULL "
                                            . " AND COLAB.COLAB_ID = DEM.COLAB_ID(+) "
                                        . " ORDER BY CORR.NOME ASC ");

                        if ($read->getResult()):

                            foreach ($read->getResult() as $usuario):
                                extract($usuario);
                        ?>
                            <option value="<?php echo $MATRIC . ' - ' . $NOME; ?>">      
                        <?php
                            endforeach;

                        endif;

                    ?>

                    </datalist>
                </label>
            </div>
            
            <div class="label_line">
                <label class="label_medium">
                    <span class="field">Status:</span>
                    <select name = "STATUS" required >
                        <option value = "1" <?= ($statusRet == 1 ? 'selected="selected"' : '') ?>>ATIVO</option>
                        <option value="2" <?= ($statusRet == 2 ? 'selected="selected"' : '') ?>>INATIVO</option>
                    </select>
                </label>
            </div>
            
            <div class="label_line">
                
                <span class="field">Nível:</span>
                
                <?php
                
                    $nivelRetUsu1 = 0;
                    $nivelRetUsu2 = 0;
                    $nivelRetUsu3 = 0;
                    $nivelRetUsu4 = 0;
                    $nivelRetUsu5 = 0;
                    $nivelRetUsu6 = 0;
                    $nivelRetUsu7 = 0;
                    $nivelRetUsu8 = 0;
                    $nivelRetUsu9 = 0;
                    $nivelRetUsu10 = 0;
                    $nivelRetUsu11 = 0;
                    $nivelRetUsu12 = 0;

                    $read = new Read;
                    $read->ExeReadMod(" SELECT "
                                            . " SRCN.COD_NIVEL AS COD_NIVEL "
                                        . " FROM "
                                            . " SITE_USUARIO_COLABORADOR SUC "
                                            . " , SITE_R_COLABORADOR_NIVEL SRCN "
                                            . " , SITE_NIVEL_USUARIO SNU "
                                        . " WHERE "
                                            . " SUC.MATRICULA = " . $user['MATRICULA']
                                            . " AND "
                                            . " SRCN.COD_COLABORADOR = SUC.CODIGO "
                                            . " AND "
                                            . " SRCN.COD_NIVEL = SNU.CODIGO ");

                    foreach ($read->getResult() as $ret){

                        extract($ret);
                        switch ($COD_NIVEL) {
                            case 1:
                                $nivelRetUsu1 = 1;
                                break;
                            case 2:
                                $nivelRetUsu2 = 1;
                                break;
                            case 3:
                                $nivelRetUsu3 = 1;
                                break;
                            case 4:
                                $nivelRetUsu4 = 1;
                                break;
                            case 5:
                                $nivelRetUsu5 = 1;
                                break;
                            case 6:
                                $nivelRetUsu6 = 1;
                                break;
                            case 7:
                                $nivelRetUsu7 = 1;
                                break;
                            case 8:
                                $nivelRetUsu8 = 1;
                                break;
                            case 9:
                                $nivelRetUsu9 = 1;
                                break;
                            case 10:
                                $nivelRetUsu10 = 1;
                                break;
                            case 11:
                                $nivelRetUsu11 = 1;
                                break;
                            case 12:
                                $nivelRetUsu12 = 1;
                                break;
                        }

                    }
                
                    if ($nivelRetUsu1 == 1) {
                ?>

                <div class="div_small">
                    <input type="checkbox" id="opcao1" name="opcao1" value="1" <?= ($nivelRet1 == 1 ? 'checked' : '') ?>>
                    <label for="opcao1">ADMINISTRADOR</label><br>
                    <input type="checkbox" id="opcao2" name="opcao2" value="2" <?= ($nivelRet2 == 1 ? 'checked' : '') ?>>
                    <label for="opcao2">ADM. FINANCEIRO</label><br>
                    <input type="checkbox" id="opcao3" name="opcao3" value="3" <?= ($nivelRet3 == 1 ? 'checked' : '') ?>>
                    <label for="opcao3">USU. FINANCEIRO</label><br>
                    <input type="checkbox" id="opcao4" name="opcao4" value="4" <?= ($nivelRet4 == 1 ? 'checked' : '') ?>>
                    <label for="opcao4">ADM. CONTRATAÇÃO</label><br>
                </div>
                
                <div class="div_small">
                    <input type="checkbox" id="opcao5" name="opcao5" value="5" <?= ($nivelRet5 == 1 ? 'checked' : '') ?>>
                    <label for="opcao5">USU. CONTRATAÇÃO</label><br>
                    <input type="checkbox" id="opcao6" name="opcao6" value="6" <?= ($nivelRet6 == 1 ? 'checked' : '') ?>>
                    <label for="opcao6">ADM. NOTÍCIA</label><br>
                    <input type="checkbox" id="opcao7" name="opcao7" value="7" <?= ($nivelRet7 == 1 ? 'checked' : '') ?>>
                    <label for="opcao7">USU. NOTÍCIA</label><br>
                    <input type="checkbox" id="opcao8" name="opcao8" value="8" <?= ($nivelRet8 == 1 ? 'checked' : '') ?>>
                    <label for="opcao8">ADM. GOVERNANÇA</label><br>
                </div>
                
                <div class="div_small">
                    <input type="checkbox" id="opcao9" name="opcao9" value="9" <?= ($nivelRet9 == 1 ? 'checked' : '') ?>>
                    <label for="opcao9">USU. GOVERNANÇA</label><br>
                    <input type="checkbox" id="opcao10" name="opcao10" value="10" <?= ($nivelRet10 == 1 ? 'checked' : '') ?>>
                    <label for="opcao10">ADM. POLITICA DE RH</label><br>
                    <input type="checkbox" id="opcao11" name="opcao11" value="11" <?= ($nivelRet11 == 1 ? 'checked' : '') ?>>
                    <label for="opcao11">USU. POLITICA DE RH</label><br>
                    <input type="checkbox" id="OPCAO12" name="OPCAO12" value="12" <?= ($nivelRet12 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO12">ADM. REL. PÚBLICO</label><br>
                </div>
                <?php
                    } elseif ($nivelRetUsu2 == 1) {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao2" name="opcao2" value="2" <?= ($nivelRet2 == 1 ? 'checked' : '') ?>>
                    <label for="opcao2">ADM. FINANCEIRO</label><br>
                    <input type="checkbox" id="opcao3" name="opcao3" value="3" <?= ($nivelRet3 == 1 ? 'checked' : '') ?>>
                    <label for="opcao3">USU. FINANCEIRO</label><br>
                </div>
                <?php
                    } elseif ($nivelRetUsu4 == 1) {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao4" name="opcao4" value="4" <?= ($nivelRet4 == 1 ? 'checked' : '') ?>>
                    <label for="opcao4">ADM. CONTRATAÇÃO</label><br>
                    <input type="checkbox" id="opcao5" name="opcao5" value="5" <?= ($nivelRet5 == 1 ? 'checked' : '') ?>>
                    <label for="opcao5">USU. CONTRATAÇÃO</label><br>
                </div>
                <?php
                    } elseif ($nivelRetUsu6 == 1) {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao6" name="opcao6" value="6" <?= ($nivelRet6 == 1 ? 'checked' : '') ?>>
                    <label for="opcao6">ADM. NOTÍCIA</label><br>
                    <input type="checkbox" id="opcao7" name="opcao7" value="7" <?= ($nivelRet7 == 1 ? 'checked' : '') ?>>
                    <label for="opcao7">USU. NOTÍCIA</label><br>
                </div>
                <?php
                    } elseif ($nivelRetUsu8 == 1) {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao8" name="opcao8" value="8" <?= ($nivelRet8 == 1 ? 'checked' : '') ?>>
                    <label for="opcao8">ADM. GOVERNANÇA</label><br>
                    <input type="checkbox" id="opcao9" name="opcao9" value="9" <?= ($nivelRet9 == 1 ? 'checked' : '') ?>>
                    <label for="opcao9">USU. GOVERNANÇA</label><br>
                </div>
                <?php
                    } elseif ($nivelRetUsu10 == 1) {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao10" name="opcao10" value="10" <?= ($nivelRet10 == 1 ? 'checked' : '') ?>>
                    <label for="opcao10">ADM. POLITICA DE RH</label><br>
                    <input type="checkbox" id="opcao11" name="opcao11" value="11" <?= ($nivelRet11 == 1 ? 'checked' : '') ?>>
                    <label for="opcao11">USU. POLITICA DE RH</label><br>
                </div>
                <?php
                    } elseif ($nivelRetUsu12 == 1) {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao12" name="opcao12" value="12" <?= ($nivelRet12 == 1 ? 'checked' : '') ?>>
                    <label for="opcao12">ADM. JURÍDICO</label><br>
                    <input type="checkbox" id="opcao13" name="opcao13" value="13" <?= ($nivelRet13 == 1 ? 'checked' : '') ?>>
                    <label for="opcao13">USU. JURÍDICO</label><br>
                </div>
                <?php
                    }
                ?>
            </div>

            <div class="label_line botoes">
                <input type="submit" class="btn blue" value="Salvar" name="SendPostForm" />
                <input type="button" onclick="window.location.href = 'painel.php?exe=colaborador/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
            </div>
        </form>

    </div>
    <div class="clear"></div>
</div>
