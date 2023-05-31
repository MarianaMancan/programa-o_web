<?php

#--------------------------------------------------------------------------------------------------------------------------------------------------------------
# Programa....: medicosfuncoes.php
# Descricao...: Programa recursivo com dois blocos principais de execução, referenciando um programa de funções (toolskit.php)
# Autor.......: Mariana Frederico Mançan
# Objetivo....: Servir de exemplo para estudo do desenvolvimento de PA.
# Criacao.....: 2023-05-04
# Ultima atualizacao.: 2021-04-15
#             
#--------------------------------------------------------------------------------------------------------------------------------------------------------------
function picklist($acao)
{
  global $link;

  $prg=($acao=="Consultar")?"logradouroConsultar.php":(($acao=="Alterar")?"logradouroAlterar.php":"logradouroExcluir.php");
  $cmdsql= "SELECT `pklogradouro`, `fkcidade`, `txnomelogradouro`, `fklogradourotipo`, `dtcadlogradouro` FROM logradouros";
  $execcmd=mysqli_query($link,$cmdsql);

  $sair=$_REQUEST['sair']+1;
  $menu=$_REQUEST['sair'];
  $btacao=($acao=="Consultar") ? "Consultar" : (($acao=="Alterar") ? "Alterar": "Excluir" ); 
  #desenhos dos botões:         
  printf("  <form action='./$prg' method='POST'>\n");
  printf("  <input type='hidden' name='bloco' value='2'>\n");
  printf("  <input type='hidden' name='sair' value='$sair'>\n");
  printf("Escolha um logradouro: ");
  printf("<select name='pklogradouro'>\n");

  $ceespec="";
  while ( $registro=mysqli_fetch_array($execcmd) )
  { # laço para 'montar' as linhas de option da picklist
    if ( $ceespec!=$registro['fkcidade'] )
    {
      if ( $ceespec!="" )
      {
        printf("</optgroup>\n");
      }
      printf("<optgroup label='$registro[txnomecidade]'>\n");
      $ceespec="$registro[fkcidade]";
    }
    printf("<option value='$registro[pklogradouro]'>$registro[txnomelogradouro]-$ceespec-($registro[pklogradouro])</option>\n");
  }
  printf("</optgroup>\n");
  printf("</select>\n");


  botoes($acao,TRUE,FALSE);
  # Parametros na ordem: ($acao,$limpar,$voltar,$menu,$sair) - Nome da ação | TRUE ou FALSE | TRUE ou FALSE | saltos para ABERTURA | saltos para SAIR
#  printf("<button class='nav' type='submit'                             >$btacao</button>\n");
#  printf("<button class='nav' type='button' onclick='history.go(-$menu)'>Abertura</button>\n"); # &#x1f3e0;&#xfe0e;
#  printf("<button class='nav' type='button' onclick='history.go(-$sair)'>Sair</button>\n"); # &#x2348;
  printf("  </form>\n");
}

function mostraregistro($CP)
{
  global $link;
  $cmdsql="SELECT * FROM logradouros as l left join cidades as c on l.fkcidade = c.pkcidade left join logradourostipos lt on l.fklogradourotipo = lt.pklogradourotipo WHERE pklogradouro='$CP'";
  $execcmd=mysqli_query($link,$cmdsql);
  $registro=mysqli_fetch_array($execcmd);

printf("   <table>\n");
printf("    <tr><td>Código:</td>             <td>$$registro[pklogradouro]</td></tr>\n");
printf("    <tr><td>cidade:</td>                 <td>$registro[txnomecidade]($registro[fkcidade])</td></tr>\n");
printf("    <tr><td>Nome logradouro:</td>                <td>$registro[txnomelogradouro]</td></tr>\n");
printf("    <tr><td>Tipo Logradouro:</td>      <td>$registro[txnometipologradouro]-($registro[fklogradourotipo])</td></tr>\n");
printf("    <tr><td>Cadastrado em</td><td>$registro[dtcadlogradouro]</td></tr>\n");
printf("    <tr><td></td><td></td></tr>\n");
printf("   </table>\n");


}
function montamenu($acao,$sair)
{ #--------------------------------------------------------------------------------------------------------------------------------------------------
  # Função.....: montamenu
  # Objetivo...: Montar o menu de acesso às funcionalidades do sistema.
  # Descricao..: Emite as TAGs que montam o menu de navegação na div suoerior da tela do sistema. No arquivo .CSS são definidas os seletores de DIVS
  #              para a região superior da tela e 'dentro' desta para os botões que formam o menu.

  #--------------------------------------------------------------------------------------------------------------------------------------------------
  printf("<div class='$acao'>\n");
  printf(" <div class='menu'>\n");
  printf(" <form action='' method='POST'>\n");
  # A definição da variável a seguir
  printf("  <input type='hidden' name='sair' value='$sair'>\n");
  printf("<titulo>Logradouros</titulo>:\n");
  printf("<button class='ins' type='submit' formaction='./logradouroIncluir.php'  >Incluir</button>\n"); # &#x1f7a5;
  printf("<button class='alt' type='submit' formaction='./logradouroAlterar.php'  >Alterar</button>\n"); # &#x1f589;
  printf("<button class='del' type='submit' formaction='./logradouroExcluir.php'  >Excluir</button>\n"); # &#x1f7ac;
  printf("<button class='con' type='submit' formaction='./logradouroConsultar.php'>Consultar</button>\n"); # &#x1f50d;&#xfe0e;
  printf("<button class='lst' type='submit' formaction='./logradouroListar.php'   >Listar</button>\n"); # &#x1f5a8;
  # Em revisão em 2023-05-13 Inclui os botões de Salto para 'Abertura' e para 'Saída do Sistema'.
  # Estes botões foram retiradas da função botoes() - Analise o código-fonte da função.
  $menu=$sair-1;
  printf(($menu>0) ? "<input class='imp' type='button' value='Abertura' onclick='history.go(-$menu)'>" : "");
  # NOTE: No comando acima o botão 'Abertura' só será exibido depois que o usuário acessar a primeira tela de qualquer funcionalidade.
  printf("<input class='imp' type='button' value='Sair' onclick='history.go(-$sair)'>\n");
  printf(" </form>\n");
  printf("</div>\n");
  printf("<redbold>$acao</redbold><hr>\n");
  printf("</div>\n<br><br><br>\n");
}

function botoes($acao,$limpar,$voltar)
{ #------------------------------------------------------------------------------------------------------------------------------------------------------------
  # Função.....: botoes
  # Objetivo...: Montar a barra de botoes das telas de cada funcionalidade.
  # Descricao..: Emite as TAGs que montam os botões de navegação no PA. Os botões de navegação pode ser omitidos (se o navegador permitir).
  # As tags serão montadas na variável $barra.
  $barra="";
  $barra=( $acao!="" ) ? $barra."   <input class='imp' type='submit' value='$acao'>" : "";
  $barra=(  $limpar  ) ? $barra."   <input class='imp' type='reset'  value='Limpar'>" : $barra ;
  $barra=(  $voltar  ) ? $barra."   <input class='imp' type='button' value='Voltar' onclick='history.go(-1)'>" : $barra ;
  printf("$barra\n");
}

?>


