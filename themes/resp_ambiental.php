<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <section class="container">
        <div class="content padrao ambiental">
            <h1 class="titulo_padrao"><?= ($idioma == 1) ? 'Responsabilidade Ambiental' : 'Environmental Responsibility'; ?></h1>
            <p class="tagline texto_princ">
                <?= ($idioma == 1) ? "
                A Usina Santa Fé S.A. está comprometida em promover o respeito pelo meio ambiente em todo seu 
                processo produtivo, compatibilizando suas atividades, produtos e serviços mantendo-os em equilíbrio com os 
                princípios da Sustentabilidade. A Companhia conta com tecnologias e iniciativas industriais e agrícolas, as 
                quais proporcionam a redução de impactos ao meio ambiente, otimizando assim sua eficiência operacional.
                " : "
                Usina Santa Fé S.A. is committed to promoting environmental care throughout its production process, ensuring 
                its activities, products and services are aligned with the principles of sustainability. The company employs 
                technologies as well as industrial and agricultural initiatives that drive reductions in environmental impacts, 
                optimizing its operational efficiency. 
                "; ?>
            </p>
            <article >
                <h2><?= ($idioma == 1) ? 'Ar' : 'Air'; ?></h2>
                <p class="tagline texto_seg">
                    <?= ($idioma == 1) ? "
                    Anualmente as caldeiras têm suas emissões atmosféricas monitoradas a fim de atender a legislação 
                    vigente e assim evitar a poluição do ar. Eliminação da queima da palha da cana-de-açúcar com 100% da colheita 
                    mecanizável: a Usina Santa Fé é signatária do Protocolo Agroambiental e recebe, anualmente, o Certificado Etanol 
                    Verde. Este Certificado reconhece as boas práticas desenvolvidas pela Empresa, em relação à necessidade de organizar 
                    a atividade agrícola e industrial de modo a promover a adequação ambiental e minimizar, conseqüentemente, os impactos 
                    sobre o meio ambiente e a sociedade. Mantém Programa Interno de Auto fiscalização da Correta Manutenção da Frota 
                    quanto a Emissão de Fumaça Preta.
                    " : "
                    Atmospheric emissions from the boilers are monitored on an annual basis to ensure compliance with the legislation 
                    in force and to prevent air pollution. Elimination of sugarcane straw burning with 100% mechanized harvesting: Usina 
                    Santa Fé S.A. is a signatory to the São Paulo state government's Agro-Environmental Protocol and receives the Green 
                    Ethanol certificate annually. This certificate is in recognition of the best practices developed by the company in 
                    organizing agricultural and industrial activities in an environmentally correct manner, reducing impacts on the 
                    environment and society. The mill maintains an internal program to ensure proper fleet maintenance and minimize 
                    black smoke emissions. 
                    "; ?>
                </p>
            </article>
            <article >
                <h2><?= ($idioma == 1) ? 'Energia Elétrica' : 'Electricity'; ?></h2>
                <p class="tagline texto_seg">
                    <?= ($idioma == 1) ? "
                    A Usina Santa Fé S.A. produz sua própria energia elétrica gerada a partir da queima do bagaço de cana 
                    em caldeiras (energia limpa e renovável) e é suficiente para suprir todo o seu consumo.
                    " : "
                    Usina Santa Fé S.A. generates all the electricity it consumes by burning sugarcane bagasse in its 
                    boilers (clean, renewable energy). 
                    "; ?>
                </p>
            </article>
            <div class="imagem_padrao imagem_esquerda">
                <img src="themes/img/resfriamento.jpg"/>
                <h1><?= ($idioma == 1) ? 'Represa de Resfriamento de Água' : 'Water Cooling Dam'; ?></h1>
            </div>
            <article>
                <h2><?= ($idioma == 1) ? 'Água' : 'Water'; ?></h2>
                <p class="tagline texto_seg"><span><?= ($idioma == 1) ? 'Uso e Reuso das Águas:' : 'Use and reuse:'; ?></span>
                    <?= ($idioma == 1) ? "
                    dentro do processo industrial existem os sistemas de circuitos fechados, onde a água é tratada e recirculada, 
                    ocasionando numa redução significativa na taxa de utilização de água por tonelada de cana-de-açúcar.
                    " : "
                    the industrial process contains closed circuit systems in which water is treated and recirculated, driving 
                    a significant reduction in the amount of water consumed per metric ton of sugarcane produced. 
                    "; ?>
                    <br />
                    <span><?= ($idioma == 1) ? 'Proteção de Matas:' : 'Protection of vegetation:'; ?></span> 
                    <?= ($idioma == 1) ? "
                    todas as áreas de vegetação florestal, matas ciliares e nascentes estão protegidas e conservadas para 
                    manter a qualidade das águas existentes nas propriedades da Usina.
                    " : "
                    all the forestry, riparian and waterside vegetation areas are protected and conserved to ensure the 
                    quality of water on the mill's properties. 
                    "; ?>
                </p>
            </article>
            <article>
                <h2><?= ($idioma == 1) ? 'Gestão de Resíduos' : 'Waste management'; ?></h2>
                <p class="tagline texto_terc">
                    <?= ($idioma == 1) ? "
                    Avaliação integrada de todo processo de geração de resíduos, provenientes das áreas agrícola, industrial 
                    e administrativa, buscando novas soluções para redução de custos e riscos ambientais. Processos de geração, estocagem 
                    temporária e destinação final, todos de forma ambientalmente correta.
                    " : "
                    Integrated assessment of the entire waste generation process, ranging from agricultural and industrial to administrative 
                    activities, seeking new solutions to reduce costs and environmental risk. The generation, temporary storage and final 
                    disposal processes are all conducted in an environmentally correct manner. 
                    "; ?>
                </p>
            </article>
            <article>
                <h2><?= ($idioma == 1) ? 'Subprodutos Industrias' : 'Industrial byproducts'; ?></h2>
                <p class="tagline texto_terc">
                    <?= ($idioma == 1) ? "
                    A vinhaça, torta de filtro, aguas residuarias do processo e fuligem são subprodutos gerados no processo 
                    industrial que são utilizados para aplicação em solo agrícola.
                    " : "
                    Vinasse, filter cake, process residual water and soot are byproducts generated in the industrial process 
                    and are applied to the soil in the agricultural areas. 
                    "; ?>
                    <br />
                    <span><?= ($idioma == 1) ? 'Vinhaça:' : 'Vinasse:'; ?></span>
                    <?= ($idioma == 1) ? "
                    Rica em potássio, a aplicação da vinhaça (fertirrigação) possui aprovação da CETESB, atendendo a Norma 
                    Técnica P-4.231, que define critérios e procedimentos para aplicação de vinhaça no solo agrícola visando a 
                    segurança no bombeamento, condução, armazenamento e aplicação dos efluentes, formalizados no PAV – Plano de 
                    Aplicação de Vinhaça, exigido pelo órgão ambiental e entregue anualmente antes do início da safra, onde são 
                    previamente definidas as áreas de aplicação, as quantidades a serem aplicadas (taxa de aplicação) e a 
                    caracterização química do solo.
                    " : "
                    Rich in potassium, the application of vinasse (fertigation) is approved by the environmental agency CETESB 
                    and is compliant with the P-4.231 Standard, which establishes the criteria and procedures for applying vinasse 
                    to agricultural land. These procedures ensure safety in pumping, transporting, storing and applying the 
                    effluents and are formalized in the Vinasse Application Plan required by the authority. The plan defines the 
                    area where the vinasse will be applied, the amounts to be used (application rate) and the chemical composition 
                    of the soil.
                    "; ?>
                    <br />
                    <span><?= ($idioma == 1) ? 'Torta de Filtro:' : 'Filter Cake:'; ?></span>
                    <?= ($idioma == 1) ? "
                    Rica em fósforo, sua utilização na lavoura canavieira substitui ou complementa a adubação mineral do plantio
                    " : "
                    Rich in phosphorus, the filter cake substitutes or complements the use of mineral fertilizers in planting. 
                    "; ?>
                </p>
            </article>
            <div class="imagem_padrao imagem_direita">
                <img src="themes/img/reflorestamento.jpg"/>
                <h1><?= ($idioma == 1) ? 'Reflorestamento' : 'Reforestation'; ?></h1>
            </div>
            <article>
                <h2><?= ($idioma == 1) ? 'Reflorestamento' : 'Reforestation'; ?></h2>
                <p class="tagline texto_terc">
                    <span><?= ($idioma == 1) ? 'Áreas, Preservação Permanente e Reserva Legal' : 'Permanent Preservation and Legal Reserve Areas'; ?></span>
                    <br />
                    <?= ($idioma == 1) ? "
                    Esse programa tem como objetivo proteger a cobertura vegetal das APP’s e Reservas Legais existentes em áreas 
                    próprias da Usina Santa Fé S.A., permitindo que haja um incremento na diversidade de espécies típicas das formações originais da 
                    região; além de auxiliar o papel da vegetação ciliar como corredores ecológicos; e evitar o surgimento de processos erosivos 
                    e de sedimentação indesejada nos cursos d'água.
                    " : "
                    The purpose of this program is to protect the vegetation coverage in the permanent protection and legal reserve areas 
                    on the land owned by the Usina Santa Fé S.A., driving an increase in the diversity of the typical original species in 
                    the region, as well as enabling the riparian vegetation to serve as ecological corridors and preventing erosion and 
                    sedimentation in water courses. 
                    "; ?>
                    <br />
                    <span><?= ($idioma == 1) ? 'Manejo de Fauna:' : 'Stewardship of Fauna:'; ?></span>
                    <?= ($idioma == 1) ? "
                    Com a eliminação da queima da palha da cana-de-açúcar da Usina Santa Fé S.A., que já atinge 100%, 
                    pode ser considerada também como uma vantagem à preservação da fauna, uma vez que os animais não correm 
                    mais o risco de se acidentarem com o fogo. Foi realizado o levantamento da fauna da área de influência 
                    direta da Usina Santa Fé S.A. para mastofauna, avifauna, herpetofauna e ictiofauna. Este levantamento visa monitorar 
                    e identificar as comunidades que vivem nas áreas do entorno da usina.
                    " : "
                    The complete elimination of the burning of sugarcane straw at the Usina Santa Fé S.A. may be considered advantageous for 
                    preserving fauna since the animals no longer run the risk of being accidentally burned. A survey of the fauna in 
                    the Usina Santa Fé S.A. direct area of influence was undertaken, encompassing species of mammals, birds, amphibians, 
                    reptiles and fish, with the purpose of identifying and monitoring the communities in the areas surrounding the mill. 
                    "; ?>
                </p>
            </article>
            <article>
                <h2><?= ($idioma == 1) ? 'Conservação de Solo' : 'Soil Conservation '; ?></h2>
                <p class="tagline texto_terc">
                    <?= ($idioma == 1) ? "
                    Proteger a terra é garantir o futuro, pensando nisso a usina Santa Fé desenvolveu seu manejo aliando experiência e 
                    conhecimento da conservação de solos tradicional com o que existe de mais moderno na tecnologia, gerando um resultado 
                    muito preciso, eficiente e seguro. Utilizamos uma sofisticada rede de sistema GNSS para mapeamento e sistematização 
                    de áreas, em conjunto com um manejo de preparo reduzido e rotação com outras culturas como a soja, protegendo e 
                    produzindo em nossos solos ao mesmo tempo.
                    " : "
                    Protecting the land means ensuring the future. It was with this purpose that Santa Fé developed its 
                    stewardship, allying its experience and traditional know-how in soil conservation with leading edge technological 
                    developments to produce very accurate, efficient and safe results. We use a sophisticated GNSS network to map and 
                    systematize the areas, along with reduced tillage techniques and rotation with other crops such as soy, protecting 
                    our soil while guaranteeing its productivity.  
                    "; ?>
                </p>
            </article>
            <div class="imagem_padrao imagem_esquerda">
                <img src="themes/img/larva.jpg"/>
                <h1><?= ($idioma == 1) ? 'Controle Biológico de Pragas' : 'Biological Pest Control'; ?></h1>
            </div>
            <article>
                <h2><?= ($idioma == 1) ? 'Controle Biológico de Pragas' : 'Biological Pest Control'; ?></h2>
                <p class="tagline texto_terc">
                    <?= ($idioma == 1) ? "
                    Controle biológico de pragas é um método eficaz, seguro e ecologicamente sustentável. A Usina Santa 
                    Fé S.A. possui uma Biofábrica na criação de parasitoides (Cotesia flavipes) no controle da broca da cana-de-açúcar e o fungo 
                    entomopatogênico (Metharizium anisopilae) no controle da cigarrinha das raízes da cana-de-açúcar. Com isso contribuindo com 
                    práticas sustentáveis ao meio ambiente.
                    " : "
                    Biological pest control is safe, effective and ecologically sustainable. Usina Santa Fé S.A. has a biofactory that breeds 
                    parasitoids (Cotesia flavipes) to control the sugarcane borer and entomopathogenic fungus (Metharizium anisopilae) for 
                    the sugarcane spittlebug. These are sustainable environmental practices.
                    "; ?>
                </p>
            </article>
        </div>
    </section>

    <div class="clear"></div>
</main>
