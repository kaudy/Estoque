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
$estoque->addProduto($produto2, 2);

$estoque->sync();

var_dump($estoque);












