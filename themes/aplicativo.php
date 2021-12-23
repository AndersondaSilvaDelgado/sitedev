<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <section class="container relacao">
        <div class="content">
            <h1 class="titulo_padrao"><?= ($idioma == 1) ? 'Aplicativos' : 'Applications'; ?></h1>
            <a href="http://apex.usinasantafe.com.br:9080/apex/f?p=232" target="_blank">
                <article class="item_aplicativo" title="<?= ($idioma == 1) ? 'Portal dos Fornecedores de Matéria-Prima' : 'Raw Material Suppliers Portal'; ?>">
                    <p class="tagline"><i class="fa fa-truck" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Portal dos Fornecedores de Matéria-Prima' : 'Raw Material Suppliers Portal'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Portal com dados dos Fornecedores de Matéria-Prima da Empresa.' : 'Raw Material Suppliers Data Portal.'; ?></p>
                </article>
            </a>
            <a href="index.php?exe=acesso_relacao">
                <article class="item_aplicativo" title="<?= ($idioma == 1) ? 'Relação com Instituições Financeiras' : 'Relations with Financial Institutions'; ?>">
                    <p class="tagline"><i class="fa fa-users" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Relação com Instituições Financeiras' : 'Relations with Financial Institutions'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Relatórios com Informações Gerais relativo a Empresa.' : 'Reports providing general information about the company.'; ?></p>
                </article>
            </a>
            <a href="#" onclick="document.getElementById('portalcotacaoaplic').style.display='block'">
                <article class="item_aplicativo" title="<?= ($idioma == 1) ? 'Portal de Cotação de Fornecedores' : 'Supplier Bidding Portal'; ?>">
                    <p class="tagline"><i class="fa fa-calendar" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Portal de Cotação de Fornecedores' : 'Supplier Bidding Portal'; ?></h1>
                    <p class="tagline fontzero">O novo Portal de Compras do GRUPO SANTA FÉ - Nova Europa - SP - BR é ferramenta cujo objetivo é agilizar o processo de compras da empresa.</p>
                </article>
            </a>
            <div id="portalcotacaoaplic" class="w3-modal">
              <div class="w3-modal-content">
                <header class="w3-container w3-blue"> 
                  <b onclick="document.getElementById('portalcotacaoaplic').style.display='none'" 
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
            <a href="https://webmail.usinasantafe.com.br/owa" target="_blank">
                <article class="item_aplicativo" title="Outlook Web App">
                    <img src="themes/img/owa.jpg" alt="Outlook Web App" title="Outlook Web App"/>
                    <h1>Outlook Web App</h1>
                    <p class="tagline fontzero">Outlook Web App - Acesso ao e-mail dos colaboradores da empresa.</p>
                </article>
            </a>
            <a href="https://apex.vertech-it.com.br/apex/f?p=123" target="_blank">
                <article class="item_aplicativo" title="BI - Vertech It Solutions">
                    <img src="themes/img/vertech.png" alt="BI - Vertech It Solutions" title="BI - Vertech It Solutions"/>
                    <h1>BI - Vertech It Solutions</h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Sistema BI com dados administrativos empresariais.' : 'BI system with business administrative data.'; ?></p>
                </article>
            </a>
            <a href="http://apex.usinasantafe.com.br:9080/apex/f?p=199" target="_blank">
                <article class="item_aplicativo" title="SGI WEB">
                    <p class="tagline"><i class="fa fa-cloud" aria-hidden="true"></i></p>
                    <h1>SGI WEB</h1>
                    <p class="tagline fontzero">Versão do SGI para Internet.</p>
                </article>
            </a>
            <a href="http://logtracker-vm.cloudapp.net:8091" target="_blank">
                <article class="item_aplicativo" title="<?= ($idioma == 1) ? 'LogTracker - Portal de Rastreamento Online' : 'LogTracker - Online Tracking Portal'; ?>">
                    <img src="themes/img/logtrac.jpg" alt="LogTracker - Portal de Rastreamento Online" title="LogTracker - Portal de Rastreamento Online"/>
                    <h1><?= ($idioma == 1) ? 'LogTracker - Portal de Rastreamento Online' : 'LogTracker - Online Tracking Portal'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Sistema de controle de rastreamento de equipamento agrícola online.' : 'Online agricultural equipment tracking system.'; ?></p>
                </article>
            </a>
            <a href="http://logtracker-vm.cloudapp.net:8092/" target="_blank">
                <article class="item_aplicativo" title="SGI WEB">
                    <img src="themes/img/logtrac.jpg" alt="SGI WEB" title="SGI WEB"/>
                    <h1>LogWEB</h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Ferramenta com gráficos referente a atividades de equipamento agrícola online.' : 'Online tool with graphs on agricultural equipment activities.'; ?></p>
                </article>
            </a>
            <a href="http://192.168.1.53:8080/complianceEnterpriseServer/" target="_blank">
                <article class="item_aplicativo" title="SGI WEB">
                    <img src="themes/img/compliance.jpg" alt="Compliance Enterprise Server 2.0" title="Compliance Enterprise Server 2.0"/>
                    <h1>Compliance Enterprise Server 2.0</h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Painel de Acesso as Notas Fiscais Eletrônicas.' : 'Electronic Invoice Access Panel.'; ?></p>
                </article>
            </a>
            // <a href="http://wntvmhelpdesk.usinasantafe.com.br/ords/f?p=750" target="_blank">
                <article class="item_aplicativo" title="V-Desk">
                    <img src="themes/img/vertech.png" alt="V-Desk" title="V-Desk"/>
                    <h1>V-Desk</h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Portal de Chamado Interno para TI.' : 'IT Internal Help Desk Portal.'; ?></p>
                </article>
            </a>
            <a href="http://wntvmit.usinasantafe.com.br/org/autenticar" target="_blank">
                <article class="item_aplicativo" title="<?= ($idioma == 1) ? 'CI - Portal de Comunicação Interna da Empresa' : 'CI - Company Internal Communication Portal'; ?>">
                    <p class="tagline"><i class="fa fa-share" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'CI - Portal de Comunicação Interna da Empresa' : 'CI - Company Internal Communication Portal'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Portal de Comunicação Interna da Empresa' : 'Company Internal Communication Portal'; ?></p>
                </article>
            </a>
            <a href="http://wntvmmoodle.usinasantafe.com.br/moodle/" target="_blank">
                <article class="item_aplicativo" title="<?= ($idioma == 1) ? 'Portal EAD - Universidade Corporativa Santa Fé' : 'Distance Learning Portal - Santa Fé Corporate University'; ?>">
                    <img src="themes/img/ead.png" alt="<?= ($idioma == 1) ? 'Portal EAD - Universidade Corporativa Santa Fé' : 'Distance Learning Portal - Santa Fé Corporate University'; ?>" title="Portal EAD - <?= ($idioma == 1) ? 'Portal EAD - Universidade Corporativa Santa Fé' : 'Distance Learning Portal - Santa Fé Corporate University'; ?>"/>
                    <h1><?= ($idioma == 1) ? 'Portal EAD - Universidade Corporativa Santa Fé' : 'Distance Learning Portal - Santa Fé Corporate University'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Portal EAD - Universidade Corporativa Santa Fé' : 'Distance Learning Portal - Santa Fé Corporate University'; ?></p>
                </article>
            </a>
            <a href="https://wntvmsesuite.usinasantafe.com.br/softexpert/login" target="_blank">
                <article class="item_aplicativo" title="GED - Gerenciamento Eletrônico de Documentos">
                    <img src="themes/img/sesuite.png" alt="GED - Gerenciamento Eletrônico de Documentos" title="GED - Gerenciamento Eletrônico de Documentos"/>
                    <h1>SoftExpert Excellence Suite</h1>
                    <p class="tagline fontzero">SoftExpert Excellence Suite</p>
                </article>
            </a>
            <a href="http://apex.usinasantafe.com.br:9080/apex/f?p=200" target="_blank">
                <article class="item_aplicativo" title="<?= ($idioma == 1) ? 'Portal de Carregamento' : 'Portal de Carregamento'; ?>">
                    <p class="tagline"><i class="fa fa-truck" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Portal de Carregamento' : 'Portal de Carregamento'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Portal de Carregamento' : 'Portal de Carregamento'; ?></p>
                </article>
            </a>
            <a href="http://apex.usinasantafe.com.br:9080/apex/f?p=CAR:POSICAO_TICKET" target="_blank">
                <article class="item_aplicativo" title="<?= ($idioma == 1) ? 'Consultar Posição no Carregamento' : 'Consultar Posição no Carregamento'; ?>">
                    <p class="tagline"><i class="fa fa-truck" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Consultar Posição no Carregamento' : 'Consultar Posição no Carregamento'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Consultar Posição no Carregamento' : 'Consultar Posição no Carregamento'; ?></p>
                </article>
            </a>
            <div class="clear"></div>
        </div>
    </section>


    <div class="clear"></div>
</main>
