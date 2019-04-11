<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <section class="container">
        <div class="content padrao">
            <h1 class="titulo_padrao"><?= ($idioma == 1) ? 'Recursos Humanos' : 'Human Resources'; ?></h1>
            <p class="tagline"><?= ($idioma == 1) ? 'A' : 'The'; ?><span>Usina Santa Fé S.A.</span> 
                <?= ($idioma == 1) ? "
                estabelece suas estratégias de acordo com sua Missão, 
                Visão e Valores, estruturando suas práticas de Recursos Humanos na valorização, desenvolvimento, 
                segurança e ética, envolvendo seus colaboradores, familiares, prestadores de serviços ou comunidade. 
                " : "
                establishes strategy in accordance with its Mission, Vision and Values, basing its Human Resources 
                practices on ethics and safety in order to value, develop and engage its employees, family members, 
                service providers and the community.
                "; ?>
            </p>
            <div class="imagem_padrao imagem_direita">
                <img src="themes/img/jovem_aprendiz.jpg" alt="<?= ($idioma == 1) ? 'Programa Jovem Aprendiz' : 'Apprentice Program'; ?>" title="<?= ($idioma == 1) ? 'Programa Jovem Aprendiz' : 'Apprentice Program'; ?>"/>
                <h1><?= ($idioma == 1) ? 'Programa Jovem Aprendiz' : 'Apprentice Program'; ?></h1>
            </div>
            <p class="tagline">
                <?= ($idioma == 1) ? "
                Principais Programas de Gestão de Pessoas:
                " : "
                Main People Management Programs:
                "; ?>
            </p>
            <ul>
                <li class="tagline">
                    <span>
                        <?= ($idioma == 1) ? "
                        Recrutamento, Seleção e Desenvolvimento:
                        " : "
                        Recruitment, Selection and Development:
                        "; ?>
                    </span>
                    <?= ($idioma == 1) ? "
                    Processos que buscam a valorização, bem-estar e crescimento das 
                    pessoas através de boas práticas de gestão de pessoas. 
                    " : "
                    Processes that value people and promote well being and growth 
                    by means of best people management practices.
                    "; ?>
                </li>
                <li class="tagline">
                    <span>
                        <?= ($idioma == 1) ? "
                        Gestão de Desempenho, Cargos e Remuneração:
                        " : "
                        Performance, Job and Remuneration Management:
                        "; ?>
                    </span>
                    <?= ($idioma == 1) ? "
                    Politicas baseadas em performance, competências e meritocracia.
                    " : "
                    Policies based on performance, competencies and merit.
                    "; ?>
                </li>
                <li class="tagline"><span>
                        <?= ($idioma == 1) ? "
                        Programa Jovem Aprendiz:
                        " : "
                        Apprentice Program:
                        "; ?>
                    </span>
                    <?= ($idioma == 1) ? "
                    O Programa tem como objetivo garantir aos jovens a capacitação 
                    profissional como etapa do seu processo educativo. É um método de 
                    ensino técnico-profissional com atividades teóricas e práticas, 
                    direcionado a jovens de 14 a 24.
                    " : "
                    The program is aimed at ensuring professional training for young 
                    people as part of their education. It is a technical/vocational 
                    teaching method with theoretical and practical components aimed 
                    at young people aged from 14 to 24.
                    "; ?>
                </li>
                <li class="tagline">
                    <span>
                        <?= ($idioma == 1) ? "
                        Programa visita nas áreas – RH próximo ao colaborador:
                        " : "
                        Area visit program – HR close to employees:
                        "; ?>
                    </span>
                    <?= ($idioma == 1) ? "
                    Implantado desde 2013 o programa tem como objetivo estar próximo 
                    das áreas promovendo a comunicação, interação e levantamento 
                    de necessidades.
                    " : "
                    In place since 2013, the program is aimed at promoting proximity 
                    with the areas, enhancing communication, interaction and identifying 
                    needs.
                    "; ?>
                </li>
                <li class="tagline"><span><?= ($idioma == 1) ? 'Benefícios:' : 'Benefits:'; ?></span> 
                    <?= ($idioma == 1) ? "
                    São oferecidos aos colaboradores e buscam o bem estar, 
                    segurança e comodidade, dentre os benefícios destacamos:
                    " : "
                    aimed at promoting well being, safety, convenience, worthy of note are:
                    "; ?>
                    <ul>
                        <li><span><?= ($idioma == 1) ? 'Convênio Médico' : 'Medical plan'; ?></span></li>
                        <li><span><?= ($idioma == 1) ? 'Seguro de Vida' : 'Life insurance'; ?></span></li>
                        <li><span><?= ($idioma == 1) ? 'Participação nas Metas e Resultados' : 'Profit share'; ?></span></li>
                        <li><span><?= ($idioma == 1) ? 'Ticket Alimentação' : 'Meal vouchers'; ?></span></li>
                        <li><span><?= ($idioma == 1) ? 'Alimentação' : 'Food assistance'; ?></span></li>
                        <li><span><?= ($idioma == 1) ? 'Farmácia' : 'Drugstore'; ?></span></li>
                        <li><span><?= ($idioma == 1) ? 'Material escolar' : 'School materials'; ?></span></li>
                        <li><span><?= ($idioma == 1) ? 'Programa de bolsa de estudo' : 'Scholarship program'; ?></span></li>
                        <li><span><?= ($idioma == 1) ? 'Convênios educacionais' : 'Educational agreements'; ?></span></li>
                        <li><span><?= ($idioma == 1) ? 'Transporte' : 'Transportation'; ?></span></li>
                    </ul>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
    </section>

    <div class="clear"></div>
</main>
