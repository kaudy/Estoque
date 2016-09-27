<?php

namespace Hering;

use Hering\Tabela\Produto;
use Hering\Tabela\ProdutoTabela;
/**
 * Gerencia os produtos em estoque - Sing
 *
 * @author kaudy    
 */
class Estoque
{

    private $produtos = array();
    private $_produtosOriginal = array();
    
    private $tabela;    
    static private $instancia;
    
    //Contrutor ****************************************************************
    private function __construct(\PDO $pdo)
    {
        $this->tabela = new ProdutoTabela($pdo);
        $this->sync();        
    }    
    
    /** ************************************************************************
     * @param \PDO
     * @return Estoque
     **************************************************************************/
    static public function getInstance(\PDO $pdo)
    {
        if(self::$instancia== NULL)
        {
            self::$instancia = new self($pdo);
        }
        
        return self::$instancia;
    }

    /** ************************************************************************
     * Adiciona um produto a tabela
     * @param Produto $produto
     * @param int $quantidade
     **************************************************************************/
    public function addProduto(Produto $produto, $quantidade)
    {
        if(isset($this->produtos[$produto->getCodigo()]['produto']))
        {
            $this->produtos[$produto->getCodigo()]['quantidade'] += $quantidade;
        }else
        {
            $this->produtos[$produto->getCodigo()]['quantidade'] = $quantidade;
            $this->produtos[$produto->getCodigo()]['produto'] = $produto;
        }  
    }

    /** ************************************************************************
     * Remove a quantidade do produto informado
     * @param Produto $produto
     * @param int $quantidade
     **************************************************************************/
    public function remProduto(Produto $produto, $quantidade)
    {
        $quantidadeAtual=$this->produtos[$produto->getCodigo()]['quantidade'];
        if($quantidadeAtual<$quantidade)
        {
            throw new \Exception("Não foi possivel remover, porque só existem "
                    . "$quantidadeAtual em estoque");
        }else
        {
            $this->produtos[$produto->getCodigo()]['quantidade']-= $quantidade;
        }        
    }

    /** ************************************************************************
     * Retorna atodos os produtos em estoque
     * @return array de Produtos
     **************************************************************************/
    public function listarTudo()
    {
        
        return $this->produtos;
    }

    /** ************************************************************************
     * Retorno o objeto pelo código informado
     * @param int $codigo
     * @return Produto || null
     **************************************************************************/
    public function listarProduto($codigo)
    {
        if(isset($this->produtos[$codigo]['produto']))
        {
            return $this->produtos[$codigo]['produto'];
        }else
        {
            return null;
        }        
    }

    /** ************************************************************************
     * Sincroniza o objeto com banco de dados
     **************************************************************************/
    public function sync()
    {
        if(count($this->produtos)==0)
        {
            $lista = $this->tabela->findAll();            
            
            foreach($lista as $produto)
            {
                $this->_produtosOriginal[$produto->getCodigo()]['produto'] = $produto;
                $this->addProduto($produto, 0);
            }
        }else
        {
            foreach ($this->produtos as $codigo => $produto)
            {
                if(array_key_exists($codigo, $this->_produtosOriginal)== true)
                {
                    $this->tabela->update($produto['produto']);
                }else
                {
                    $this->tabela->create($produto['produto']);
                }
            }
            
            $lista = $this->tabela->findAll();
            foreach ($lista as $produto)
            {
                $this->_produtosOriginal[$produto->getCodigo()]['produto'] = $produto;
            }
        }
    }

}
