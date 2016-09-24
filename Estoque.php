<?php

namespace Hering;

use Hering\Tabela\Produto;
/**
 * Gerencia os produtos em estoque
 *
 * @author kaudy    
 */
class Estoque
{

    private $produtos = array();
    
    
    
    //Contrutor ****************************************************************
    public function __construct()
    {
        $this->sync();
        
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
        
    }

}
