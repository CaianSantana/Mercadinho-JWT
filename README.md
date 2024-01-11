<h1> Mercadinho-JWT</h1>

<h2> Programa feito no Visual Code Studio usando as seguintes extensões: </h2>

PHP Extension Pack(https://marketplace.visualstudio.com/items?itemName=xdebug.php-pack)<br>
PHP Server(https://marketplace.visualstudio.com/items?itemName=brapifra.phpserver)<br>

<h2>Problema Proposto: </h2>
Você está encarregado de desenvolver um sistema de Ponto de Venda (PDV) para o
cliente: Mercadinho JWT. A aplicação deve incluir uma classe responsável pelo cadastro
de produtos, com os atributos de nome, preço e quantidade. A classe Produto deve
conter um método setProduto, que terá um parâmetro chamado data, representando
um array contendo informações como nome, preço e quantidade. Esse método será
responsável por cadastrar o produto e alimentar os atributos da classe. Além disso, a
classe deve possuir o método getProduto, que será responsável apenas por exibir o
produto atualmente cadastrado.<br>
Após a conclusão da classe Produto, deve-se criar a classe Venda, que herdará os
atributos da classe produto, possuindo em seus próprios atributos a quantidade e
desconto.<br>
Dentro da classe `Venda`, devem ser implementados os seguintes métodos:<br><br>
<ul>getVenda;</ul>
<ul>setVenda.</ul><br> 
O método setVenda é responsável pelo registro da venda. Inicialmente, ele deve
verificar se o produto está cadastrado. Em caso afirmativo, deve validar o estoque do
produto e, em seguida, permitir a venda do produto. Após a conclusão da venda, é
necessário utilizar o método getVenda para exibir a última venda registrada e informar o
estoque atual do produto.
