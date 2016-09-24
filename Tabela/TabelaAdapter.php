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

    
    public function insert();
    
    public function read();
    
    public function delete();
    
    public function update();
    
    
    
    
    
    
    
    
    
    
}
