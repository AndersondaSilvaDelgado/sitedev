<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <!--<div class="acesso_relatorio">-->

    <div class="form_acesso_portal_gov">

        <div class="msg_acesso_portal_gov">
            Acesso Negado! Por Favor, verifique se o usuário, a senha e/ou token foram digitados corretamente. Em caso de dúvida entre em contato com o departamento de TI da empresa.
            <div class="clear"></div>
        </div>

        <form name="LoginPortalGovernanca" class="loginPortalGovernanca" action="" method="post">

            <h1><?= ($idioma == 1) ? 'Portal de Governança' : 'Portal de Governança'; ?></h1>

            <label>
                <span><?= ($idioma == 1) ? 'Usuário:' : 'User:'; ?></span>
                <input id="usuario_gov"  type="usuario" name="user" />
            </label>

            <label>
                <span><?= ($idioma == 1) ? 'Senha:' : 'Password:'; ?></span>
                <input id="senha_gov"  type="password" name="pass" />
            </label>  

            <label class="acesso_token">
                <span><?= ($idioma == 1) ? 'Token:' : 'Token:'; ?></span>
                <input id="token_gov" name="token" />
            </label>  

            <div class="botao_relatorio">
                <input type="submit" name="LoginPortalGovernanca" value="<?= ($idioma == 1) ? 'Acessar' : 'Access'; ?>" class="btn" />
                <input type="button" onclick="window.location.href = 'index.php?exe=index'; return false;" name="<?= ($idioma == 1) ? 'Cancelar' : 'Cancel'; ?>" value="<?= ($idioma == 1) ? 'Cancelar' : 'Cancel'; ?>" class="btn" />
            </div>

        </form>

    </div>

    <!--</div>-->

    <div class="clear"></div>

</main>
