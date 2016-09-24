<?php


/**
 * Description of Caixa
 *
 * @author kaudy    
 */
class Caixa
{
    private $listaProdutos = array();
    
    
    /**
     * Adiciona o produto ao caixa
     * @param Produto $produto
     * @param int $quant
     */    
    public function addProduto(Produto $produto, $quant)
    {
        $this->produtos[$produto->getCodigo()]['quantidade'] = $quantidade;
        $this->produtos[$produto->getCodigo()]['produto'] = $produto;
    }
    
    /**
     * Calcula o total a ser pago
     */    
    public function totalPagar()
    {
        
    }
    
    /**
     * Efetua o pagamento e baixa os produtos de estoque
     */
    public function pagar()
    {
        
    }
    
}
