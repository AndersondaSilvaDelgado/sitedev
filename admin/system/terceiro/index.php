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
                $adminUsuario->ExeCreateTerceiro($usuario);
                break;

            case 'update':
                unset($usuario['SendPostForm']);
                $adminUsuario->ExeUpdateTerceiro($idUsuario, $usuario);
                break;

            case 'pesq':
                $campoPesq = $usuario['PESQUISA'];
                break;

        endswitch;

    endif;

endif;

if (isset($status) && ($status == 'delete')):
    $adminUsuario->ExeDeleteTerceiro($idUsuario);
endif;
?>
<div class="form_create">

    <h1 class="title_crud">TERCEIRO</h1>

    <div class="content">

        <div class="label_line">
            <label class="label_botao_inicial">
                <input type="button" onclick="window.location.href = 'painel.php?exe=terceiro/edit&status=create'; return false;" class="btn green" value="Inserir" />
            </label>
            <form action="painel.php?exe=terceiro/index&status=pesq" method = "post" name="form">
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
                <span class="nome_usuario">Usuário</span>
                <span class="nome_compl_usuario">Nome</span>
                <span class="nivel_usuario center">Instituição</span>
                <span class="ed center">-</span>
            </li>

            <?php
            
            $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            $Pager = new Pager('painel.php?exe=terceiro/index&page=');
            $Pager->ExePager($getPage, 11);

            $inicial = $Pager->getOffset();
            $final = $Pager->getLimit() + $Pager->getOffset();

            $read = new Read;

            $sql = 'SELECT '
                        . ' SUT.CODIGO AS CODIGO '
                        . ' , SUT.USUARIO AS USUARIO '
                        . ' , SUT.NOME AS NOME '
                        . ' , SUT.INSTITUICAO AS INSTITUICAO '
                    . ' FROM '
                        . ' SITE_USUARIO_TERCEIRO SUT '
                    . ' ORDER BY '
                        . ' SUT.CODIGO '
                    . ' DESC ';
            
            $read->ExeReadMod($sql);

            $i = 0;
            if ($read->getResult()):
                foreach ($read->getResult() as $user):
                    extract($user);
                    if ($i >= $inicial && $i < $final):
                        ?>            
                        <li>
                            <span class="cod_usuario center"><?= $CODIGO; ?></span>
                            <span class="nome_usuario"><?= $USUARIO; ?></span>
                            <span class="nome_compl_usuario"><?= $NOME; ?></span>
                            <span class="nivel_usuario center"><?= $INSTITUICAO; ?></span>
                            <span class="ed center">
                                <a href="painel.php?exe=terceiro/edit&status=update&idusuario=<?= $CODIGO; ?>" >
                                    <i class="fa fa-pencil-square-o icon_blue" aria-hidden="true" title="Editar"></i>
                                </a>
                                &nbsp;
                                <a href="#" onclick="confirm_delete('painel.php?exe=terceiro/index&status=delete&idusuario=<?= $CODIGO; ?>');" >
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
