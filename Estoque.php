<?php

/**
 * Gerencia os produtos em estoque
 *
 * @author kaudy    
 */
class Estoque
{

    private $produtos = array();
    private $pdo;

    public function __construct(PDO $db)
    {
        $this->pdo = $db;
    }

    /**
     * Adiciona um produto a tabela
     * @param Produto $produto
     * @param int $quantidade
     */
    public function addProduto(Produto $produto, $quantidade)
    {
        
        $this->produtos[$produto->getCodigo()]['quantidade'] = $quantidade;
        $this->produtos[$produto->getCodigo()]['produto'] = $produto;
    }

    /**
     * Remove a quantidade do produto informado
     * @param Produto $produto
     * @param int $quantidade
     */
    public function remProduto(Produto $produto, $quantidade)
    {
        
    }

    /**
     * Retorna atodos os produtos em estoque
     * @return array de Produtos
     */
    public function listarTudo()
    {
        $sql = 'SELECT * FROM produto';
        $retorno = $this->pdo->query($sql);
        return $retorno->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retorno o objeto pelo código informado
     * @param int $codigo
     * @return Produto
     */
    public function listarProduto($codigo)
    {
        
    }

    /**
     * Sincroniza o objeto com banco de dados
     */
    public function sync()
    {
        
    }

}
