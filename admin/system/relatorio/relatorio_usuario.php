<?php
$pesquisa = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$where = "";
$and = "";
$listaUsuario = "";
$listaClasse = "";

if (array_key_exists("LISTAUSUARIO", $pesquisa)):
    $listaUsuario = " CODIGO IN ( ";
    $cont = 1;
    foreach ($pesquisa['LISTAUSUARIO'] as $indice => $valor):
        if($cont == 1):
            $listaUsuario = $listaUsuario . ' ' . $valor;
            else:
            $listaUsuario = $listaUsuario . ', ' . $valor;
        endif;
        $cont++;
    endforeach;
    $listaUsuario = $listaUsuario . " )";
endif;

if (array_key_exists("LISTACLASSE", $pesquisa)):
    $listaClasse = " CLASSE IN ( ";
    $cont = 1;
    foreach ($pesquisa['LISTACLASSE'] as $indice => $valor):
        if($cont == 1):
            $listaClasse = $listaClasse . ' ' . $valor;
            else:
            $listaClasse = $listaClasse . ', ' . $valor;
        endif;
        $cont++;
    endforeach;
    $listaClasse = $listaClasse . " )";
endif;

if((array_key_exists("LISTAUSUARIO", $pesquisa)) || (array_key_exists("LISTACLASSE", $pesquisa))):
    $where = " WHERE ";
endif;

if((array_key_exists("LISTAUSUARIO", $pesquisa)) && (array_key_exists("LISTACLASSE", $pesquisa))):
    $and = " AND ";
endif;

$pdf = new FPDF('P', 'cm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 7);

$pdf->SetTitle('RELATORIO DE USUARIOS', true);

$read = new Read;
$read->ExeReadMod("SELECT "
                    . "CODIGO "
                    . ", NOME "
                    . ", INSTITUICAO "
                    . ", USUARIO "
                    . ", EMAIL "
                    . ", SENHA "
                    . ", CLASSE "
                    . ", STATUS "
                    . ", NIVEL "
                    . ", DATA "
                . " FROM "
                    . " SITE_USUARIO "
                . " {$where} "
                . " {$listaUsuario} "
                . " {$and} "
                . " {$listaClasse} "
                . " ORDER BY "
                    . " NOME "
                . " ASC");

$pdf->Cell(1, 1, 'COD', 1, 0, 'C');
$pdf->Cell(5, 1, 'NOME', 1, 0, 'C');
$pdf->Cell(3.3, 1, 'INSTITUICAO', 1, 0, 'C');
$pdf->Cell(5, 1, 'EMAIL', 1, 0, 'C');
$pdf->Cell(3, 1, 'USUARIO', 1, 0, 'C');
$pdf->Cell(1.6, 1, 'SENHA', 1, 0, 'C');

$pdf->Ln();

$pdf->SetFont('');
if ($read->getResult()):
    foreach ($read->getResult() as $user):
        extract($user);

        $pdf->Cell(1, 1, $CODIGO, 1, 0, 'C');
        $pdf->Cell(5, 1, $NOME, 1, 0, 'L');
        $pdf->Cell(3.3, 1, utf8_decode($INSTITUICAO), 1, 0, 'L');
        $pdf->Cell(5, 1, $EMAIL, 1, 0, 'C');
        $pdf->Cell(3, 1, $USUARIO, 1, 0, 'C');
        $pdf->Cell(1.6, 1, $SENHA, 1, 0, 'C');
        $pdf->Ln();

    endforeach;
endif;

$pdf->Output('relatorio.pdf', 'F');
?>
<iframe src="relatorio.pdf" class="relatorio_princ content" style="border: none;"></iframe>




