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
                $adminUsuario->ExeCreate($usuario);
                break;

            case 'update':
                unset($usuario['SendPostForm']);
                $adminUsuario->ExeUpdate($idUsuario, $usuario);
                break;

            case 'pesq':
                $campoPesq = $usuario['PESQUISA'];
                break;

        endswitch;

    endif;

endif;

if (isset($status) && ($status == 'delete')):

    $adminUsuario->ExeDelete($idUsuario);

endif;
?>
<div class="form_create">

    <h1 class="title_crud">USUÁRIOS</h1>

    <div class="content">

        <div class="label_line">
            <label class="label_botao_inicial">
                <input type="button" onclick="window.location.href = 'painel.php?exe=usuario/edit&status=create'; return false;" class="btn green" value="Inserir" />
            </label>
            <form action="painel.php?exe=usuario/index&status=pesq" method = "post" name="form">
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
                <span class="nivel_usuario center">Nível</span>
                <span class="ed center">-</span>
            </li>

            <?php
            $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
            $Pager = new Pager('painel.php?exe=usuario/index&page=');
            $Pager->ExePager($getPage, 11);

            $inicial = $Pager->getOffset();
            $final = $Pager->getLimit() + $Pager->getOffset();

            $read = new Read;

			$sql = 'SELECT * FROM SITE_USUARIO_NV ';
			
			$partePesq = '';
			
			if ($user['NIVEL'] == 'FINANCEIRO') {
				$partePesq = ' WHERE (NIVEL IN (\'BANCÁRIO\', \'FINANCEIRO\'))';
			} elseif ($user['NIVEL'] == 'CONTRATAÇÃO') {
				$partePesq = ' WHERE (NIVEL LIKE \'CONTRATAÇÃO\')';
			} elseif ($user['NIVEL'] == 'NOTÍCIA') {
				$partePesq = ' WHERE (NIVEL LIKE \'NOTÍCIA\')';
			} elseif ($user['NIVEL'] == 'ADM. POL. DE RH') {
				$partePesq = ' WHERE (NIVEL IN (\'ADM. POL. DE RH\', \'USU. POL. DE RH\'))';
			} elseif ($user['NIVEL'] == 'ADM. GOVERNANÇA') {
				$partePesq = ' WHERE (NIVEL IN (\'ADM. GOVERNANÇA\', \'USU. PORTAL DE GOVERNANÇA\'))';
			}
			
            if ($campoPesq != '') {
				
                $partePesq = $partePesq . ' AND ((upper(nome) LIKE UPPER(caracter(\'%' . $campoPesq . '%\'))) '
                        . ' OR (upper(instituicao) LIKE UPPER(caracter(\'%' . $campoPesq . '%\'))) '
                        . ' OR (upper(usuario) LIKE UPPER(caracter(\'%' . $campoPesq . '%\'))) '
                        . ' OR (upper(email) LIKE UPPER(caracter(\'%' . $campoPesq . '%\'))) '
                        . ' OR (upper(classe) LIKE UPPER(caracter(\'%' . $campoPesq . '%\')))) ';

            }

            $parteOrd = ' ORDER BY CODIGO DESC';

			$sql = $sql . $partePesq . $parteOrd;

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
                            <span class="nivel_usuario center">
                                <?= $NIVEL; ?>
                            </span>
                            <span class="ed center">
                                <a href="painel.php?exe=usuario/edit&status=update&idusuario=<?= $CODIGO; ?>" >
                                    <i class="fa fa-pencil-square-o icon_blue" aria-hidden="true" title="Editar"></i>
                                </a>
                                &nbsp;
                                <a href="#" onclick="confirm_delete('painel.php?exe=usuario/index&status=delete&idusuario=<?= $CODIGO; ?>');" >
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
    <!--<div class="clear"></div>-->
</div> <!-- content home -->
