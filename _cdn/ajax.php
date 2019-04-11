<?php

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require ('../_app/Config.inc.php');

$codigoRet = 1;

$read = new Read;
$read->ExeReadMod('SELECT MAX(CODIGO) AS CODIGO FROM SITE_LOG_RELATORIO');

if ($read->getResult()):

    foreach ($read->getResult() as $categoria):
        extract($categoria);

        $codigoRet = $CODIGO + 1;

    endforeach;

endif;

$readDoc = new Read;
$readDoc->ExeReadMod("SELECT * FROM SITE_RELATORIO WHERE CODIGO = {$post['doc']}");


$inserirLog = new Create;
$dados = array("CODIGO" => $codigoRet,
    "CODUSUARIO" => $post['user'],
    "DESCACESSO" => $readDoc->getResult()[0]['DESCRICAO'],
    "DATA" => date('d/m/Y H:i:s'),
    "CODRELATORIO" => $post['doc']
);
$inserirLog->ExeCreate('SITE_LOG_RELATORIO', $dados);
