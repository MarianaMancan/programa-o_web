
<?php
###############################################################################################################################################################
# Programa...: medicosincluir (medicosincluir.php)
# DescriÃ§Ã£o..: Inclui a execuÃ§Ã£o de arquivo externo (require_once()), identifica valor de variÃ¡vel de controle de recursividade
#              e apresenta dois blocos lÃ³gicos de programaÃ§Ã£o: Um blobo para montagem de um formulÃ¡rio para dados de mÃ©dicos e
#              um bloco para controlar o tratamento de uma trransaÃ§Ã£o.
# Objetivo...: Gerenciar a funcionalidade "incluir" dados na tabela medicos.
# Autor......: Mariana Frederico Mançan
# CriaÃ§Ã£o....: 2023-05-19

# Referenciando o arquivo toolskit.php
require_once("../../funcoes/catalogo.php");

require_once("./logradouroFuncoes.php");

# Determinando $bloco
$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1;
$sair=$_REQUEST['sair']+1;
$menu=$_REQUEST['sair'];
# monstrando o valor de $bloco em cada execuÃ§Ã£o


iniciapagina(TRUE,"logradouros","logradouros","Incluir");
montamenu("Incluir",$sair);

# Com o comando a seguir se faz a execuÃ§Ã£o seletiva dos blocos de comandos: montagem do form e controle da transaÃ§Ã£o com base no valor de $bloco.
switch (TRUE)
{
  case ($bloco==1):
  { # montando o form
    printf("  <form action='logradouroIncluir.php' method='POST'>\n");
    printf("  <input type='hidden' name='bloco' value='2'>\n");
    printf("  <input type='hidden' name='sair' value='$sair'>\n");
    printf("  <table>\n");
    printf("   <tr><td>Código:</td>         <td>O código será  gerado pelo Sistema</td></tr>\n");
    printf("   <tr><td>Nome logradouro:</td>           <td><input type='text' name='txnomelogradouro' placeholder='' size=50 maxlength=200></td></tr>\n");
   
    printf("<tr><td>Cidade:</td>     <td>");
    $cmdsql="SELECT pkcidade,txnomecidade from cidades order by txnomecidade";
    $execcmd=mysqli_query($link,$cmdsql);
    printf("<select name='fkcidade'>\n");
    while ( $reg=mysqli_fetch_array($execcmd) )
    {
      printf("<option value='$reg[pkcidade]'>$reg[txnomecidade]-($reg[pkcidade])</option>");
    }
    printf("</select>\n");
    printf("</td></tr>\n");
  
    printf("<tr><td>Tipo Logradouro:</td><td>");
    $cmdsql="SELECT pklogradourotipo,txnometipologradouro from logradourostipos order by txnometipologradouro";
    $execcmd=mysqli_query($link,$cmdsql);
  printf("<select name='fklogradourotipo'>\n");
    while ( $reg=mysqli_fetch_array($execcmd) )
    {
      printf("<option value='$reg[pklogradourotipo]'>$reg[txnometipologradouro]-($reg[pklogradourotipo])</option>");
    }
    printf("</select>\n");
    printf("</td></tr>\n");
  
    printf("   <tr><td>Cadastrado em:</td>  <td><input type='date' name='dtcadlogradouro'></td></tr>\n");
    printf("   <tr><td></td>                <td>");
    botoes("Incluir",TRUE,FALSE); 

    printf("</td></tr>\n");
    printf("  </table>\n");
    printf("  </form>\n");
    break;
  }
  case ($bloco==2):
  { # Tratamento da transaÃ§Ã£o.
    # lendo os valores digitados nos campos do form
    # a transaÃ§Ã£o se inicia com o comando: START TRANSACTION
    # a transaÃ§Ã£o deve ser executada 'dentro' de um laÃ§o de repetiÃ§Ã£o.
    $mostrar=FALSE;
    $tenta=TRUE;
    while ( $tenta )
    { # laÃ§o de controle de exec da trans.
      mysqli_query($link,"START TRANSACTION");

      $ultimacp=mysqli_fetch_array(mysqli_query($link,"SELECT MAX(pklogradouro) AS CpMAX FROM logradouros"));
      $CP=$ultimacp['CpMAX']+1;
      # ConstruÃ§Ã£o do comando de atualizaÃ§Ã£o.
      $cmdsql="INSERT INTO logradouros (pklogradouro,fkcidade,txnomelogradouro,fklogradourotipo,dtcadlogradouro)
                      VALUES ('$CP',
                              '$_REQUEST[fkcidade]',
                              '$_REQUEST[txnomelogradouro]',
                              '$_REQUEST[fklogradourotipo]',
                              '$_REQUEST[dtcadlogradouro]'
                              )";
      # printf("$cmdsql<br>\n");
      # execuÃ§Ã£o do cmd.
      mysqli_query($link,$cmdsql);
      # tratamento dos erros de exec do cmd.
      if ( mysqli_errno($link)==0 )
      { # trans pode ser concluÃ­da e nÃ£o reiniciar
        mysqli_query($link,"COMMIT");
        $tenta=FALSE;
        $mostrar=TRUE;
        $mens="Registro inclui­do!";
      }
      else
      {
        if ( mysqli_errno($link)==1213 )
        { # abortar a trans e reiniciar
          $tenta=TRUE;
        }
        else
        { # abortar a trans e NÃƒO reiniciar
          $tenta=FALSE;
          $mens=mysqli_errno($link)."-".mysqli_error($link);
        }
        mysqli_query($link,"ROLLBACK");
        $mostrar=FALSE;
      }
    }
    printf("$mens<br>\n");
    if ( $mostrar )
    { # mostraregistro incova botoes que recebe os parÃ¢metros ($acao,$clear,$voltar,$menu,$sair)
      mostraregistro("$CP",);
      # como colocamos os botoes de Pular para Abertura e Sair do Sistema na barra do menu, entÃ£o precisamos mais executar nada da funÃ§Ã£o botoes().
    }
    break;
  }
}
terminapagina("Logradouros","Incluir","logradouroIncluir.php");
?>