<main>

    <div class="espacamento_cabecalho">
        <div class="clear"></div>
    </div>

    <section class="container">
        <div class="content">
            <h1 class="titulo_padrao"><?= ($idioma == 1) ? 'Localização' : 'Location'; ?></h1>
        </div>
    </section>

    <section class="mapa">
        <iframe width="100%" height="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59264.28708572633!2d-48.61391209015974!3d-21.818237624109106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4ace1a71901809ec!2sUsina+Santa+F%C3%A9!5e0!3m2!1spt-BR!2sbr!4v1476205079186"></iframe>
    </section>
    <div class="clear"></div>

    <section class="localizacao local">
        <h1 ><?= ($idioma == 1) ? 'Endereço' : 'Address'; ?></h1>
        <p class="tagline">Estr. da Antiga Fazenda Itaquerê, s/n - Caixa Postal 11</p>
        <p class="tagline">CEP: 14.920-0000</p>
        <p class="tagline">Nova Europa - S.P</p>
        <p class="tagline">Fone: +55 16 3387 9900</p>
        <p class="tagline">Fax: +55 16 3387 1504</p>
        <p class="tagline"><?= ($idioma == 1) ? 'Site:' : 'Website:'; ?> www.usinasantafe.com.br</p>
        <p class="tagline"><?= ($idioma == 1) ? 'E-mail:' : 'Email:'; ?> usinasantafe@usinasantafe.com.br</p>
        <p class="tagline"><?= ($idioma == 1) ? 'Sac:' : 'Contact center:'; ?> sac@usinasantafe.com.br</p>
    </section>
    <section class="localizacao logistico">
        <h1 ><?= ($idioma == 1) ? 'Detalhes Logísticos' : 'Logistics details'; ?></h1>
        <label>
            <span><?= ($idioma == 1) ? 'Aeroportos mais próximos da empresa:' : 'Closest airports to the company:'; ?></span>
        </label>
        <table >
            <tr>
                <td class="descr_titulo"><?= ($idioma == 1) ? 'Aeroporto' : 'Airport'; ?></td>
                <td class="tipo_titulo"><?= ($idioma == 1) ? 'Cidade' : 'City'; ?></td>
                <td class="qtde_titulo"><?= ($idioma == 1) ? 'Distância(km)' : 'Distance(km)'; ?></td>
            </tr>
            <tr>
                <td class="descr">Aeroporto Internacional de São Paulo</td>
                <td class="tipo">Guarulhos</td>
                <td class="qtde">346</td>
            </tr>
            <tr>
                <td class="descr">Aeroporto de São Paulo/Congonhas</td>
                <td class="tipo">São Paulo</td>
                <td class="qtde">332</td>
            </tr>
            <tr>
                <td class="descr">Aeroporto Internacional de Viracopos</td>
                <td class="tipo">Campinas</td>
                <td class="qtde">245</td>
            </tr>
            <tr>
                <td class="descr">Aeroporto Estadual Dr. Leite Lopes</td>
                <td class="tipo">Ribeirão Preto</td>
                <td class="qtde">146</td>
            </tr>
            <tr>
                <td class="descr">Aeroporto Estadual Bartolomeu de Gusmão</td>
                <td class="tipo">Araraquara</td>
                <td class="qtde">56</td>
            </tr>
        </table>
        <label>
            <span><?= ($idioma == 1) ? 'Portos mais próximos da empresa:' : 'Closest ports to the company:'; ?></span>
        </label>
        <table >
            <tr>
                <td class="descr_titulo"><?= ($idioma == 1) ? 'Portos' : 'Ports'; ?></td>
                <td class="tipo_titulo"><?= ($idioma == 1) ? 'Cidade' : 'City'; ?></td>
                <td class="qtde_titulo"><?= ($idioma == 1) ? 'Distância(km)' : 'Distance(km)'; ?></td>
            </tr>
            <tr>
                <td class="descr">Portos de Santos - CODESP</td>
                <td class="tipo">Santos</td>
                <td class="qtde">425</td>
            </tr>
            <tr>
                <td class="descr">Porto de Paranaguá</td>
                <td class="tipo">Paranaguá(PR)</td>
                <td class="qtde">736</td>
            </tr>
        </table>
    </section>
    <div class="clear"></div>

</main>
