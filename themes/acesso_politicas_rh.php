<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <!--<div class="acesso_relatorio">-->

    <div class="form_acesso_relatorio">

        <?php
        $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($dataLogin['LoginRelatorio'])){

            $usuario = (string) strip_tags(trim($dataLogin['user']));
            $senha = (string) strip_tags(trim($dataLogin['pass']));

            $sql = " SELECT "
                        . " COLAB.CD AS MATRICULA "
                    . " FROM "
                        . " STF_SPEC.STF_USUARIO@STAFE_PRD SU "
                        . " , SITE_USUARIO_COLABORADOR SUC "
                        . " , SITE_R_COLABORADOR_NIVEL SRCN "
                        . " , COLAB COLAB "
                        . " , CORR CORR "
                        . " , REG_DEMIS DEM " 
                    . " WHERE "
                        . " UPPER(SU.LOGIN) LIKE UPPER('" . $usuario . "') "
                        . " AND "
                        . " SUC.STATUS = 1"
                        . " AND "
                        . " SRCN.COD_NIVEL IN (1, 6, 7, 10, 11) "
                        . " AND "
                        . " SUC.MATRICULA = COLAB.CD "
                        . " AND "
                        . " CORR.NOME LIKE UPPER(SU.NOME) "
                        . " AND "
                        . " COLAB.CORR_ID = CORR.CORR_ID "
                        . " AND "
                        . " DEM.COLAB_ID IS NULL " 
                        . " AND "
                        . " COLAB.COLAB_ID = DEM.COLAB_ID(+) "
                        . " AND "
                        . " SRCN.COD_COLABORADOR = SUC.CODIGO ";
            
            $read = new Read;
            $read->ExeReadMod($sql);
            if (!$read->getResult()){
                ?>

                <div class="msg_acesso_relatorio">
                    Acesso Negado! Por Favor, verifique se o usuário e a senha foram digitados corretamente. Em caso de dúvida entre em contato com o departamento de TI da empresa.
                    <div class="clear"></div>
                </div>

                <?php
                
            }else{

                foreach ($read->getResult() as $dados){

                    $login = new Login();
                    $login->ExeLogin($dataLogin);

                    if (!$login->getResult()){
                        
                        ?>

                        <div class="msg_acesso_relatorio">
                            Acesso Negado! Por Favor, verifique se o usuário e a senha foram digitados corretamente. Em caso de dúvida entre em contato com o departamento de TI da empresa.
                            <div class="clear"></div>
                        </div>

                        <?php
                        
                    } else {

                        if (!session_id()){
                            session_start();
                        }

                        $_SESSION['userlogin'] = $dados;
                        header('Location: index.php?exe=politicas_rh');

                    }

                }

            }

        }
        ?>

        <form name="LoginRelatorioForm" action="" method="post">

            <h1><?= ($idioma == 1) ? 'Políticas de RH' : 'Políticas de RH'; ?></h1>

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

    <div class="clear"></div>

</main>
