<?php

/*
Após a conclusão da classe Produto, deve-se criar a classe Venda, que herdará os
atributos da classe produto, possuindo em seus próprios atributos a quantidade e
desconto.
Dentro da classe `Venda`, devem ser implementados os seguintes métodos:
- getVenda;
- setVenda.
O método setVenda é responsável pelo registro da venda. Inicialmente, ele deve
verificar se o produto está cadastrado. Em caso afirmativo, deve validar o estoque do
produto e, em seguida, permitir a venda do produto. Após a conclusão da venda, é
necessário utilizar o método getVenda para exibir a última venda registrada e informar o
estoque atual do produto. 
*/

require_once 'Validador.php';
class Vendas implements Validador{
    private $produto;
    private $quantidade;
    private $desconto;

    public function validar($vetor) { // Verifica se todos os atributos esperados existem no vetor e se estão ou não vazios
        $atributosEsperados = array('produto', 'quantidade');
        foreach ($atributosEsperados as $atributo) {
            if (empty($vetor[$atributo])) {
                return false;
            }
        }
        return true;
    }

    public function setVenda($vetorProduto){
        
    }
}