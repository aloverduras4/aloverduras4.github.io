<?php

class Criar extends Conexao {

    private $Tabela;
    private $Dados;
    private $Resultado;
    private $Criar;
    private $Conexao;

    /**
     * <b>ExeCriar</b> Executa um cadastro simplificado no banco de dados com prepared statements
     * Basta informar o nome da tabela e um array atribuitivo com o nome da coluna e valor.
     * @param STRING $Tabela INFORME O NOME DA TABELA
     * @param ARRAY  $Dados INFORME UM ARRAY ATRIBUITIVO ( 'NOME DA COLUNA' => 'VALOR' )
     * 
     * NÃO ACEITAMOS PIRATARIA É CRIME 
     * <b>Webtecpr.com.br</b>
     * CONTATO: (41) 3088-4418
     * <b>por Maykon Silveira</b>
     *  <b>Este código poderá ser rastreado!</b>
     *
     *  */
    public function Criacao($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        
        $this->getLogica();
        $this->Execute();
    }

    /** @var Retorna um resultado de cadastro ou não :: por Maykon Silveira */

    public function getResultado() {
        return $this->Resultado;
    }

    /**
     * ***********WEBTECPR.COM.BR*************
     * ********** PRIVATE METHODS *************
     * ************MAYKON***SILVEIRA************
     */
    
    /** @var Faz a coneção com banco de dados por Maykon Silveira */
    private function Conectar() {
        $this->Conexao = parent::getCanectar();
        $this->Criar = $this->Conexao->prepare($this->Criar);
        
    }

     /** @var gera a syntax do mysql automaticamente por Maykon Silveira */
    private function getLogica() {
        $Fileds = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Criar = "INSERT IGNORE INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
    
    }

     /** @var Executa o PDO  por Maykon Silveira */
    private function Execute() {
        $this->Conectar();
        
        try {
            $this->Criar->execute($this->Dados);
            $this->Resultado = $this->Conexao->lastInsertId();
        } catch (Exception $wt) {
            $this->Resultado = null;
            print "<b>Erro ao cadastrar: {$wt->getMessage()} {$wt->getCode()}</b> ";
        }
    }

}
