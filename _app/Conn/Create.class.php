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
        //if ($this->Tabela == 'SITE_CATEGORIA_RELATORIO'):
        $this->Create = str_replace(":DATA", "TO_DATE(:DATA, 'DD/MM/YYYY HH24:MI:SS')", $this->Create);
        //endif;
        
    }
 
    //Obtém a Conexão e a Syntax, executa a query!
    private function Execute() {
        $this->Connect();
        try {
            $this->Create->execute($this->Dados);
//            $this->Conn->lastInsertId();
        } catch (PDOException $e) {
            $this->Result = null;
            WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
