<?php

require('../_app/Config.inc.php');

$read = new Read;
$read->ExeReadMod("SELECT "
                        . " TO_CHAR(DATA, 'MM/YYYY') AS MESANO "
                        . " , COUNT(DESCACESSO) AS QTDE "
                    . " FROM "
                        . " SITE_LOG "
                    . " GROUP BY "
                        . " TO_CHAR(DATA, 'MM/YYYY'), DESCACESSO"
                    . " HAVING"
                        . " DESCACESSO = 'index.php'");
//
//$dados = array("CODIGO" => 1,
//            "DATA" => date('d/m/Y H:i:s'),
//            "DESCACESSO" => "TESTE"
//        );

    $dados = $read->getResult();

        echo json_encode($dados);