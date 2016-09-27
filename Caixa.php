<?php
namespace Hering;

use Hering\Estoque;
use Hering\Tabela\Produto;


/**
 * Description of Caixa
 *
 * @author kaudy    
 */
class Caixa
{
    private $listaProdutos = array();
    private $estoque;
     
    
    
    public function __construct(EStoque $estoque)
    {
        $this->estoque = $estoque;
    }        

    /**
     * Adiciona o produto ao caixa
     * @param Produto $produto
     * @param int $quant
     */    
    public function addProduto(Produto $produto, $quant)
    {
        if(array_key_exists($produto->getCodigo(), $this->listaProdutos))
        {
            $quant += $this->listaProdutos[$produto->getCodigo()]['quantidade'];
        }
        
        $this->listaProdutos[$produto->getCodigo()]['quantidade'] = $quant;
        $this->listaProdutos[$produto->getCodigo()]['produto'] = $produto;
    }
    
    /**
     * Calcula o total a ser pago
     */    
    public function totalPagar()
    {
        $total = 0;
        
        foreach ($this->listaProdutos as $produto)
        {
            $valor = $produto['quantidade'] * $produto['produto']->getValor();
            $total += $valor;
        }
        
        return $total;
    }
    
    /**
     * Efetua o pagamento e baixa os produtos de estoque
     */
    public function pagar()
    {
        foreach ($this->listaProdutos as $produto)
        {
            $this->estoque->remProduto($produto['produto'],$produto['quantidade']);
        }
    }
    
}
