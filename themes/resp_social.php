<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <section class="container">
        <div class="content padrao">
            <h1 class="titulo_padrao"><?= ($idioma == 1) ? 'Responsabilidade Social' : 'Social Responsibility'; ?></h1>
            <p class="tagline"><?= ($idioma == 1) ? 'A' : ''; ?> <span><?= ($idioma == 1) ? 'Responsabilidade Social' : 'Social Responsibility'; ?></span> 
                <?= ($idioma == 1) ? "
                consiste em proporcionar um ambiente de trabalho agradável, contribuindo para o 
                desenvolvimento e bem estar dos colaboradores, familiares e comunidade.  
                " : "
                consists of providing a pleasant workplace, helping to promote the development 
                and well being of the employees, family members and the community.
                "; ?>
            </p>
            <p class="tagline"><?= ($idioma == 1) ? 'Conheça nossos programas:' : 'See our programs:'; ?></p>
            <ul>
                <div class="imagem_padrao imagem_esquerda">
                    <img src="themes/img/cecoi.jpg" alt="Projeto Varal de Poesia" title="Projeto Varal de Poesia"/>
                    <h1><?= ($idioma == 1) ? 'Instituto de Desenvolvimento Itaquerê' : 'Itaquerê Development Institute'; ?></h1>
                </div>
                <li class="tagline"><span><?= ($idioma == 1) ? 'Instituto de Desenvolvimento Itaquerê:' : 'Itaquerê Development Institute'; ?></span> 
                    <?= ($idioma == 1) ? "
                    Fundado em 2014 com o objetivo de oferecer programas de educação, integração, saúde e cidadania para 
                    crianças e adolescentes, criando maiores oportunidades de crescimento. Sua história teve início no de 
                    2000, quando foi criado o CECOI – Centro de Convivência Itaquerê, um projeto que visava criar um 
                    espaço para promover o desenvolvimento e lazer para comunidade. O êxito do programa 
                    foi um sucesso, transformando-se em Instituto. Para saber mais visite o site
                    " : "
                    Founded in 2014 to offer educational, integration, health and civic awareness programs for children 
                    and adolescents, enhancing their growth opportunities. The institute had its origin in the creation 
                    of CECOI – Centro de Convivência Itaquerê in 2000, a community development and leisure space. The 
                    success of the center led to the foundation of the institute. For further information see the website 
                    "; ?>
                    <a href="http://www.institutoitaquere.org.br"  target="_blank" ><span>http://www.institutoitaquere.org.br/</span></a>. </li>
                <li class="tagline"><span><?= ($idioma == 1) ? 'Projeto Casa da Leitura:' : 'Casa da Leitura Project: '; ?></span> 
                    <?= ($idioma == 1) ? "
                    A biblioteca foi fundada pela Usina Santa Fé em 1999, com acervo de mais 12.000 livros, internet e 
                    videoteca disponíveis para toda comunidade. São desenvolvidos projetos como: oficinas de Literatura de 
                    Cordel, Contador de histórias, Redação e festival de leitura.  
                    " : "
                    The library was founded by Usina Santa Fé S.A. in 1999, with a collection of more than 12,000 books, internet 
                    access and a video library available for the entire community. The library organizes projects such as Cordel 
                    literature, Storytelling, Writing and a Reading Festival.
                    "; ?>
                </li>
                <li class="tagline"><span><?= ($idioma == 1) ? 'Programa de Visitas:' : 'Visit Program:'; ?></span>
                    <?= ($idioma == 1) ? "
                    proporcionar aos estudantes e familiares uma integração ao processo de produção.
                    " : "
                    to familiarize students and family members with the production process.
                    "; ?>
                    <ul>
                        <li><span><?= ($idioma == 1) ? 'Visita de Escolas:' : 'School Visits:'; ?></span>
                            <?= ($idioma == 1) ? "
                            Desde 2005 a Usina Santa Fé S.A. tem parceria com a ABAG da Região de Ribeirão Preto/SP em um programa 
                            educacional que trabalha o conceito do Agronegócio com professores e alunos das 
                            primeiras séries do ensino médio. O objetivo deste programa é levar conceitos fundamentais do Agronegócio 
                            aos alunos e através de visitas, possibilitarem a conexão entre teoria e prática.  
                            " : "
                            Since 2005, the Usina Santa Fé S.A. has partnered with the Ribeirão Preto branch of the Brazilian 
                            agribusiness association ABAG in an agribusiness educational program for teachers and beginning level 
                            secondary students.  The purpose of the program is to teach the students the fundamental concepts of 
                            agribusiness and organize visits so that they may link theory with practice.
                            "; ?>
                        </li>
                        <li><span><?= ($idioma == 1) ? 'Visita da Família:' : 'Family Visits:'; ?></span>
                            <?= ($idioma == 1) ? "
                            Este programa tem a proposta de que as famílias vivenciem um pouco da 
                            rotina da empresa, conhecendo as áreas Agrícola, Industrial, Hidrelétrica (um marco da história da Santa Fé, 
                            construída em 1920) e possibilitando a valorização do dia a dia dos colaboradores como também saúde e 
                            segurança do trabalho.  
                            " : "
                            This program is aimed at enabling employees' families to experience a little of the routine of the company, 
                            showing them the agricultural, industrial and hydroelectric plant (a landmark in Santa Fé's history, built 
                            in 1920) areas so that they may appreciate what the employees do, as well as learn about occupational health 
                            and safety.
                            "; ?>
                        </li>
                    </ul>
                </li>
                <div class="imagem_padrao imagem_direita">
                    <img src="themes/img/biblioteca.jpg" alt="<?= ($idioma == 1) ? 'Casa da Leitura' : 'Library'; ?>" title="<?= ($idioma == 1) ? 'Casa da Leitura' : 'Library'; ?>"/>
                    <h1><?= ($idioma == 1) ? 'Casa da Leitura' : 'Library'; ?></h1>
                </div>
                <li class="tagline"><span><?= ($idioma == 1) ? 'Programa Curso de Gestante:' : 'Course for Mothers-to-Be:'; ?></span>
                    <?= ($idioma == 1) ? "
                    Implantado em 1984, este programa visa orientações e cuidados da gestante e do bebê. 
                    " : "
                    Implanted in 1984, the program provides mothers-to-be with guidance on caring for themselves and their babies.
                    "; ?>
                </li>
                <li class="tagline"><span><?= ($idioma == 1) ? 'Projeto profissões:' : 'Professions project:'; ?></span>
                    <?= ($idioma == 1) ? "
                    Este projeto é direcionado aos jovens concluintes do ensino médio, orientando-os sobre as possíveis 
                    profissões que possam seguir.
                    " : "
                    This project is aimed at students finishing secondary education, providing them with career orientation.
                    "; ?>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
    </section>

    <div class="clear"></div>
</main>