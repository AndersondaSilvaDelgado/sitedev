<?php
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$usuario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$idUsuario = filter_input(INPUT_GET, 'idusuario', FILTER_VALIDATE_INT);

$user = $_SESSION['userlogin'];

require_once '_models/AdminUsuario.class.php';
$adminUsuario = new AdminUsuario;
$campoPesq = '';

if (isset($usuario)):

    if ($status):

        switch ($status):

            case 'create':
                unset($usuario['SendPostForm']);
                $adminUsuario->ExeCreateColaborador($usuario);
                break;

            case 'update':
                unset($usuario['SendPostForm']);
                $adminUsuario->ExeUpdateColaborador($idUsuario, $usuario);
                break;

            case 'pesq':
                $campoPesq = $usuario['PESQUISA'];
                break;

        endswitch;

    endif;

endif;

if (isset($status) && ($status == 'delete')):

    $adminUsuario->ExeDeleteColaborador($idUsuario);

endif;
?>
<div class="form_create">

    <h1 class="title_crud">COLADORADOR</h1>

    <div class="content">

        <div class="label_line">
            <label class="label_botao_inicial">
                <input type="button" onclick="window.location.href = 'painel.php?exe=colaborador/edit&status=create'; return false;" class="btn green" value="Inserir" />
            </label>
            <form action="painel.php?exe=colaborador/index&status=pesq" method = "post" name="form">
                <label class="label_pesq_inicial">
                    <input name="PESQUISA" value="" placeholder="PESQUISAR"/>
                </label>
                <label class="label_botao_inicial">
                    <input type="submit" class="btn cinza" value="pesquisar" id="find"/>
                </label>
            </form>
        </div>

        <ul class="ultable">
            <li class="t_title">
                <span class="cod_usuario center">Codigo</span>
                <span class="nome_usuario">Matricula</span>
                <span class="nome_compl_usuario">Nome</span>
                <span class="nivel_usuario center">Nível</span>
                <span class="ed center">-</span>
            </li>

            <?php
            $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            $Pager = new Pager('painel.php?exe=colaborador/index&page=');
            $Pager->ExePager($getPage, 11);

            $inicial = $Pager->getOffset();
            $final = $Pager->getLimit() + $Pager->getOffset();
              
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
            
            $sqlwhere = "";
            
            if($nivelRet1 == 0){
                
                $sqlwhere = " SRCN.COD_NIVEL IN ( 0 ";
            
                if ($nivelRet2 == 1) {
                    $sqlwhere = $sqlwhere . " , 2, 3 ";
                } 
                elseif ($nivelRet4 == 1) {
                    $sqlwhere = $sqlwhere . " , 4, 5 ";
                } 
                elseif ($nivelRet6 == 1) {
                    $sqlwhere = $sqlwhere . " , 6, 7 ";
                } 
                elseif ($nivelRet8 == 1) {
                    $sqlwhere = $sqlwhere . " , 8, 9 ";
                } 
                elseif ($nivelRet10 == 1) {
                    $sqlwhere = $sqlwhere . " , 10, 11 ";
                } 
                elseif ($nivelRet12 == 1) {
                    $sqlwhere = $sqlwhere . " , 12, 13 ";
                }
            
                $sqlwhere = $sqlwhere . " ) AND ";
                
            }
                                
            $sql = " SELECT "
                        . " SUC.CODIGO AS CODIGO "
                        . " , SUC.MATRICULA AS MATRICULA "
                        . " , CORR.NOME AS NOME"
                        . " , SNU.DESCRICAO AS NIVEL "
                    . " FROM "
                        . " SITE_USUARIO_COLABORADOR SUC "
                        . " , SITE_R_COLABORADOR_NIVEL SRCN "
                        . " , SITE_NIVEL_USUARIO SNU "
                        . " , COLAB COLAB "
                        . " , CORR CORR "
                    . " WHERE "
                        . " " . $sqlwhere
                        . " SUC.MATRICULA = COLAB.CD "
                        . " AND "
                        . " COLAB.CORR_ID = CORR.CORR_ID "
                        . " AND "
                        . " SRCN.COD_COLABORADOR = SUC.CODIGO "
                        . " AND "
                        . " SRCN.COD_NIVEL = SNU.CODIGO "
                    . " ORDER BY "
                        . " CORR.NOME "
                    . " ASC ";

            $read->ExeReadMod($sql);

            $i = 0;
            if ($read->getResult()):
                foreach ($read->getResult() as $user):
                    extract($user);
                    if ($i >= $inicial && $i < $final):
                        ?>            
                        <li>
                            <span class="cod_usuario center"><?= $CODIGO; ?></span>
                            <span class="nome_usuario"><?= $MATRICULA; ?></span>
                            <span class="nome_compl_usuario"><?= $NOME; ?></span>
                            <span class="nivel_usuario center"><?= $NIVEL; ?>
                            </span>
                            <span class="ed center">
                                <a href="painel.php?exe=colaborador/edit&status=update&idusuario=<?= $CODIGO; ?>" >
                                    <i class="fa fa-pencil-square-o icon_blue" aria-hidden="true" title="Editar"></i>
                                </a>
                                &nbsp;
                                <a href="#" onclick="confirm_delete('painel.php?exe=colaborador/index&status=delete&idusuario=<?= $CODIGO; ?>');" >
                                    <i class="fa fa-trash icon_red" aria-hidden="true" title="Deletar"></i>
                                </a>
                            </span>
                        </li>
                        <?php
                    endif;
                    $i++;
                endforeach;
            endif;
            ?>

        </ul>

    </div>
    <div class="label_line">
        <?php
        $Pager->ExePaginatorMod($sql);
        echo $Pager->getPaginator();
        ?>
    </div>
</div>
