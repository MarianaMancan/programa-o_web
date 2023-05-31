<?php
#################################################################################################################################
# Exemplo de PA-Consulta.
# Objetivo...: Apresentar a estruturação de um PA que faz a consulta de dados de uma tabela.
# Descrição..: Faz a conexão com uma base de dados. Determina a execução do bloco 1 do PA recursivo.
#              No bloco 1 faz a leitura dos dados de uma tabela (projeção) e monta uma
#              Caixa de Seleção (PickList). Na picklist mostra um campo descritivo da tabela e
#              associa cada linha exibida ao valor da PK da tabela.
#              No bloco 2 lê o valor da PK escolhida, acessa e lê a linha da tabela e mostra os
#              dados em formato de tabela.
# Criação....: 2023-05-04
# Atualização: 2023-05-18
# Mariana Mançan
#################################################################################################################################
# Requerendo a execução do ToolsKit.php
require_once("../../funcoes/catalogo.php"); # o '_once'  agiliza execução do recursivo pois LÊ o arquivo secundário
                                # somente na primeira execução.
require_once("./logradouroFuncoes.php"); 

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1;
$sair=$_REQUEST['sair']+1;
$menu=$_REQUEST['sair'];
iniciapagina(TRUE,"logradouros","logradouros","Consultar");

# Executando função que monta o menu no topo da tela
montamenu("Consultar",$sair);


switch(true)
{
  case ($bloco==1):
  {
    picklist("Consultar");
  
    break;
  }
  case ($bloco==2):
  { 
    mostraregistro($_REQUEST['pklogradouro']);
    botoes("",FALSE,TRUE);
    break;
   
    
  }
}
terminapagina("Logradouros","Consultar","logradouroConsultar.php");
?>

