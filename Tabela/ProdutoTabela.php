<?php

namespace Hering\Tabela;

require_once 'TabelaAdapter.php';

/**
 * Description of ProdutoTabela
 *
 * @author kaudy
 */
class ProdutoTabela extends TabelaAdapter
{
    /**
     * Pesquisa pela chave primaria
     * @param type $id
     * @return Produto
     */
    public function find($id)
    {
        $sql = "SELECT * FROM produto WHERE codigo = '$id'";
        
        return $this->getDb()->query($sql)->fetchObject('Hering\Tabela\Produto');
    }
    
    
    /**
     *  Retorna um vetor com todos os registros
     * @return array de Produto
     */
    public function findAll()
    {
         $sql = "SELECT * FROM produto";
         return $this->getDb()
                 ->query($sql)
                 ->fetchAll(\PDO::FETCH_CLASS,'Hering\Tabela\Produto');
         
    }
    
    /**
     * 
     * @param \Hering\Tabela\Produto $produto
     */
    public function update(Produto $produto)
    {
        $sql = "UPDATE  produto SET  
                    nome =  '".$produto->getNome()."',
                    tamanho =  '".$produto->getTamanho()."',
                    valor =  '".$produto->getValor()."',
                    modelo =  '".$produto->getModelo()."' 
                WHERE  codigo ='".$produto->getCodigo()."'";
        
        $this->getDb()->exec($sql);
    }
    
    public function create(Produto $produto)
    {
        $sql = "INSERT INTO produto (codigo,nome,tamanho, valor, modelo) "
                . "VALUES ('".$produto->getCodigo()."', "
                ."'".$produto->getNome()."', "
                ."'".$produto->getTamanho()."', "
                ."'".$produto->getValor()."', "
                ."'".$produto->getModelo()."')";
        
        $this->getDb()->exec($sql);
    }
    
    
    
}

