<div class="form_create">

    <article>

        <header >
            <h1 class="title_crud">RELATORIO DE USUÁRIO</h1>
        </header>

        <div class="content">

            <form name="form" action="painel.php?exe=relatorio/relatorio_usuario" method="post" enctype="multipart/form-data">

                <div class="label_line">

                    <label class="lista_dados">
                        <span class="field">Usuário:</span>
                        <input 
                            type="text" 
                            id="pesq_usuario" 
                            name="PESQUSUARIO"
                            />
                    </label>

                </div>

                <div class="label_line">

                    <label class="lista_dados">
                        <select multiple size="10" id="list_go_usuario">
                            <?php
                            $read = new Read;
                            $read->ExeRead("SITE_USUARIO", "ORDER BY NOME ASC");
                            if ($read->getResult()):
                                foreach ($read->getResult() as $user):
                                    extract($user);
                                    ?>
                                    <option value="<?= $CODIGO; ?>"><?= $NOME; ?></option>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </label>


                    <label class="botoes_lista">
                        <input type="button" value=">>" id="all_go_usuario"/>
                        <input type="button" value=">" id="go_usuario"/>
                        <input type="button" value="L" id="clear_usuario"/>
                    </label>

                    <label class="lista_dados" >
                        <select 
                            multiple 
                            size="10" 
                            id="list_back_usuario" 
                            name="LISTAUSUARIO[]"
                            >
                        </select>
                    </label>

                </div>

                <div class="label_line">

                    <label class="lista_dados">
                        <span class="field">Classe:</span>
                        <input 
                            type="text" 
                            id="pesq_classe" 
                            name="PESQCLASSE"
                            />
                    </label>

                </div>

                <div class="label_line">

                    <label class="lista_dados">
                        <select multiple size="10" id="list_go_classe">
                            <option value="1">ADV</option>
                            <option value="2">BANCO</option>
                            <option value="3">FORNECEDOR</option>
                            <option value="4">OUTROS</option>
                            <option value="5">TRADING</option>
                            <option value="6">USINA</option>
                        </select>
                    </label>

                    <label class="botoes_lista">
                        <input type="button" value=">>" id="all_go_classe"/>
                        <input type="button" value=">" id="go_classe"/>
                        <input type="button" value="L" id="clear_classe"/>
                    </label>

                    <label class="lista_dados">
                        <select 
                            multiple 
                            size="10" 
                            id="list_back_classe" 
                            name="LISTACLASSE[]" 
                            >
                        </select>
                    </label>

                </div>

                <div class="label_line botoes">
                    <input type="button" class="btn blue" value="Pesquisar" id="find" />
                    <!--<input type="submit" name="form" class="btn blue" value="Pesquisar"/>-->
                    <input type="button" onclick="window.location.href = 'painel.php'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
                    <!--<div class="clear"></div>-->
                </div>

            </form>

        </div>

    </article>
    <!--<div class="clear"></div>-->
</div>
