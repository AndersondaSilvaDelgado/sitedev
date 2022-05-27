<main>

    <section class="slide container">

        <?php
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if (isset($form)) {
            $envio = new EnvioEmail;
            $envio->envio($form);
        }

        if ($verDisp):
            ?>

            <a href="themes/arquivos/plano_covid.pdf?v=1">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="themes/img/imagem01.jpg" /></div>
                        <div class="swiper-slide"><img src="themes/img/imagem02.jpg" /></div>
                        <div class="swiper-slide"><img src="themes/img/imagem03.jpg" /></div>
                        <div class="swiper-slide"><img src="themes/img/imagem04.jpg" /></div>
                        <div class="swiper-slide"><img src="themes/img/imagem05.jpg" /></div>
                        <div class="swiper-slide"><img src="themes/img/imagem06.jpg" /></div>
                        <div class="swiper-slide"><img src="themes/img/imagem07.jpg" /></div>
                    </div>
                </div>
            </a>

        <?php else: ?>

            <div class="slide_controll">
                <div class="slide_nav back"><</div>
                <div class="slide_nav go">></div>
            </div>

            <div class="stop_controll">
                <div class="stop"><i class="fa fa-pause" aria-hidden="true"></i></div>
            </div>

            <div class="bullet_controll">
                <div class="bullet img01 bullet_atual"></div>
                <div class="bullet img02"></div>
                <div class="bullet img03"></div>
                <div class="bullet img04"></div>
                <div class="bullet img05"></div>
                <div class="bullet img06"></div>
                <div class="bullet img07"></div>
            </div>

            <article class="slide_item">
                <a href="index.php?exe=principios&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>">
                    <img src="themes/img/imagem01.jpg?v=4" alt="<?= ($idioma == 1) ? 'Imagem Panorâmica da Usina Santa S.A.' : 'Panoramic view of the Usina Santa S.A.'; ?>" title="<?= ($idioma == 1) ? 'Imagem Panorâmica da Usina Santa S.A.' : 'Panoramic view of the Usina Santa S.A.'; ?>" />
                </a>
            </article>

            <div id="plano_covid" class="w3-modal">
                <div class="w3-modal-content">
                    <header class="w3-container w3-blue"> 
                        <span onclick="document.getElementById('plano_covid').style.display='none'" 
                        class="w3-button w3-display-topright">&times;</span>
                        <h2>Plano de Contingência COVID 19</h2>
                    </header>
                    <div class="w3-container">
                        <iframe src="themes/arquivos/plano_covid.pdf" width="100%" height="500px"></iframe>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </section>

    <section class="container relacao">
        <div class="content">
            <h1 class="fontzero">Area restrita</h1>
            <a href="https://apex.usinasantafe.com.br:8443/apex/f?p=232" target="_blank">
                <article class="item_index" title="<?= ($idioma == 1) ? 'Portal dos Fornecedores de Matéria-Prima' : 'Raw Material Supplier Portal'; ?>">
                    <p class="tagline"><i class="fa fa-truck" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Portal dos Fornecedores de Matéria-Prima' : 'Raw Material Supplier Portal'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Portal com dados dos Fornecedores de Matéria-Prima da Empresa.' : 'Raw Material Supplier Data Portal.'; ?></p>
                </article>
            </a>
            <a href="index.php?exe=acesso_relacao">
                <article class="item_index" title="<?= ($idioma == 1) ? 'Relação com Instituições Financeiras' : 'Relations with Financial Institutions'; ?>">
                    <p class="tagline"><i class="fa fa-users" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Relação com Instituições Financeiras' : 'Relations with Financial Institutions'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Relatórios com Informações Gerais relativo a Empresa para Instituições Financeiras.' : 'Relations with Financial Institutions'; ?></p>
                </article>
            </a>
            <a href="#" onclick="document.getElementById('portalcotacao').style.display='block'">
                <article class="item_index" title="<?= ($idioma == 1) ? 'Portal de Cotação de Fornecedores' : 'Supplier Bidding Portal'; ?>">
                    <p class="tagline"><i class="fa fa-calendar" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Portal de Cotação de Fornecedores' : 'Supplier Bidding Portal'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'O novo Portal de Compras do GRUPO SANTA FÉ - Nova Europa - SP - BR é ferramenta cujo objetivo é agilizar o processo de compras da empresa.' : 'Supplier Bidding Portal'; ?></p>
                </article>
            </a>
            
            <div id="portalcotacao" class="w3-modal">
              <div class="w3-modal-content">
                <header class="w3-container w3-blue"> 
                  <b onclick="document.getElementById('portalcotacao').style.display='none'" 
                  class="w3-button w3-display-topright">&times;</b>
                  <h2>Portal Cotação</h2>
                </header>
                  <div class="w3-container">
                    <p class="tagline texto_princ"></p>
                    <p class="tagline texto_princ">Olá parceiro, tudo bem?</p>
                    <p class="tagline texto_princ">Comunicamos que nosso departamento de Suprimentos, objetivando automatizar e 
                        agilizar o processo de aquisição de bens, a partir de 10/05/2021 passa a utilizar a plataforma Comlink para o 
                        processo de cotações de materiais e confirmação dos pedidos de compra.</p>
                    <p class="tagline texto_princ">Assim, todas as cotações e pedidos da Usina Santa Fé estarão disponíveis na 
                        plataforma Comlink, e serão negociadas preferencialmente por este canal.</p>
                    <p class="tagline texto_princ">Dúvidas sobre a plataforma Comlink, entrar em contato através da Central de 
                        Atendimento da Comlink, via site comlink.com.br, e-mail: fornecedor@comlink.com.br ou 
                        telefone: 16 2101-4000.</p>
                    <p class="tagline texto_princ">Atenciosamente,<br>
                    <b>Área de Suprimentos</b></p>
                  </div>
              </div>
            </div>
            
            <a href="https://apex.usinasantafe.com.br:8443/apex/f?p=CAR:POSICAO_TICKET" target="_blank">
                <article class="item_index" title="<?= ($idioma == 1) ? 'Consultar Posição no Carregamento' : 'Consultar Posição no Carregamento'; ?>">
                    <p class="tagline"><i class="fa fa-truck" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Consultar Posição no Carregamento' : 'Consultar Posição no Carregamento'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Consultar Posição no Carregamento' : 'Consultar Posição no Carregamento'; ?></p>
                </article>
            </a>
            <div class="clear"></div>
        </div>
    </section>

    <div class="msg_principal">
        <i class="fa fa-envelope" aria-hidden="true"></i>
        <span>&nbsp;&nbsp;<?= ($idioma == 1) ? 'Deixe sua Mensagem' : 'Leave your Message'; ?></span>
    </div>
    <div class="msg_formulario">
        <form name="FormMSG" action="index.php?exe=index" method="post">
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
            <input type="submit" name="FormMSG" class="btn" />
        </form>
    </div>

    <div class="clear"></div>

</main>
