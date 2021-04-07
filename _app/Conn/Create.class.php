<?php

/**
 * <b>Create.class:</b>
 * Classe responsável por cadastros genéticos no banco de dados!
 * 
 * @copyright (c) 2013, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class Create extends Conn {

    private $Tabela;
    private $Dados;
    private $Result;

    /** @var PDOStatement */
    private $Create;

    /** @var PDO */
    private $Conn;

    /**
     * <b>ExeCreate:</b> Executa um cadastro simplificado no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e um array atribuitivo com nome da coluna e valor!
     * 
     * @param STRING $Tabela = Informe o nome da tabela no banco!
     * @param ARRAY $Dados = Informe um array atribuitivo. ( Nome Da Coluna => Valor ).
     */
    public function ExeCreate($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $this->getSyntax();
        $this->Execute();
        
    }
    
    public function ExeCreateColaborador($Tabela, array $Dados) {
        
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $Conn = parent::getConn();

        $sql = "INSERT INTO " . $this->Tabela 
                    . " (CODIGO " 
                    . " , MATRICULA "
                    . " , STATUS " 
                    . " , DATA) "
                . " VALUES "
                    . " ( ? "
                    . " , ? "
                    . " , ? "
                    . " , SYSDATE)";
        
        $matric = substr($Dados['MATRICULA'], 0 ,strrpos($Dados['MATRICULA'],'-'));
        
        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, $this->Dados['CODIGO'], PDO::PARAM_INT, 32);
        $stmt->bindParam(2, trim($matric), PDO::PARAM_INT, 10);
        $stmt->bindParam(3, $this->Dados['STATUS'], PDO::PARAM_INT, 10);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
        if (isset($this->Dados['OPCAO1'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO1']);
        }
        
        if (isset($this->Dados['OPCAO2'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO2']);
        }

        if (isset($this->Dados['OPCAO3'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO3']);
        }
        
        if (isset($this->Dados['OPCAO4'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO4']);
        }

        if (isset($this->Dados['OPCAO5'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO5']);
        }
        
        if (isset($this->Dados['OPCAO6'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO6']);
        }

        if (isset($this->Dados['OPCAO7'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO7']);
        }
        
        if (isset($this->Dados['OPCAO8'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO8']);
        }

        if (isset($this->Dados['OPCAO9'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO9']);
        }
        
        if (isset($this->Dados['OPCAO10'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO10']);
        }
        
        if (isset($this->Dados['OPCAO11'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO11']);
        }
        
        if (isset($this->Dados['OPCAO12'])){
            $this->ExeCreateRColabNivel($this->Dados['CODIGO'], $this->Dados['OPCAO12']);
        }
        
    }
    
    public function ExeCreateTerceiro($Tabela, array $Dados) {
        
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $Conn = parent::getConn();

        $sql = "INSERT INTO " . $this->Tabela 
                    . " (CODIGO " 
                    . " , NOME " 
                    . " , INSTITUICAO "
                    . " , USUARIO "
                    . " , EMAIL "
                    . " , SENHA "
                    . " , CLASSE "
                    . " , STATUS " 
                    . " , DATA) "
                . " VALUES "
                    . " ( ? "
                    . " , ? "
                    . " , ? "
                    . " , ? "
                    . " , ? "
                    . " , ? "
                    . " , ? "
                    . " , ? "
                    . " , SYSDATE)";
        
        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, $this->Dados['CODIGO'], PDO::PARAM_INT, 32);
        $stmt->bindParam(2, $this->Dados['NOME'], PDO::PARAM_STR, strlen($this->Dados['NOME']));
        $stmt->bindParam(3, $this->Dados['INSTITUICAO'], PDO::PARAM_STR, strlen($this->Dados['INSTITUICAO']));
        $stmt->bindParam(4, $this->Dados['USUARIO'], PDO::PARAM_STR, strlen($this->Dados['USUARIO']));
        $stmt->bindParam(5, $this->Dados['EMAIL'], PDO::PARAM_STR, strlen($this->Dados['EMAIL']));
        $stmt->bindParam(6, $this->Dados['SENHA'], PDO::PARAM_STR, strlen($this->Dados['SENHA']));
        $stmt->bindParam(7, $this->Dados['CLASSE'], PDO::PARAM_STR, strlen($this->Dados['CLASSE']));
        $stmt->bindParam(8, $this->Dados['STATUS'], PDO::PARAM_INT, 10);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
        if (isset($this->Dados['OPCAO1'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO1']);
        }
        
        if (isset($this->Dados['OPCAO2'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO2']);
        }

        if (isset($this->Dados['OPCAO3'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO3']);
        }
        
        if (isset($this->Dados['OPCAO4'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO4']);
        }

        if (isset($this->Dados['OPCAO5'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO5']);
        }
        
        if (isset($this->Dados['OPCAO6'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO6']);
        }

        if (isset($this->Dados['OPCAO7'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO7']);
        }
        
        if (isset($this->Dados['OPCAO8'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO8']);
        }

        if (isset($this->Dados['OPCAO9'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO9']);
        }
        
        if (isset($this->Dados['OPCAO10'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO10']);
        }
        
        if (isset($this->Dados['OPCAO11'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO11']);
        }
        
        if (isset($this->Dados['OPCAO12'])){
            $this->ExeCreateRTercNivel($this->Dados['CODIGO'], $this->Dados['OPCAO12']);
        }
        
    }
    
    public function ExeCreateRTercNivel($codigo, $opcao) {
        
        $Conn = parent::getConn();
        
        $sql = "INSERT INTO SITE_R_TERCEIRO_NIVEL (COD_TERCEIRO, COD_NIVEL) VALUES ( ?, ?)";

        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, $codigo, PDO::PARAM_INT, 32);
        $stmt->bindParam(2, $opcao, PDO::PARAM_INT, 32);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
    }
    
    public function ExeCreateRColabNivel($codigo, $opcao) {
        
        $Conn = parent::getConn();
        
        $sql = "INSERT INTO SITE_R_COLABORADOR_NIVEL (COD_COLABORADOR, COD_NIVEL) VALUES ( ?, ?)";

        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, $codigo, PDO::PARAM_INT, 32);
        $stmt->bindParam(2, $opcao, PDO::PARAM_INT, 32);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
    }
    
    public function ExeCreateNoticia($Tabela, array $Dados) {
        
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $Conn = parent::getConn();

        $sql = "INSERT INTO {$this->Tabela} (CODIGO, TITULO, STATUS, CONTEUDO, CAPA, DATA)
                VALUES ( ?, ?, ?, ?, ?, SYSDATE)";
        
        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, $this->Dados['CODIGO'], PDO::PARAM_INT, 32);
        $stmt->bindParam(2, $this->Dados['TITULO'], PDO::PARAM_STR, strlen($this->Dados['TITULO']));
        $stmt->bindParam(3, $this->Dados['STATUS'], PDO::PARAM_INT, 32);
        $stmt->bindParam(4, $this->Dados['CONTEUDO'], PDO::PARAM_STR, strlen($this->Dados['CONTEUDO']));
        $stmt->bindParam(5, $this->Dados['CAPA'], PDO::PARAM_INT, 70);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
    }
    
    public function ExeCreateVaga($Tabela, array $Dados) {
        
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $Conn = parent::getConn();

        $sql = "INSERT INTO {$this->Tabela} (CODIGO, DESCRICAO, QTDE, DESCRITIVO, TIPO, DATA)
                VALUES ( ?, ?, ?, ?, ?, SYSDATE)";
        
        $stmt = $Conn->prepare($sql);
        $stmt->bindParam(1, $this->Dados['CODIGO'], PDO::PARAM_INT, 32);
        $stmt->bindParam(2, $this->Dados['DESCRICAO'], PDO::PARAM_STR, strlen($this->Dados['DESCRICAO']));
        $stmt->bindParam(3, $this->Dados['STATUS'], PDO::PARAM_INT, 32);
        $stmt->bindParam(4, $this->Dados['DESCRITIVO'], PDO::PARAM_STR, strlen($this->Dados['DESCRITIVO']));
        $stmt->bindParam(5, $this->Dados['TIPO'], PDO::PARAM_INT, 32);

        $Conn->beginTransaction();
        $stmt->execute();
        $Conn->commit();
        
    }
    
    
    /**
     * <b>Obter resultado:</b> Retorna o ID do registro inserido ou FALSE caso nem um registro seja inserido! 
     * @return INT $Variavel = lastInsertId OR FALSE
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */
    //Obtém o PDO e Prepara a query
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($this->Create);
    }

    //Cria a sintaxe da query para Prepared Statements
    private function getSyntax() {
        $Fileds = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
        $this->Create = str_replace(":DATA", "TO_DATE(:DATA, 'DD/MM/YYYY HH24:MI:SS')", $this->Create);
    }
 
    //Obtém a Conexão e a Syntax, executa a query!
    private function Execute() {
        $this->Connect();
        try {
            $this->Create->execute($this->Dados);
        } catch (PDOException $e) {
            $this->Result = null;
            WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
