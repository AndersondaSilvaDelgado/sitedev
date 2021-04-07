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

                <label class="label_medium">
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
                        disabled
                        />
                </label>

            </div>
            
            <div class="label_line">
                
                <span class="field">Nível:</span>
                
                <?php
                    if ($user['NIVEL'] == 'ADMINISTRADOR') {
                ?>

                <div class="div_small">
                    <input type="checkbox" id="opcao1" name="opcao1" value="1">
                    <label for="opcao1">ADMINISTRADOR</label><br>
                    <input type="checkbox" id="opcao2" name="opcao2" value="2">
                    <label for="opcao2">ADM. FINANCEIRO</label><br>
                    <input type="checkbox" id="opcao3" name="opcao3" value="3">
                    <label for="opcao3">USU. FINANCEIRO</label><br>
                    <input type="checkbox" id="opcao4" name="opcao4" value="4">
                    <label for="opcao4">ADM. CONTRATAÇÃO</label><br>
                </div>
                
                <div class="div_small">
                    <input type="checkbox" id="opcao5" name="opcao5" value="5">
                    <label for="opcao5">USU. CONTRATAÇÃO</label><br>
                    <input type="checkbox" id="opcao6" name="opcao6" value="6">
                    <label for="opcao6">ADM. NOTÍCIA</label><br>
                    <input type="checkbox" id="opcao7" name="opcao7" value="7">
                    <label for="opcao7">USU. NOTÍCIA</label><br>
                    <input type="checkbox" id="opcao8" name="opcao8" value="8">
                    <label for="opcao8">ADM. GOVERNANÇA</label><br>
                </div>
                
                <div class="div_small">
                    <input type="checkbox" id="opcao9" name="opcao9" value="9">
                    <label for="opcao9">USU. GOVERNANÇA</label><br>
                    <input type="checkbox" id="opcao10" name="opcao10" value="10">
                    <label for="opcao10">ADM. POLITICA DE RH</label><br>
                    <input type="checkbox" id="opcao11" name="opcao11" value="11">
                    <label for="opcao11">USU. POLITICA DE RH</label><br>
                </div>
                <?php
                    } elseif ($user['NIVEL'] == 'FINANCEIRO') {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao2" name="opcao2" value="2">
                    <label for="opcao2">ADM. FINANCEIRO</label><br>
                    <input type="checkbox" id="opcao3" name="opcao3" value="3">
                    <label for="opcao3">USU. FINANCEIRO</label><br>
                </div>
                <?php
                    } elseif ($user['NIVEL'] == 'CONTRATAÇÃO') {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao4" name="opcao4" value="4">
                    <label for="opcao4">ADM. CONTRATAÇÃO</label><br>
                    <input type="checkbox" id="opcao5" name="opcao5" value="5">
                    <label for="opcao5">USU. CONTRATAÇÃO</label><br>
                </div>
                <?php
                    } elseif ($user['NIVEL'] == 'NOTÍCIA') {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao6" name="opcao6" value="6">
                    <label for="opcao6">ADM. NOTÍCIA</label><br>
                    <input type="checkbox" id="opcao7" name="opcao7" value="7">
                    <label for="opcao7">USU. NOTÍCIA</label><br>
                </div>
                <?php
                    } elseif ($user['NIVEL'] == 'ADM. POL. DE RH') {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao8" name="opcao8" value="8">
                    <label for="opcao8">ADM. GOVERNANÇA</label><br>
                    <input type="checkbox" id="opcao9" name="opcao9" value="9">
                    <label for="opcao9">USU. GOVERNANÇA</label><br>
                </div>
                <?php
                    } elseif ($user['NIVEL'] == 'ADM. GOVERNANÇA') {
                ?>
                <div class="div_small">
                    <input type="checkbox" id="opcao10" name="opcao10" value="10">
                    <label for="opcao10">ADM. POLITICA DE RH</label><br>
                    <input type="checkbox" id="opcao11" name="opcao11" value="11">
                    <label for="opcao11">USU. POLITICA DE RH</label><br>
                </div>
                <?php
                    }
                ?>
            </div>

            <div class="label_line botoes">
                <input type="submit" class="btn blue" value="Salvar" name="SendPostForm" />
                <input type="button" onclick="window.location.href = 'painel.php?exe=usuario/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
            </div>
        </form>

    </div>
    <div class="clear"></div>
</div> <!-- content home -->
