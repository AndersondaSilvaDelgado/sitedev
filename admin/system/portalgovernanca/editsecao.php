<?php
$idCategoria = filter_input(INPUT_GET, 'idcategoria', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$codParente = filter_input(INPUT_GET, 'idcodparente', FILTER_VALIDATE_INT);

$descricaoRet = '';
$destaqueRet = 0;
$codigoRet = 0;
$codParenteRet = 0;
$posicaoRet = 1;
$dataRet = '';

require_once '_models/AdminCategoria.class.php';
$adminCategoria = new AdminCategoria();

if ($status == 'updatesecao'){

    $secaoList = $adminCategoria->ReadCod(1, $idCategoria);

    if ($secaoList){

        foreach ($secaoList as $categoria){
            extract($categoria);

            $descricaoRet = $DESCRICAO;
            $codigoRet = $CODIGO;
            $codParenteRet = $CODPARENTE;
            $posicaoRet = $POSICAO;
            $dataRet = $DATA;

        }

    }

}
elseif ($status == 'createsecao'){

    $codParenteRet = $codParente;
    $codigoRet = $adminCategoria->Sequencia(1);
    $posicaoRet = $adminCategoria->Posicao(1);
    
}
?>
<div >

    <h1 class="title_crud">EDIÇÃO DE CATEGORIA</h1>

    <div class="content">

        <form name="PostForm" action="painel.php?exe=documentos/index&status=<?= $status; ?><?= ($status == 'updatesecao' ? '&idcategoria=' . $idCategoria . '' : '') ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="CODIGO" value="<?= $codigoRet; ?>" />

            <div class="label_line">
                <label class="label label_larger">
                    <span class="field">Descrição:</span>
                    <input 
                        type="text" 
                        name="DESCRICAO" 
                        value="<?= $descricaoRet; ?>" 
                        required
                        />
                </label>
            </div>
            
            <input type="hidden" name="CODPARENTE" value="<?= $codParenteRet; ?>" />
            <input type="hidden" name="POSICAO" value="<?= $posicaoRet; ?>" />

            <div class="label_line">

                <label class="label_medium">
                    <span class="field">Data:</span>
                    <input 
                        type="text" 
                        class="formDate center" 
                        name="DATA" 
                        <?php
                        if ($status == 'createsecao'):
                            ?>
                            value="<?= date('d/m/Y H:i:s'); ?>" 
                            <?php
                        elseif ($status == 'updatesecao'):
                            ?>
                            value="<?= $dataRet; ?>" 
                            <?php
                        endif;
                        ?>
                        required
                        readonly
                        />
                </label>

            </div>


            <div class="label_line botoes">
                <input type="submit" class="btn blue" value="Salvar" name="SendPostForm" />
                <input type="button" onclick="window.location.href = 'painel.php?exe=documentos/index'; return false;" class="btn red" value="Cancelar" name="SendPostForm" />
            </div>

        </form>

    </div>
    
</div>
