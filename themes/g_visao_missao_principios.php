<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <section class="container">
        <div class="content padrao">
            <h1 class="titulo_padrao"><?= ($idioma == 1) ? 'Visão, Missão e Princípios' : 'Visão, Missão e Princípios'; ?></h1>
            <div class="clear"></div>
            <div class="imagem_padrao imagem_direita">
                <img src="themes/img/usina.jpg" alt="<?= ($idioma == 1) ? 'Imagem Panorâmica da Usina Santa Fé S.A.' : 'Panoramic Image of the Usina Santa Fé S.A.'; ?>" title="<?= ($idioma == 1) ? 'Imagem Panorâmica da Usina Santa Fé S.A.' : 'Panoramic Image of the Usina Santa Fé S.A.'; ?>"/>
                <h1><?= ($idioma == 1) ? 'Imagem Panorâmica da Usina Santa Fé S.A.' : 'Panoramic Image of the Usina Santa Fé S.A.'; ?></h1>
            </div>
            <article>
                <h2><?= ($idioma == 1) ? 'Missão' : 'Mission'; ?></h2>
                <p class="tagline">
                    <?= ($idioma == 1) ? '
                "Produzir alimentos e energias renováveis com competitividade, respeitando o meio ambiente e contribuindo para o desenvolvimento social".
                ' : '
                "Produzir alimentos e energias renováveis com competitividade, respeitando o meio ambiente e contribuindo para o desenvolvimento social".
                '; ?>
                </p>
                <h2><?= ($idioma == 1) ? 'Visão' : 'Vision'; ?></h2>
                <p class="tagline">
                    <?= ($idioma == 1) ? '
                "Ser uma empresa com rentabilidade e sustentabilidade, criando oportunidades de crescimento".
                ' : '
                "Ser uma empresa com rentabilidade e sustentabilidade, criando oportunidades de crescimento".
                '; ?>
                </p>
                <h2><?= ($idioma == 1) ? 'Crenças e Valores' : 'Beliefs and Values'; ?></h2>
                <ul>
                    <li>
                        <?= ($idioma == 1) ? '
                    Valorização das Pessoas.
                    ' : '
                    Valorização das Pessoas.
                    '; ?>
                    </li>
                    <li>
                        <?= ($idioma == 1) ? '
                    Fazer melhor sempre.
                    ' : '
                    Fazer melhor sempre.
                    '; ?>
                    </li>
                    <li>
                        <?= ($idioma == 1) ? '
                    Crescer e evoluir juntos.
                    ' : '
                    Crescer e evoluir juntos.
                    '; ?>
                    </li>
                    <li>
                        <?= ($idioma == 1) ? '
                    Conservar os recursos naturais.
                    ' : '
                    Conservar os recursos naturais.
                    '; ?>
                    </li>
                    <li>
                        <?= ($idioma == 1) ? '
                    Integridade, Ética e Transparência.
                    ' : '
                    Integridade, Ética e Transparência.
                    '; ?>
                    </li>
                    <li>
                        <?= ($idioma == 1) ? '
                    Pensar globalmente e agir localmente.
                    ' : '
                    Pensar globalmente e agir localmente.
                    '; ?>
                    </li>
                </ul>
            </article>
        </div>
    </section>
    <div class="clear"></div>
</main>