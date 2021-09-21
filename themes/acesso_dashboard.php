<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <!--<div class="acesso_relatorio">-->

    <div class="form_acesso_relatorio">

        <?php
        $login = new Login();

        $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($dataLogin['LoginRelatorio'])):

            $login->ExeLogin($dataLogin);
            if (!$login->getResult()):
                ?>

                <div class="msg_acesso_relatorio">
                    Acesso Negado! Por Favor, verifique se o usuário e a senha foram digitados corretamente. Em caso de dúvida entre em contato com o departamento de TI da empresa.
                    <div class="clear"></div>
                </div>

                <?php
            else:

                $usuario = (string) strip_tags(trim($dataLogin['user']));

                $read = new Read;
                $read->ExeReadMod("SELECT * FROM SITE_USUARIO_NV WHERE USUARIO LIKE '{$usuario}' AND NIVEL NOT IN ('BANCÁRIO', 'USU. POL. DE RH')");
                if (!$read->getResult()):
                    ?>

                    <div class="msg_acesso_relatorio">
                        Acesso Negado! Por Favor, verifique se o usuário e a senha foram digitados corretamente. Em caso de dúvida entre em contato com o departamento de TI da empresa.
                        <div class="clear"></div>
                    </div>

                    <?php
                else:

                    if (!session_id()):
                        session_start();
                    endif;

                    $_SESSION['userlogin'] = $read->getResult()[0];
                    header('Location: admin/painel.php');

                endif;

            endif;

        endif;
        ?>

        <form name="LoginRelatorioForm" action="" method="post">

            <h1><?= ($idioma == 1) ? 'Configuração' : 'Configuration'; ?></h1>

            <label>
                <span><?= ($idioma == 1) ? 'Usuário:' : 'User:'; ?></span>
                <input type="usuario" name="user" />
            </label>

            <label>
                <span><?= ($idioma == 1) ? 'Senha:' : 'Password:'; ?></span>
                <input type="password" name="pass" />
            </label>  

            <div class="botao_relatorio">
                <input type="submit" name="LoginRelatorio" value="<?= ($idioma == 1) ? 'Acessar' : 'Access'; ?>" class="btn" />
                <input type="button" onclick="window.location.href = 'index.php?exe=index'; return false;" name="<?= ($idioma == 1) ? 'Cancelar' : 'Cancel'; ?>" value="<?= ($idioma == 1) ? 'Cancelar' : 'Cancel'; ?>" class="btn" />
            </div>

        </form>

    </div>

    <!--</div>-->

    <div class="clear"></div>

</main>
