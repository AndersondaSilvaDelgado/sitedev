<?php
$idUsuario = filter_input(INPUT_GET, 'idusuario', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);

$user = $_SESSION['userlogin'];

$nomeRet = '';
$instituicaoRet = '';
$usuarioRet = '';
$emailRet = '';
$senhaRet = '';
$classeRet = 2;
$nivelRet = 1;
$statusRet = 1;
$codigoRet = 0;

if ($status == 'update'):

    $codigoRet = $idUsuario;

    $read = new Read;
    $read->ExeReadMod('SELECT * FROM SITE_USUARIO_NV WHERE CODIGO = ' . $idUsuario);

    if ($read->getResult()):

        foreach ($read->getResult() as $usuario):
            extract($usuario);

            $nomeRet = $NOME;
            $instituicaoRet = $INSTITUICAO;
            $usuarioRet = $USUARIO;
            $emailRet = $EMAIL;
            $senhaRet = $SENHA;
            $classeRet = $CLASSE;
            $nivelRet = $NIVEL;
            $statusRet = $STATUS;

        endforeach;

    endif;

elseif ($status == 'create'):

    $read = new Read;
    $read->ExeReadMod('SELECT MAX(CODIGO) AS CODIGO FROM SITE_USUARIO_NV');

    if ($read->getResult()):

        foreach ($read->getResult() as $usuario):
            extract($usuario);

            $codigoRet = $CODIGO + 1;

        endforeach;

    endif;

endif;
?>
<div class="form_create">

    <h1 class="title_crud">EDIÇÃO DE USUÁRIOS</h1>

    <div class="content">

        <form action="painel.php?exe=usuario/index&status=<?= $status; ?><?= ($status == 'update' ? '&idusuario=' . $idUsuario . '' : '') ?>" method = "post" name="form">

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
                        value="<?php
                        if ($user['NIVEL'] == 'ADM. POL. DE RH') {
                            echo 'Usina Santa Fé S.A.';
                        } elseif ($user['NIVEL'] == 'ADM. GOVERNANÇA') {
                            echo 'Usina Santa Fé S.A.';
                        } else {
                            echo $instituicaoRet;
                        }
                        ?>"
                        required
                        />
                </label>
            </div>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Nível:</span>
                    <select name = "NIVEL" class="classe_form" required >
                        <?php
                        if ($user['NIVEL'] == 'ADMINISTRADOR') {
                            ?>
                            <option value="ADMINISTRADOR" <?= ($nivelRet == 'ADMINISTRADOR' ? 'selected="selected"' : '') ?>>ADMINISTRADOR</option>
                            <option value="FINANCEIRO" <?= ($nivelRet == 'FINANCEIRO' ? 'selected="selected"' : '') ?>>FINANCEIRO</option>
                            <option value="CONTRATAÇÃO" <?= ($nivelRet == 'CONTRATAÇÃO' ? 'selected="selected"' : '') ?>>CONTRATAÇÃO</option>
                            <option value="NOTÍCIA" <?= ($nivelRet == 'NOTÍCIA' ? 'selected="selected"' : '') ?>>NOTÍCIA</option>
                            <option value = "BANCÁRIO" <?= ($nivelRet == 'BANCÁRIO' ? 'selected="selected"' : '') ?>>BANCÁRIO</option>
                            <option value="USU. PORTAL DE GOVERNANÇA" <?= ($nivelRet == 'USU. PORTAL DE GOVERNANÇA' ? 'selected="selected"' : '') ?>>USU. PORTAL DE GOVERNANÇA</option>
                            <option value="ADM. GOVERNANÇA" <?= ($nivelRet == 'ADM. GOVERNANÇA' ? 'selected="selected"' : '') ?>>ADM. GOVERNANÇA</option>
                            <option value="USU. POL. DE RH" <?= ($nivelRet == 'USU. POL. DE RH' ? 'selected="selected"' : '') ?>>USU. POL. DE RH</option>
                            <option value="ADM. POL. DE RH" <?= ($nivelRet == 'ADM. POL. DE RH' ? 'selected="selected"' : '') ?>>ADM. POL. DE RH</option>
                            <?php
                        } elseif ($user['NIVEL'] == 'FINANCEIRO') {
                            ?>
                            <option value="FINANCEIRO" <?= ($nivelRet == 'FINANCEIRO' ? 'selected="selected"' : '') ?>>FINANCEIRO</option>
                            <option value = "BANCÁRIO" <?= ($nivelRet == 'BANCÁRIO' ? 'selected="selected"' : '') ?>>BANCÁRIO</option>
                            <?php
                        } elseif ($user['NIVEL'] == 'CONTRATAÇÃO') {
                            ?>
                            <option value="CONTRATAÇÃO" <?= ($nivelRet == 'CONTRATAÇÃO' ? 'selected="selected"' : '') ?>>CONTRATAÇÃO</option>
                            <?php
                        } elseif ($user['NIVEL'] == 'NOTÍCIA') {
                            ?>
                            <option value="NOTÍCIA" <?= ($nivelRet == 'NOTÍCIA' ? 'selected="selected"' : '') ?>>NOTÍCIA</option>
                            <?php
                        } elseif ($user['NIVEL'] == 'ADM. POL. DE RH') {
                            ?>
                            <option value="USU. POL. DE RH" <?= ($nivelRet == 'USU. POL. DE RH' ? 'selected="selected"' : '') ?>>USU. POL. DE RH</option>
                            <option value="ADM. POL. DE RH" <?= ($nivelRet == 'ADM. POL. DE RH' ? 'selected="selected"' : '') ?>>ADM. POL. DE RH</option>
                            <?php
                        } elseif ($user['NIVEL'] == 'ADM. GOVERNANÇA') {
                            ?>
                            <option value="USU. PORTAL DE GOVERNANÇA" <?= ($nivelRet == 'USU. PORTAL DE GOVERNANÇA' ? 'selected="selected"' : '') ?>>USU. PORTAL DE GOVERNANÇA</option>
                            <option value="ADM. GOVERNANÇA" <?= ($nivelRet == 'ADM. GOVERNANÇA' ? 'selected="selected"' : '') ?>>ADM. GOVERNANÇA</option>
                            <?php
                        }
                        ?>
                    </select>
                </label>

                <label class="label_small">
                    <span class="field">Classe:</span>
                    <select name = "CLASSE" required >
                        <option value="USINA" <?= ($classeRet == 'USINA' ? 'selected="selected"' : '') ?>>USINA</option>
                        <option value = "ADV" <?= ($classeRet == 'ADV' ? 'selected="selected"' : '') ?>>ADV</option>
                        <option value = "BANCO" <?= ($classeRet == 'BANCO' ? 'selected="selected"' : '') ?>>BANCO</option>
                        <option value ="FORNECEDOR" <?= ($classeRet == 'FORNECEDOR' ? 'selected="selected"' : '') ?>>FORNECEDOR</option>
                        <option value="OUTROS" <?= ($classeRet == 'OUTROS' ? 'selected="selected"' : '') ?>>OUTROS</option>
                        <option value="TRADING" <?= ($classeRet == 'TRADING' ? 'selected="selected"' : '') ?>>TRADING</option>
                    </select>
                </label>

                <label class="label_small">
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
                        disabled
                        />
                </label>

            </div>

            <div class="label_line botoes">
                <input type="submit" class="btn blue" value="Salvar" name="SendPostForm" />
                <input type="button" onclick="window.location.href = 'painel.php?exe=usuario/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
            </div>
        </form>

    </div>
    <div class="clear"></div>
</div> <!-- content home -->
