<?php

require_once './Tabela/Produto.php';
require_once './Tabela/ProdutoTabela.php';
require_once './Estoque.php';
require_once './Caixa.php';

use Hering\Tabela\Produto;
use Hering\Estoque;
use Hering\Tabela\ProdutoTabela;

$pdo = new PDO('mysql:host=localhost;port=3307;dbname=Estoque','root','elaborata');

$produto = new Produto();
$produto->setCodigo(5553333)
        ->setNome('Camisa Polo')
        ->setTamanho('G')
        ->setValor(68.34)
        ->setModelo('Lacoste');

$produto2 = new Produto();
$produto2->setCodigo(123456)
        ->setNome('Calcinha')
        ->setTamanho('PP')
        ->setValor(4.44)
        ->setModelo('Trifil');


$estoque = Estoque::getInstance($pdo);

$estoque->addProduto($produto, 5);
$estoque->addProduto($produto2, 50);

var_dump($estoque);

$tabela = new ProdutoTabela($pdo);



//var_dump($caixa);
//var_dump($caixa->totalPagar());
//var_dump($tabela->findAll());




/*//Trata erro em caso de não ter quantida de produtos
try{
    $estoque->remProduto($produto2, 60);
} catch (\Exception $ex) {
    echo $ex->getMessage();
}*/








