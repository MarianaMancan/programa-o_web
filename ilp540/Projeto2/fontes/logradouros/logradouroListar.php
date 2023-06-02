
<?php
#--------------------------------------------------------------------------------------------------------------------------------------------------------------
# Programa.: lograourolistar
# Descrição: Este PA tem 2 'cases' com tres valores de $bloco. No primeiro case monta um form para escolha da ordenacao dos dados de medicos que serao
#            exibidos na listagem, nos cases 2 e 3 monta uma tabewla com os dados de uma juncao completa entre medicos e todas as tabelas relacionadas.
#            Note o comando SQL que faz a juncao e deste modo faz o SGBD trabalhar para o PA.
# Objetivo.: Montar a Listagem de dados da tabela medicos.
# Autor....: Mariana Frederico Mançan
# Criação..: 2023-05-25
#--------------------------------------------------------------------------------------------------------------------------------------------------------------
require_once("../../funcoes/catalogo.php");

require_once("./logradouroFuncoes.php");

# Determinando $bloco
$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1;
$sair=$_REQUEST['sair']+1;
$menu=$_REQUEST['sair'];
$cordefundo=($bloco<3) ? TRUE : FALSE;


iniciapagina(TRUE,"logradouros","logradouros","Listar");

$cordefundo=($bloco<3) ? TRUE : FALSE;
# printf("\$bloco = $bloco<br>\$sair = $sair<br>\$menu = $menu\n");
#
# Com o comando a seguir se faz a execução seletiva dos blocos de comandos: montagem do form e Montagem da Listagem.
switch (TRUE)
{
  case ( $bloco==1 ):
  { # este bloco monta o form e passa o bloco para o valor 2 em modo oculto
    # Aqui se executa a função montamenu(). O menu deve ser apresentado nos 'cases' 1 e 2... o 'case' deve exibir a listagem SEM o menu.
    montamenu("Listar",$sair);
    printf(" <form action='./logradouroListar.php' method='post'>\n");
    printf("  <input type='hidden' name='bloco' value=2>\n");
    printf("  <input type='hidden' name='sair' value='$sair'>\n");
    printf("  <table class ='table1'>\n");
    printf("   <tr><td colspan=2>Escolha a <negrito>ordem</negrito> como os dados serão exibidos no relatório:</td></tr>\n");
    printf("   <tr><td>Código do Logradouro.:</td><td>(<input type='radio' name='ordem' value='l.pklogradouro'>)</td></tr>\n");
    printf("   <tr><td>Nome do Logradouro...:</td><td>(<input type='radio' name='ordem' value='l.txnomelogradouro' checked>)</td></tr>\n");
    printf("   <tr><td colspan=2>Escolha valores para selação de <negrito>dados</negrito> do relatório:</td></tr>\n");
    printf("   <tr><td>Escolha uma cidade:</td><td>");
    $cmdsql="SELECT pkcidade,txnomecidade from cidades order by txnomecidade";
    $execcmd=mysqli_query($link,$cmdsql);
    printf("<select name='fkcidade'>");
    printf("<option value='TODAS'>Todas</option>");
    while ( $reg=mysqli_fetch_array($execcmd) )
    {
      printf("<option value='$reg[pkcidade]'>$reg[txnomecidade]-($reg[pkcidade])</option>");
    }
    printf("<select>\n");
    printf("</td></tr>\n");
    $dtini="1901-01-01";
    $dtfim=date("Y-m-d");
    printf("<tr><td>Intervalo de datas de cadastro:</td><td><input type='date' name='dtcadini' value='$dtini'> até <input type='date' name='dtcadfim' value='$dtfim'></td></tr>");
    printf("   <tr><td></td><td>");
    botoes("Listar",FALSE,TRUE); # Reescrito no arquivo de medicosfuncoes.php. Parâmetros: Ação | Limpar | Voltar
    # printf("<button type='submit'>Listar</button>\n"); # - <font size=6>&#x1f5a8;</font>
    # printf("<button type='button' onclick='history.go(-1)'><font size=5>&#x2397;</font></button>\n");
    # printf("<button type='button' onclick='history.go(-$menu)'>Abertura</button>\n"); # - <font size=5>&#x1f3e0;&#xfe0e;</font>
    # printf("<button type='button' onclick='history.go(-$sair)'>Sair</button>\n"); # - <font size=5>&#x2348;</font>
    printf("</td></tr>\n");
    printf("  </table>\n");
    printf(" </form>\n");
    break;
  }
  case ( $bloco==2 || $bloco==3 ):
  { 
    # Depois monta a tabela com os dados e a seguir um form permitindo que a listagem seja exibida para impressão em uma nova aba.
    $selecao=" WHERE (l.dtcadlogradouro between '$_REQUEST[dtcadini]' and '$_REQUEST[dtcadfim]')";
    $selecao=( $_REQUEST['fkcidade']!='TODAS' ) ? $selecao." AND l.fkcidade='$_REQUEST[fkcidade]'" : $selecao ;
    
	# Na base de dados de exemplo existe a implementação de uma visão que faz toda as junções necessárias de 'medicos' e as tabelas relacionadas.
	# Consulte o item de VIEWS da base e veja o código que define 'medicostotal'.

  $cmdsql="SELECT * FROM logradouros as l  left join cidades as c on l.fkcidade = c.pkcidade left join logradourostipos lt on l.fklogradourotipo = lt.pklogradourotipo ".$selecao." ORDER BY $_REQUEST[ordem] ";
  
	# Lendo os dados do banco de dados.
    $execsql=mysqli_query($link,$cmdsql);
    # SE o bloco de execução for 2, então o menu DEVE aparecer no topo da tela.
    ($bloco==2) ? montamenu("Listar","$sair") : "";
	# O operador ternário foi usado acima de um modo 'diferente' executando uma função de modo condicional
	# Abaixo se inicia a construção da tabela com os dados lidos. A Listagem NÃO terá um contador de linhas para formatar os saltos de páginas...
	# Mas isso até que seria interessante implementar... Talvez...
    printf("<table border=1 style=' border-collapse: collapse; '>\n");
	# Aqui se monta o cabeçalho da tabela. Note que existe uma linha dupla para mostrar os dados de clinica e moradia 'agrupados'.
    printf(" <tr><td valign=top rowspan=2>Cod.</td>\n");
    printf("     <td valign=top rowspan=2>cidade:</td>\n");
    printf("     <td valign=top rowspan=2>Nome logradouro:</td>\n");
    printf("     <td valign=top rowspan=2>Tipo logradouro:</td>\n");
    printf("     <td valign=top rowspan=2>Data cadastro:</td></tr>\n");
    printf("<tr></tr>\n");
	# Terminando o 'cabeçalho' segue o corpo da listagem com os dados. Esta listagem será Zebrada com as cores branca e lightgreen
    $corlinha="White";
    while ( $le=mysqli_fetch_array($execsql) )
    {
      printf("<tr bgcolor=$corlinha><td>$le[pklogradouro]</td>\n");
      printf("   <td valign=top>$le[txnomecidade]-($le[fkcidade])</td>\n");
      printf("   <td valign=top>$le[txnomelogradouro]</td>\n");
      printf("   <td valign=top>$le[txnometipologradouro]-($le[fklogradourotipo])</td>\n");
      printf("   <td valign=top>$le[dtcadlogradouro]</td></tr>\n");
      printf("</tr>\n");
      $corlinha=( $corlinha=="White" ) ? "lightgreen" : "White"; # Navajowhite | lightblue 
    }
    printf("</table>\n");
    if ( $bloco==2 )
    { # Aqui se monta o form que é apresentado no final da listagem permitindo a escolha de emitir a mesma listagem em nova aba SEM o MENU.
      printf("<form action='./logradouroListar.php' method='POST' target='_NEW'>\n");
      printf(" <input type='hidden' name='bloco' value='3'>\n");
      printf(" <input type='hidden' name='sair' value='$sair'>\n");
      printf(" <input type='hidden' name='fkcidade' value=$_REQUEST[fkcidade]>\n");
      printf(" <input type='hidden' name='dtcadini' value=$_REQUEST[dtcadini]>\n");
      printf(" <input type='hidden' name='dtcadfim' value=$_REQUEST[dtcadfim]>\n");
      printf(" <input type='hidden' name='ordem' value=$_REQUEST[ordem]>\n");
      botoes("Imprimir",FALSE,TRUE); # Reescrito no arquivo de medicosfuncoes.php. Parâmetros: Ação | Limpar | Voltar
      printf("</form>\n");
    }
    else
    {
      printf("<hr>\n<button type='submit' onclick='window.print();'>Imprimir</button> - Corte a folha na linha acima.\n");
    }
    break;
  }
}

terminapagina("Logradouros","Listar","logradouroListar.php");
?>