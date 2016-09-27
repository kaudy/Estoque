<?php

namespace Hering\Tabela;

/**
 * Description of TabelaAdapter
 *
 * @author kaudy
 */
abstract class TabelaAdapter
{
    private $dbcon;
    
    public function __construct(\PDO $pdo)
    {
        $this->dbcon = $pdo;
    }

    protected  function getDb()
    {
        return $this->dbcon;
    }

    public function update(Produto $produto)
    {
        
    }
    
    public function create()
    {
        
    }
    
    
    
    
    
    
    
    
    
    
}
