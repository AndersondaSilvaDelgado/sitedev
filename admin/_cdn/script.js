$(function () {

    var viewPort = $(this).outerWidth();

    jQuery.fn.filterByText = function (textbox) {
        return this.each(function () {
            var select = this;
            var options = [];
            $(select).find('option').each(function () {
                options.push({value: $(this).val(), text: $(this).text()});
            });
            $(select).data('options', options);
            $(textbox).bind('change keyup', function () {
                var options = $(select).empty().data('options');
                var search = $.trim($(this).val());
                var regex = new RegExp(search, "gi");
                $.each(options, function (i) {
                    var option = options[i];
                    if (option.text.match(regex) !== null) {
                        $(select).append(
                                $('<option>').text(option.text).val(option.value)
                                );
                    }
                });
            });
        });
    };

    $('.menu_item').click(function () {
        $(this).children('.sub_menu_item').slideToggle();
    });

    $('.classe_form').change(function () {
        if ($(this).val() === "BANCÁRIO") {
            $('.senha_form').attr("disabled", false);
            $('.senha_form').attr("required", true);
        } else {
            $('.senha_form').attr("disabled", true);
            $('.senha_form').attr("required", false);
        }
    });

////////////////////////////////////////////////////////////////

    var dados;

    $(document).ready(function () {

        var m1 = new Date();
        var m2 = new Date();
        var m3 = new Date();
        var m4 = new Date();
        m1.setMonth(m1.getMonth() - 3);
        m2.setMonth(m2.getMonth() - 2);
        m3.setMonth(m3.getMonth() - 1);

        var mes1 = mes(m1.getMonth()) + '/20' + m1.getYear().toString().substring(1, 3);
        var mes2 = mes(m2.getMonth()) + '/20' + m2.getYear().toString().substring(1, 3);
        var mes3 = mes(m3.getMonth()) + '/20' + m3.getYear().toString().substring(1, 3);
        var mes4 = mes(m4.getMonth()) + '/20' + m4.getYear().toString().substring(1, 3);

        url = "logsite.php";

        if (window.XMLHttpRequest) { // Nao microsoft
            xhr = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            xhr = new ActiveXObject("Microsoft.XMLHttp");
        }

        xhr.open("GET", url, false);
        xhr.send();

        dados = eval('(' + xhr.responseText + ')');

        var valormes1 = 0;
        var valormes2 = 0;
        var valormes3 = 0;
        var valormes4 = 0;

        for (i = 0; i < dados.length; i++) {
            if (dados[i].MESANO.toString().substring(0, 2) === mes(m1.getMonth())) {
                valormes1 = parseInt(dados[i].QTDE);
            } else if (dados[i].MESANO.toString().substring(0, 2) === mes(m2.getMonth())) {
                valormes2 = parseInt(dados[i].QTDE);
            } else if (dados[i].MESANO.toString().substring(0, 2) === mes(m3.getMonth())) {
                valormes3 = parseInt(dados[i].QTDE);
            } else if (dados[i].MESANO.toString().substring(0, 2) === mes(m4.getMonth())) {
                valormes4 = parseInt(dados[i].QTDE);
            }
        }

        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'ACESSOS'
            },
            subtitle: {
                text: 'Qtde de acessos ao site'
            },
            xAxis: {
                categories: [
                    mes1.toString(),
                    mes2.toString(),
                    mes3.toString(),
                    mes4.toString()
                ],
                crosshair: true,
                title: {
                    text: 'MÊS/ANO'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'QTDE'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Acessos ',
                    data: [valormes1, valormes2, valormes3, valormes4]
                }]
        });

    });


});

function confirm_delete(url) {
    if (confirm("Deseja realmente excluir?")) {
        window.location.href = url;
    }
    return false;
}

function mes(v) {
    m = '';
    v = v + 1;
    if (v < 10) {
        m = '0' + v.toString();
    } else {
        m = v.toString();
    }
    return m;
}