<main>
    <section class="container relacao">
        <div class="content">
			<section class="localizacao senai">
				<h1 class="tit_senai"><?= ($idioma == 1) ? 'Processo Seletivo – Aprendiz SENAR' : 'Processo Seletivo – Aprendiz SENAR'; ?></h1>
				<p class="tagline">Aprendiz na Cultura de Cana de Açucar</p>
				<p class="tagline">Requisitos</p>
				<p class="tagline">Ensino Médio Completo ou Cursando</p>
				<p class="tagline">Idade 18 a 23 anos</p>
				<p class="tagline">Moradia Nova Europa</p>
				<p class="tagline">Inscrições do dia 05/12/2020 a partir das  8:00  até dia 09/12/2020 ate as 8:00</p>
				<a href="http://apex.usinasantafe.com.br:9080/apex/f?p=190" target="_blank">
					<p class="tagline"><b>Clique aqui para realizar a inscrição.</b></p>
				</a>
			</section>
			<div class="clear"></div>
        </div>
    </section>

    <section class="slide container">
        <h1 class="fontzero">Imagens da Empresa</h1>

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
						<div class="swiper-slide"><img src="themes/img/imagem01_bkp.jpg" /></div>
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
				<a href="index.php?exe=principios&idioma=<?= ($idioma == 1) ? 'pt' : 'en'; ?>"><?= ($idioma == 1) ? 'Princípios Empresariais' : 'Business Principles'; ?>
					<img src="themes/img/imagem01.jpg?v=6" alt="<?= ($idioma == 1) ? 'Imagem Panorâmica da Usina Santa S.A.' : 'Panoramic view of the Usina Santa S.A.'; ?>" title="<?= ($idioma == 1) ? 'Imagem Panorâmica da Usina Santa S.A.' : 'Panoramic view of the Usina Santa S.A.'; ?>" />
					<h1 class="fontzero"><?= ($idioma == 1) ? 'Imagem Panorâmica da Usina Santa S.A.' : 'Panoramic view of the Usina Santa S.A.'; ?></h1>
				</a>
            </article>

        <?php endif; ?>

    </section>

    <section class="container relacao">
        <div class="content">
            <h1 class="fontzero">Area restrita</h1>
            <a href="http://apex.usinasantafe.com.br:9080/apex/f?p=232" target="_blank">
                <article class="item_aplicativo" title="<?= ($idioma == 1) ? 'Portal dos Fornecedores de Matéria-Prima' : 'Raw Material Supplier Portal'; ?>">
                    <p class="tagline"><i class="fa fa-truck" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Portal dos Fornecedores de Matéria-Prima' : 'Raw Material Supplier Portal'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Portal com dados dos Fornecedores de Matéria-Prima da Empresa.' : 'Raw Material Supplier Data Portal.'; ?></p>
                </article>
            </a>
            <a href="index.php?exe=acesso_relacao">
                <article class="item_aplicativo" title="<?= ($idioma == 1) ? 'Relação com Instituições Financeiras' : 'Relations with Financial Institutions'; ?>">
                    <p class="tagline"><i class="fa fa-users" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Relação com Instituições Financeiras' : 'Relations with Financial Institutions'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'Relatórios com Informações Gerais relativo a Empresa para Instituições Financeiras.' : 'Relations with Financial Institutions'; ?></p>
                </article>
            </a>
            <a href="http://apex.usinasantafe.com.br:9080/apex/f?p=139" target="_blank">
                <article class="item_aplicativo" title="<?= ($idioma == 1) ? 'Portal de Cotação de Fornecedores' : 'Supplier Bidding Portal'; ?>">
                    <p class="tagline"><i class="fa fa-calendar" aria-hidden="true"></i></p>
                    <h1><?= ($idioma == 1) ? 'Portal de Cotação de Fornecedores' : 'Supplier Bidding Portal'; ?></h1>
                    <p class="tagline fontzero"><?= ($idioma == 1) ? 'O novo Portal de Compras do GRUPO SANTA FÉ - Nova Europa - SP - BR é ferramenta cujo objetivo é agilizar o processo de compras da empresa.' : 'Supplier Bidding Portal'; ?></p>
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
