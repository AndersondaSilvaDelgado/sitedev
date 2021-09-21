<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (isset($form)) {
        $envio = new EnvioEmail;
        $envio->envio($form);
    }
    ?>

    <section class="container">
        <div class="content">
            <h1 class="titulo_padrao"><?= ($idioma == 1) ? 'Trabalhe Conosco' : 'Work with us'; ?></h1>
        </div>
    </section>
    <div class="clear"></div>


    <section class="formulario_contato fale_conosco">
        <h1 ><?= ($idioma == 1) ? 'Trabalhe Conosco' : 'Work with us'; ?></h1>
        <form name="FormMSG" action="" method="post">
            <label>
                <span><?= ($idioma == 1) ? 'Segue abaixo vaga(s) de emprego em aberto:' : 'Open job vacancy below:'; ?></span>
            </label>
            <table >
                <tr>
                    <td class="trab_cargo_titulo"><?= ($idioma == 1) ? 'Cargo' : 'Position'; ?></td>
                    <td class="trab_tipo_titulo"><?= ($idioma == 1) ? 'Tipo' : 'Type'; ?></td>
                    <td class="trab_vaga_titulo"><?= ($idioma == 1) ? 'Vagas' : 'Vacancies'; ?></td>
                </tr>
                <?php
                $readCategorias = new Read;
                $readCategorias->ExeReadMod("SELECT * FROM SITE_VAGAS ORDER BY CODIGO DESC");

                if ($readCategorias->getResult()):
                    foreach ($readCategorias->getResult() as $vaga):
                        //extract($vaga);
                        ?>

                        <tr>
                            <td id="cod_<?= $vaga['CODIGO']; ?>" class="trab_cargo myBtn"><?= $vaga['DESCRICAO']; ?></td>
                            <td class="trab_tipo">
                                <?php
                                if ($vaga['TIPO'] == 1) {
                                    echo 'Efetivo';
                                } elseif ($vaga['TIPO'] == 2) {
                                    echo 'Safrista';
                                } elseif ($vaga['TIPO'] == 3) {
                                    echo 'Estagio';
                                }
                                ?>
                            </td>
                            <td class="trab_vaga"><?= $vaga['QTDE'] ?></td>
                        </tr>
                        <div id="msg_<?= $vaga['CODIGO'] ?>" class="modal">
                          <!-- Modal content -->
                          <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2 ><?= $vaga['DESCRICAO']; ?></h2>
                            <?php
                                $readDescr = new Read;
                                $readDescr->ExeReadMod("SELECT * FROM SITE_VAGAS WHERE CODIGO = " . $vaga['CODIGO']);
                                foreach ($readDescr->getResult() as $d):
                                extract($d);
                                echo stream_get_contents($d['DESCRITIVO']);
                                endforeach;
                                ?>
                          </div>

                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
    <!-- The Modal -->
            </table>
            <a href="http://apex.usinasantafe.com.br:9080/apex/f?p=233" target="_blank">
                <div class="btn"><?= ($idioma == 1) ? 'Cadastro de Currículo' : 'Send Resume'; ?></div>
            </a>
        </form>
    </section>
    <section class="formulario_contato trabalhe_conosco">
        <h1 ><?= ($idioma == 1) ? 'Fale Conosco' : 'Contact Us'; ?></h1>
        <form  action="" id="FormMSG" method="post">
            <label>
                <span><?= ($idioma == 1) ? 'Nome' : 'Name'; ?>:</span>
                <input type="text" name="nome" required/>
            </label>
            <label>
                <span>E-mail:</span>
                <input type="email" name="email" required/>
            </label>
            <label>
                <span><?= ($idioma == 1) ? 'Número de Telefone' : 'Telephone Number'; ?>:</span>
                <input type="tel" name="telefone" required/>
            </label>
            <label>
                <span class="field"><?= ($idioma == 1) ? 'Departamento' : 'Department'; ?>:</span>
                <select name="departamento">
                    <option value="1"><?= ($idioma == 1) ? 'Agrícola' : 'Agricultural'; ?></option>
                    <option value="2">Industrial</option>
                    <option value="3"><?= ($idioma == 1) ? 'Recurso Humanos' : 'Human Resources'; ?></option>
                    <option value="4"><?= ($idioma == 1) ? 'Compras' : 'Purchasing'; ?></option>
                    <option value="5"><?= ($idioma == 1) ? 'Qualidade' : 'Quality'; ?></option>
                    <option value="6"><?= ($idioma == 1) ? 'Outros' : 'Others'; ?></option>
                </select>
            </label>
            <label>
                <span><?= ($idioma == 1) ? 'Mensagem' : 'Message'; ?>:</span>
                <textarea rows="6"  name="mensagem" required></textarea>
            </label>
            <a href="#" onclick="javascript:envioMSG(); return false;">
                <div class="btn"><?= ($idioma == 1) ? 'Enviar' : 'Send'; ?></div>
            </a>
        </form>
    </section>
    <div class="clear"></div>

</main>
