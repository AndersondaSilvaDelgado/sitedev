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

            $sqlColab = " SELECT "
                        . " COLAB.CD AS MATRICULA "
                        . " , SRCN.COD_NIVEL AS NIVEL "
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
                        . " SRCN.COD_NIVEL IN (1, 2, 3, 8, 9) "
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
            
            $readColab = new Read;
            $readColab->ExeReadMod($sqlColab);
            
            $sqlTerc = " SELECT "
                        . " SUT.CODIGO AS CODIGO "
                        . " , SUT.SENHA AS SENHA "
                    . " FROM "
                        . " SITE_USUARIO_TERCEIRO SUT "
                        . " , SITE_R_TERCEIRO_NIVEL SRTN "
                    . " WHERE "
                        . " UPPER(SUT.USUARIO) LIKE UPPER('" . $usuario . "') "
                        . " AND "
                        . " SUT.STATUS = 1"
                        . " AND "
                        . " SRTN.COD_NIVEL IN (1, 2, 3, 8, 9) "
                        . " AND "
                        . " SUT.CODIGO = SRTN.COD_TERCEIRO ";
            
            $readTerc = new Read;
            $readTerc->ExeReadMod($sqlTerc);
            
            if(!$readColab->getResult() && !$readTerc->getResult()){
                ?>

                <div class="msg_acesso_relatorio">
                    Acesso Negado! Por Favor, verifique se o usuário e a senha foram digitados corretamente. Em caso de dúvida entre em contato com o departamento de TI da empresa.
                    <div class="clear"></div>
                </div>

                <?php
            }
            else{
                
                if($readTerc->getResult()){
                
                    ?>

                    <div class="msg_acesso_relatorio">
                        CHEGOU AKI 1
                        <div class="clear"></div>
                    </div>

                    <?php
                    
                    foreach ($readTerc->getResult() as $dados){
                    
                        if ($senha != $dados['SENHA']){

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

                            $_SESSION['userlogin'] = $read->getResult()[0];
                            header('Location: index.php?exe=relacao');

                        }
                    
                    }
                    
                }
                else{
                    
                    ?>

                    <div class="msg_acesso_relatorio">
                        CHEGOU AKI
                        <div class="clear"></div>
                    </div>

                    <?php
                    
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
                        header('Location: index.php?exe=relacao');

                    }
                    
                }
                
            }
            
        }

        ?>

        <form name="LoginRelatorioForm" action="" method="post">

            <h1><?= ($idioma == 1) ? 'Relação com Instituições Financeiras' : 'Relations with Financial Institutions'; ?></h1>

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
