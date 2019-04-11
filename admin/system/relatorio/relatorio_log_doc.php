<?php
$pesquisa = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$listaUsuario = "";
$listaClasse = "";

if (array_key_exists("LISTAUSUARIO", $pesquisa)):
    $listaUsuario = " SUR.CODIGO IN ( ";
    $cont = 1;
    foreach ($pesquisa['LISTAUSUARIO'] as $indice => $valor):
        if($cont == 1):
            $listaUsuario = $listaUsuario . ' ' . $valor;
            else:
            $listaUsuario = $listaUsuario . ', ' . $valor;
        endif;
        $cont++;
    endforeach;
    $listaUsuario = $listaUsuario . " ) AND ";
endif;

if (array_key_exists("LISTACLASSE", $pesquisa)):
    $listaClasse = " SUR.CLASSE IN ( ";
    $cont = 1;
    foreach ($pesquisa['LISTACLASSE'] as $indice => $valor):
        if($cont == 1):
            $listaClasse = $listaClasse . ' ' . $valor;
            else:
            $listaClasse = $listaClasse . ', ' . $valor;
        endif;
        $cont++;
    endforeach;
    $listaClasse = $listaClasse . " ) AND ";
endif;

$pdf = new FPDF('P', 'cm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 7);

$pdf->SetTitle('RELATORIO DE USUARIOS', true);

$sql = " SELECT "
        . " TO_CHAR(SLR.DATA, 'DD/MM/YYYY HH24:MI:SS') AS DATA "
        . " , SUR.NOME AS NOME "
        . " , SLR.DESCACESSO AS DESCACESSO "
        . " , CASE WHEN SLR.CODRELATORIO IS NULL THEN 'ACESSO A PAGINA INICIAL' ELSE 'DOWNLOAD: ' END "
        . " || "
        . " CASE WHEN SCR4.DESCRICAO IS NULL THEN '' ELSE (SCR4.DESCRICAO || ' -> ') END "
        . " || "
        . " CASE WHEN SCR3.DESCRICAO IS NULL THEN '' ELSE (SCR3.DESCRICAO || ' -> ') END "
        . " || "
        . " CASE WHEN SCR2.DESCRICAO IS NULL THEN '' ELSE (SCR2.DESCRICAO || ' -> ') END "
        . " || "
        . " CASE WHEN SCR1.DESCRICAO IS NULL THEN '' ELSE (SCR1.DESCRICAO || ' -> ') END "
        . " ||  "
        . " CASE WHEN SLR.CODRELATORIO IS NULL THEN '' ELSE SLR.DESCACESSO END "
        . " AS DESCACESSO "
        . " FROM "
        . " SITE_LOG_RELATORIO SLR "
        . " , SITE_USUARIO SUR "
        . " , SITE_RELATORIO SRL "
        . " , SITE_CATEGORIA_RELATORIO SCR1 "
        . " , SITE_CATEGORIA_RELATORIO SCR2 "
        . " , SITE_CATEGORIA_RELATORIO SCR3 "
        . " , SITE_CATEGORIA_RELATORIO SCR4 "
        . " WHERE "
        . " (SLR.DATA BETWEEN TO_DATE('{$pesquisa["DATAINICIAL"]}', 'YYYY-MM-DD') AND (TO_DATE('{$pesquisa["DATAFINAL"]}', 'YYYY-MM-DD') + 1)) "
        . " AND "
        . " {$listaUsuario} "
        . " {$listaClasse} "
        . " SLR.CODUSUARIO = SUR.CODIGO "
        . " AND SRL.CODIGO(+)    = SLR.CODRELATORIO "
        . " AND SCR1.CODIGO(+)   = SRL.SECAO "
        . " AND SCR2.CODIGO(+)   = SCR1.CODPARENTE "
        . " AND SCR3.CODIGO(+)   = SCR2.CODPARENTE "
        . " AND SCR4.CODIGO(+)   = SCR3.CODPARENTE "
        . " ORDER BY "
        . " SLR.DATA "
        . " DESC ";
   
$read = new Read;
$read->ExeReadMod($sql);

$col1 = 2.8;
$col2 = 5;
$col3 = 19 - $col1 - $col2;
$linha = 0.8;

$pdf->Cell(19, 1, utf8_decode('RELATÓRIO DE LOG - DOCUMENTO'), 0, 0, 'C');

$pdf->Ln();

$pdf->Cell($col1, $linha, 'DATA', 1, 0, 'C');
$pdf->Cell($col2, $linha, 'NOME', 1, 0, 'C');
$pdf->Cell($col3, $linha, utf8_decode('DESCRIÇÃO ACESSO'), 1, 0, 'C');

$pdf->Ln();

$pdf->SetFont('');
if ($read->getResult()):
    foreach ($read->getResult() as $log):
        extract($log);
        $pdf->Cell($col1, $linha, $DATA, 1, 0, 'C');
        $pdf->Cell($col2, $linha, utf8_decode($NOME), 1, 0, 'L');
        $pdf->Cell($col3, $linha, utf8_decode($DESCACESSO), 1, 0, 'L');
        $pdf->Ln();
    endforeach;
endif;

$pdf->Output('relatorio.pdf', 'F');
?>
<iframe src="relatorio.pdf" class="relatorio_princ content" style="border: none;"></iframe>