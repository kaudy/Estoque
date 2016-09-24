<?php

require_once './Tabela/Produto.php';
require_once './Estoque.php';

use Hering\Tabela\Produto;
use Hering\Estoque;

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

$produto3 = new Produto();
$produto3->setCodigo(5553333)
        ->setNome('Camisa Polo')
        ->setTamanho('G')
        ->setValor(68.34)
        ->setModelo('Lacoste');




$estoque = new Estoque($pdo);
$estoque->addProduto($produto, 5);
$estoque->addProduto($produto2, 50);
$estoque->addProduto($produto3, 2);

$prod = $estoque->listarProduto(666666);



var_dump($prod);




/*//Trata erro em caso de não ter quantida de produtos
try{
    $estoque->remProduto($produto2, 60);
} catch (\Exception $ex) {
    echo $ex->getMessage();
}*/








