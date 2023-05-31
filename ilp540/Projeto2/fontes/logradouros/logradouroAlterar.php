
<?php
#--------------------------------------------------------------------------------------------------------------------------------------------------------------
# Objetivo...: Gerenciar a funcionalidade ALTERAR dados de um registro escolhido da tabela 'logradouros'.
# Autor......: Mariana Frederico Mançan
# CriaÃ§Ã£o....: 2023-05-25

#--------------------------------------------------------------------------------------------------------------------------------------------------------------
require_once("../../funcoes/catalogo.php"); # o '_once'  agiliza execução do recursivo pois LÊ o arquivo secundário
                                # somente na primeira execução.
require_once("./logradouroFuncoes.php"); 


$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1;
$sair=$_REQUEST['sair']+1;
$menu=$_REQUEST['sair'];
iniciapagina(TRUE,"logradouros","logradouros","Alterar");


# Executando funÃ§Ã£o que monta o menu no topo da tela
montamenu("Alterar",$sair);
# printf("\$bloco = $bloco<br>\$sair = $sair<br>\$menu = $menu\n");
#
# Com o comando a seguir se faz a execuÃ§Ã£o seletiva dos blocos de comandos: montagem do form e controle da transaÃ§Ã£o com base no valor de $bloco.
switch (TRUE)
{
  case ($bloco==1):
  { # NESTE case a picklist monta a tela com a caixa de seleÃ§Ã£o para escolha do registro.
    picklist("Alterar");
    break;
  }
  case ($bloco==2):
  { 

    $reglido=mysqli_fetch_array(mysqli_query($link,"SELECT * FROM logradouros WHERE pklogradouro='$_REQUEST[pklogradouro]'"));
    # montando o form. O form deve 'passar' o valor do cÃ³digo do medico em modo OCULTO (hidden).
    printf("<form action='logradouroAlterar.php' method='POST'>\n");
    printf(" <input type='hidden' name='bloco' value='3'>\n");
    printf(" <input type='hidden' name='sair' value='$sair'>\n");
    printf(" <input type='hidden' name='pklogradouro' value='$_REQUEST[pklogradouro]'>\n");
	# Os campos do form devem aparecer na coluna da DIREITA de uma tabela.
    # Na coluna da ESQUERDA se exibe os textos que devem orientar o usuÃ¡rio na digitaÃ§Ã£o de valores nos campos.
    # Os campos do form podem ser preenchidos com os valores do registro de mÃ©dicos atravÃ©s do uso do atributo HTML 'value'.
    printf("<table>");
    printf("<tr><td>Nome logradouro:</td>              <td><input type='text' name='txnomelogradouro' value='$reglido[txnomelogradouro]' size='50' maxlength='200'></td></tr>\n");
    printf("<tr><td>Cidade:</td>     <td>");
    $cmdsql="SELECT pkcidade,txnomecidade from cidades order by txnomecidade ";
    $execcmd=mysqli_query($link,$cmdsql);
    printf("<select name='fkcidade'>\n");
    while ( $reg=mysqli_fetch_array($execcmd) )
    { # LaÃ§o de RepetiÃ§Ã£o montando as linhas da Cx de SeleÃ§Ã£o
      # Eis o comando que verifica se existe igual entre $reglido[fkespecialidade] e $reg[pkespecialidade]. Se sim coloca "SELETED" na variÃ¡vel.
      $selected=( $reg['pkcidade']==$reglido['fkcidade'] ) ? " SELECTED": "" ;
      printf("<option value='$reg[pkcidade]'$selected>$reg[txnomecidade]-($reg[pkcidade])</option>");
    }
    printf("</select>\n");
    printf("</td></tr>\n");
  
    printf("<tr><td>Tipo Logradouro:</td><td>");
    $cmdsql="SELECT pklogradourotipo,txnometipologradouro from logradourostipos order by txnometipologradouro";
    $execcmd=mysqli_query($link,$cmdsql);
    printf("<select name='fklogradourotipo'>\n");
    while ( $reg=mysqli_fetch_array($execcmd) )
    {
      $selected=( $reg['pklogradourotipo']==$reglido['fklogradourotipo'] ) ? " SELECTED": "" ;
    printf("<option value='$reg[pklogradourotipo]'$selected>$reg[txnometipologradouro]-($reg[pklogradourotipo])</option>");
    }
    printf("</select>\n");
    printf("</td></tr>\n");
    printf("   <tr><td>Cadastrado em:</td>  <td><input type='date' name='dtcadlogradouro'></td></tr>\n");
    # Aqui termina a montagem dos campos preenchidos com os dados para alteraÃ§Ã£o. Vamos montar a barra de botÃµes
    # Note a barra de botÃµes deve ser montada na coluna da direita da tabela.
    printf("<tr><td></td><td>");
	  botoes("Alterar",TRUE,TRUE); 
    printf("</td></tr>\n");
    printf("</table>");
    printf("</form>");
    break;
  }
  case ($bloco==3):
  { # tratamento da transaÃ§Ã£o.
    # Este bloco Ã© muito semelhante so outros blocos de tratamento de transaÃ§Ã£o que jÃ¡ vimos.
    # PORÃ‰M o bloco de INSERT tem o comando montado DENTRO da transaÃ§Ã£o.
    # Por este motivo este segmento de cÃ³digo nÃ£o precisa ser 'migrado' para uma funÃ§Ã£o 'local'
    # construÃ§Ã£o do comando de atualizaÃ§Ã£o.
    $cmdsql="UPDATE logradouros
                    SET pklogradouro        = '$_REQUEST[pklogradouro]',
                        fkcidade             = '$_REQUEST[fkcidade]',
                        txnomelogradouro     = '$_REQUEST[txnomelogradouro]',
                        fklogradourotipo     = '$_REQUEST[fklogradourotipo]',
                        dtcadlogradouro      = '$_REQUEST[dtcadlogradouro]'
                    WHERE
                      pklogradouro='$_REQUEST[pklogradouro]'";
    ## printf("$cmdsql<br>\n");
    $mostrar=FALSE;
    $tenta=TRUE;
    while ( $tenta )
    { # laÃ§o de controle de exec da trans.
      mysqli_query($link,"START TRANSACTION");
      # execuÃ§Ã£o do cmd.
      mysqli_query($link,$cmdsql);
      # tratamento dos erros de exec do cmd.
      if ( mysqli_errno($link)==0 )
      { # trans pode ser concluÃ­da e nÃ£o reiniciar
        mysqli_query($link,"COMMIT");
        $tenta=FALSE;
        $mostrar=TRUE;
        $mens="Registro com código $_REQUEST[pklogradouro] Alterado!";
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
    {
      mostraregistro("$_REQUEST[pklogradouro]");
    }
    break;
  }
}

terminapagina("Logradouros","Alterar","logradouroAlterar.php");
?>