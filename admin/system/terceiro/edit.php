<?php
$idUsuario = filter_input(INPUT_GET, 'idusuario', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);

$user = $_SESSION['userlogin'];

$nomeRet = '';
$instituicaoRet = '';
$usuarioRet = '';
$emailRet = '';
$senhaRet = '';
$classeRet = 1;
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
                        . " SUT.NOME "
                        . " , SUT.INSTITUICAO "
                        . " , SUT.USUARIO "
                        . " , SUT.EMAIL "
                        . " , SUT.SENHA "
                        . " , SUT.CLASSE "
                        . " , SUT.STATUS "
                    . " FROM "
                        . " SITE_USUARIO_TERCEIRO SUT "
                    . " WHERE "
                        . " SUT.CODIGO = " . $idUsuario);

    foreach ($read->getResult() as $usuario){
        
        extract($usuario);

        $nomeRet = $NOME;
        $instituicaoRet = $INSTITUICAO;
        $usuarioRet = $USUARIO;
        $emailRet = $EMAIL;
        $senhaRet = $SENHA;
        $classeRet = $CLASSE;
        $statusRet = $STATUS;
        
    }
    
    $read->ExeReadMod("SELECT "
                        . " COD_NIVEL "
                    . " FROM "
                        . " SITE_R_TERCEIRO_NIVEL "
                    . " WHERE "
                        . " COD_TERCEIRO = " . $idUsuario);

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
    $read->ExeReadMod('SELECT '
                        . ' MAX(CODIGO) AS CODIGO '
                    . ' FROM '
                        . ' SITE_USUARIO_TERCEIRO ');

    if ($read->getResult()){

        foreach ($read->getResult() as $usuario){
            extract($usuario);
            $codigoRet = $CODIGO + 1;
        }

    }

}
?>
<div class="form_create">

    <h1 class="title_crud">EDIÇÃO DE TERCEIRO</h1>

    <div class="content">

        <form action="painel.php?exe=terceiro/index&status=<?= $status; ?><?= ($status == 'update' ? '&idusuario=' . $idUsuario . '' : '') ?>" method = "post" name="form">

            <input type="hidden" name="CODIGO" value="<?= $codigoRet; ?>" />
            <input type="hidden" name="DATA" value="<?= date('d/m/Y H:i:s'); ?>" />

            <div class="label_line">
                <label class="label_larger">
                    <span class="field">Nome:</span>
                    <input
                        type = "text"
                        name = "NOME"
                        value="<?= $nomeRet; ?>"
                        required
                        />
                </label>
            </div>

            <div class="label_line">
                <label class="label_larger">
                    <span class="field">E-mail:</span>
                    <input
                        type = "email"
                        name = "EMAIL"
                        value="<?= $emailRet; ?>"
                        required
                        />
                </label>
            </div>

            <div class="label_line">
                <label class="label_larger">
                    <span class="field">Instituição:</span>
                    <input
                        type = "text"
                        name = "INSTITUICAO"
                        value="<?= $instituicaoRet; ?>"
                        required
                        />
                </label>
            </div>

            <div class="label_line">

                <label class="label_medium">
                    <span class="field">Classe:</span>
                    <select name = "CLASSE" required >
                        <option value = "ADV" <?= ($classeRet == 'ADV' ? 'selected="selected"' : '') ?>>ADV</option>
                        <option value = "BANCO" <?= ($classeRet == 'BANCO' ? 'selected="selected"' : '') ?>>BANCO</option>
                        <option value ="FORNECEDOR" <?= ($classeRet == 'FORNECEDOR' ? 'selected="selected"' : '') ?>>FORNECEDOR</option>
                        <option value="OUTROS" <?= ($classeRet == 'OUTROS' ? 'selected="selected"' : '') ?>>OUTROS</option>
                        <option value="TRADING" <?= ($classeRet == 'TRADING' ? 'selected="selected"' : '') ?>>TRADING</option>
                    </select>
                </label>

                <label class="label_medium">
                    <span class="field">Status:</span>
                    <select name = "STATUS" required >
                        <option value = "1" <?= ($statusRet == 1 ? 'selected="selected"' : '') ?>>ATIVO</option>
                        <option value="2" <?= ($statusRet == 2 ? 'selected="selected"' : '') ?>>INATIVO</option>
                    </select>
                </label>

            </div>

            <div class="label_line">
                <label class="label_medium">
                    <span class="field">Usuário:</span>
                    <input
                        type = "text"
                        name = "USUARIO"
                        value="<?= $usuarioRet; ?>"
                        required
                        />
                </label>


                <label class="label_medium">
                    <span class="field">Senha:</span>
                    <input
                        class="senha_form"
                        type = "text"
                        name = "SENHA"
                        value="<?= $senhaRet; ?>"
                        pattern = ".{5,12}"
                        required
                        />
                </label>

            </div>
            
            <div class="label_line">
                
                <span class="field">Nível:</span>
                
                <?php
                    if ($user['NIVEL'] == 'ADMINISTRADOR') {
                ?>

                <div class="div_small">
                    <input type="checkbox" id="OPCAO1" name="OPCAO1" value="1" <?= ($nivelRet1 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO1">ADMINISTRADOR</label><br>
                    <input type="checkbox" id="OPCAO2" name="OPCAO2" value="2" <?= ($nivelRet2 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO2">ADM. FINANCEIRO</label><br>
                    <input type="checkbox" id="OPCAO3" name="OPCAO3" value="3" <?= ($nivelRet3 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO3">USU. FINANCEIRO</label><br>
                    <input type="checkbox" id="OPCAO4" name="OPCAO4" value="4" <?= ($nivelRet4 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO4">ADM. CONTRATAÇÃO</label><br>
                </div>
                
                <div class="div_small">
                    <input type="checkbox" id="OPCAO5" name="OPCAO5" value="5" <?= ($nivelRet5 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO5">USU. CONTRATAÇÃO</label><br>
                    <input type="checkbox" id="OPCAO6" name="OPCAO6" value="6" <?= ($nivelRet6 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO6">ADM. NOTÍCIA</label><br>
                    <input type="checkbox" id="OPCAO7" name="OPCAO7" value="7" <?= ($nivelRet7 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO7">USU. NOTÍCIA</label><br>
                    <input type="checkbox" id="OPCAO8" name="OPCAO8" value="8" <?= ($nivelRet8 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO8">ADM. GOVERNANÇA</label><br>
                </div>
                
                <div class="div_small">
                    <input type="checkbox" id="OPCAO9" name="OPCAO9" value="9" <?= ($nivelRet9 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO9">USU. GOVERNANÇA</label><br>
                    <input type="checkbox" id="OPCAO10" name="OPCAO10" value="10" <?= ($nivelRet10 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO10">ADM. POLITICA DE RH</label><br>
                    <input type="checkbox" id="OPCAO11" name="OPCAO11" value="11" <?= ($nivelRet11 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO11">USU. POLITICA DE RH</label><br>
                    <input type="checkbox" id="OPCAO12" name="OPCAO12" value="12" <?= ($nivelRet12 == 1 ? 'checked' : '') ?>>
                    <label for="OPCAO12">ADM. REL. PÚBLICO</label><br>
                </div>
                <?php
                    } elseif ($user['NIVEL'] == 'FINANCEIRO') {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao2" name="opcao2" value="1">
                    <label for="opcao2">ADM. FINANCEIRO</label><br>
                    <input type="checkbox" id="opcao3" name="opcao3" value="1">
                    <label for="opcao3">USU. FINANCEIRO</label><br>
                </div>
                <?php
                    } elseif ($user['NIVEL'] == 'CONTRATAÇÃO') {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao4" name="opcao4" value="1">
                    <label for="opcao4">ADM. CONTRATAÇÃO</label><br>
                    <input type="checkbox" id="opcao5" name="opcao5" value="1">
                    <label for="opcao5">USU. CONTRATAÇÃO</label><br>
                </div>
                <?php
                    } elseif ($user['NIVEL'] == 'NOTÍCIA') {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao6" name="opcao6" value="1">
                    <label for="opcao6">ADM. NOTÍCIA</label><br>
                    <input type="checkbox" id="opcao7" name="opcao7" value="1">
                    <label for="opcao7">USU. NOTÍCIA</label><br>
                </div>
                <?php
                    } elseif ($user['NIVEL'] == 'ADM. POL. DE RH') {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao8" name="opcao8" value="1">
                    <label for="opcao8">ADM. GOVERNANÇA</label><br>
                    <input type="checkbox" id="opcao9" name="opcao9" value="1">
                    <label for="opcao9">USU. GOVERNANÇA</label><br>
                </div>
                <?php
                    } elseif ($user['NIVEL'] == 'ADM. GOVERNANÇA') {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao10" name="opcao10" value="1">
                    <label for="opcao10">ADM. POLITICA DE RH</label><br>
                    <input type="checkbox" id="opcao11" name="opcao11" value="1">
                    <label for="opcao11">USU. POLITICA DE RH</label><br>
                </div>
                <?php
                    }
                ?>
            </div>

            <div class="label_line botoes">
                <input type="submit" class="btn blue" value="Salvar" name="SendPostForm" />
                <input type="button" onclick="window.location.href = 'painel.php?exe=terceiro/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
            </div>
        </form>

    </div>
    <div class="clear"></div>
</div>
