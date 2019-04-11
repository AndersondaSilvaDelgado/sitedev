<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Usina Santa Fé S.A.</title>

        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/boot.css" />
        <link rel="stylesheet" href="css/style.css?v=1" />
        <link rel="stylesheet" href="css/styleresp.css?v=1" />
        <link rel="shortcut icon" href="icons/aguia.ico"/>

    </head>
    <body class="login">

        <div class="acesso_relatorio">

            <div class="form_acesso_relatorio">

                <?php
                $login = new Login();

                $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($dataLogin['LoginRelatorio'])):

                    $login->ExeLogin($dataLogin);
                    if (!$login->getResult()):
                        ?>

                        <div class="msg_acesso_relatorio">
                            Acesso Negado! Favor verifique se o usuário e a senha foram digitados corretamente. Caso de dúvida entre em contato com a TI.
                            <div class="clear"></div>
                        </div>

                        <?php
                    else:

                        $usuario = (string) strip_tags(trim($dataLogin['user']));

                        $read = new Read;
                        $read->ExeReadMod("SELECT * FROM SITE_USUARIO_RELATORIO WHERE USUARIO LIKE '{$usuario}' AND NIVEL = 2");
                        if (!$read->getResult()):
                            ?>

                            <div class="msg_acesso_relatorio">
                                Acesso Negado! Desculpe <?= strtoupper($usuario); ?>, você não tem permissão para acessar esta área!
                                <div class="clear"></div>
                            </div>

                            <?php
                        else:

                            if (!session_id()):
                                session_start();
                            endif;

                            $_SESSION['userlogin'] = $read->getResult()[0];
                            header('Location: painel.php');

                        endif;

                    endif;

                endif;
                ?>

                <form name="LoginRelatorioForm" action="" method="post">

                    <label>
                        <span>Usuário:</span>
                        <input type="usuario" name="user" />
                    </label>

                    <label>
                        <span>Senha:</span>
                        <input type="password" name="pass" />
                    </label>  

                    <div class="botao_relatorio">
                        <input type="submit" name="LoginRelatorio" value="Acessar" class="botao" />
                        <input type="button" onclick="window.location.href = 'index.php?exe=index'; return false;" name="Cancelar" value="Cancelar" class="botao" />
                    </div>

                </form>

            </div>

        </div>

    </body>
</html>
<?php
ob_end_flush();





