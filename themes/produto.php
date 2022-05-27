<main>

    <section class="slide container">
        <h1 class="fontzero">Produtos</h1>

        <?php if ($verDisp): ?>

            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="themes/img/imagem_prod01.jpg" /></div>
                    <div class="swiper-slide"><img src="themes/img/imagem_prod02.jpg" /></div>
                    <div class="swiper-slide"><img src="themes/img/imagem_prod03.jpg" /></div>
                    <div class="swiper-slide"><img src="themes/img/imagem_prod04.jpg" /></div>
                    <div class="swiper-slide"><img src="themes/img/imagem_prod05.jpg" /></div>
                    <div class="swiper-slide"><img src="themes/img/imagem_prod06.jpg" /></div>
                </div>
            </div>

        <?php else: ?>
            <div class="slide_controll">
                <div class="slide_nav back"><</div>
                <div class="slide_nav go">></div>
            </div>

            <div class="bullet_controll">
                <div class="bullet img01 bullet_atual"></div>
                <div class="bullet img02"></div>
                <div class="bullet img03"></div>
                <div class="bullet img04"></div>
                <div class="bullet img05"></div>
                <div class="bullet img06"></div>
            </div>

            <article class="slide_item">
                <img id="imagem_produto" src="themes/img/imagem_prod01.jpg"/>
            </article>
        <?php endif; ?>

    </section>

    <section class="container">
        <div class="content produto">
            <h1 class="titulo_padrao"><?= ($idioma == 1) ? 'Conheça nossos Produtos' : 'Our Products'; ?></h1>
            <article>
                <h2><?= ($idioma == 1) ? 'Açúcar: Usina Santa Fé S.A.' : 'Sugar: Usina Santa Fé S.A.'; ?></h2>
                <p class="tagline">
                    <?= ($idioma == 1) ? "
                    O Açúcar Cristal Santa Fé é produzido através da sacarose da cana-de-açúcar, 
                    possui aspecto sólido em forma de cristais brancos transparentes bem definidos, 
                    com sabor e odor próprios do produto.
                    " : "
                    Santa Fé Crystal Sugar is produced from sugarcane. It has a solid appearance 
                    in the form of well-defined transparent white crystals, with the typical flavor 
                    and smell of the product. 
                    "; ?>
                </p>
                <p class="tagline">
                    <?= ($idioma == 1) ? "
                    O limite de armazenamento de açucar cristal da empresa é de 1.350.000 sacas de 50kg.
                    " : "
                    The company's crystal sugar storage capacity is 1,350,000 50kg bags.
                    "; ?>
                </p>
				<p class="tagline">
					<a href="themes/arquivos/Especificacoes_Tecnica_do_Acucar_Cristal.pdf?v=2" target="_blank" >
						<span class="link"><?= ($idioma == 1) ? 'Especificação Técnica' : 'Technical Specification'; ?></span>
					</a>
				</p>
				<p class="tagline">
					<a href="themes/arquivos/fispq_acucar_cristal.pdf" target="_blank" >
						<span class="link"><?= ($idioma == 1) ? 'FISPQ - Açúcar Cristal' : 'Technical Specification'; ?></span>
					</a>
				</p>
            </article>
            <article>
                <h2><?= ($idioma == 1) ? 'Etanol: Hidratado e Anidro' : 'Ethanol: Hydrated and Anhydrous'; ?></h2>
                <p class="tagline"><span><?= ($idioma == 1) ? 'Etanol Hidratado: ' : 'Hydrated Ethanol: '; ?></span>
                    <?= ($idioma == 1) ? "
                    É utilizado como combustível em carros com 
                    motores a álcool ou flex.
                    " : "
                    fuels vehicles with ethanol powered or flexible fuel engines.
                    "; ?>
                </p>
                <p class="tagline"><span><?= ($idioma == 1) ? 'Etanol Anidro: ' : 'Anhydrous Ethanol: '; ?></span>
                    <?= ($idioma == 1) ? "
                    É utilizado como aditivo para gasolina comum.
                    " : "
                    used as an additive to regular gasoline.
                    "; ?>
                </p>
                <p class="tagline">
                    <?= ($idioma == 1) ? "
                    O limite de armazenamento de Etanol Hidratado/Anidro da empresa é de 84.000.000 litros.
                    " : "
                    The company's hydrated/anhydrous ethanol storage capacity is 84,000,000 liters.
                    "; ?>
                </p>
				<p class="tagline">
					<a href="themes/arquivos/Especificacoes_Tecnica_do_Etanol.pdf?v=2" target="_blank" >
						<span class="link"><?= ($idioma == 1) ? 'Especificação Técnica' : 'Technical Specification'; ?></span>
					</a>
				</p>
				<p class="tagline">
					<a href="themes/arquivos/fispq_etanol_anidro.pdf" target="_blank" >
						<span class="link"><?= ($idioma == 1) ? 'FISPQ - Etanol Anidro' : 'FISPQ - ETANOL ANIDRO'; ?></span>
					</a>
				</p>
				<p class="tagline">
					<a href="themes/arquivos/fispq_etanol_hidratado.pdf" target="_blank" >
						<span class="link"><?= ($idioma == 1) ? 'FISPQ - Etanol Hidratado' : 'FISPQ - ETANOL HIDRATADO'; ?></span>
					</a>
				</p>
            </article>
        </div>
    </section>

    <div class="clear"></div>

</main>
