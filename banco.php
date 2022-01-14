<?php

require_once 'src/Conta.php';  /* nessas proximas tres linhas de codigo (require_once) esta sendo implementado um arquivo de codigo externo, que
deve ser em ordem correta */
require_once 'src/Titular.php';
require_once 'src/CPF.php';

$vinicius = new Titular(new CPF('123.456.789-10'), 'Vinicius Dias');  /* esta criando primeiramente o cpf do titular, em seguida o 
titular "Vinicius Dias" */
$primeiraConta = new Conta($vinicius);  /* esta criando uma nova conta com o nome "$primeiraConta" com o titular "$vinicius", que 
anteriormente foi preenchido */
$primeiraConta->deposita(500);
$primeiraConta->saca(300);

echo $primeiraConta->recuperaNomeTitular() . PHP_EOL;
echo $primeiraConta->recuperaCpfTitular() . PHP_EOL;
echo $primeiraConta->recuperaSaldo() . PHP_EOL;

$patricia = new Titular(new CPF('698.549.548-10'), 'Patricia');  // cria um novo titular com o nome de "$patricia"
$segundaConta = new Conta($patricia);  // cria uma nova conta com o nome de "$segundaConta"
var_dump($segundaConta);  // essa funcao mostra o conteudo de uma variavel de forma estruturada

$outra = new Conta(new Titular(new CPF('123.654.789-01'), 'Abcdefg'));
unset($segundaConta);  /* exclui a referencia na memoria da conta "$segundaConta", e com isso o "Garbage Collector" detecta um 
espaco na memoria ocupado e nao util, e o exclui tambem */
echo Conta::recuperaNumeroDeContas();  /* aqui esta acessando o metodo que obtem o numero de vezes que a classe foi instanciada,
decrementando as vezes em que esse objeto foi abandonado e o "Garbage Collector" procedeu */

echo $primeiraConta->transfere(50,$outra) . PHP_EOL;
var_dump($outra);
echo $primeiraConta->recuperaSaldo() . PHP_EOL;
