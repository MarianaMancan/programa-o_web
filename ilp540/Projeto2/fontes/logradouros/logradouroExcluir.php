<?php
require_once("../../funcoes/catalogo.php");
require_once("./logradouroFuncoes.php"); 

$bloco=( ISSET($_REQUEST['bloco']) ) ? $_REQUEST['bloco'] : 1;
$sair=$_REQUEST['sair']+1;
$menu=$_REQUEST['sair'];
iniciapagina(TRUE,"logradouros","logradouros","Excluir");

montamenu("Excluir",$sair);


switch(true)
{
  case ($bloco==1):
  {
    picklist("Excluir");
  
    break;
  }
  case ($bloco==2):
  { 
    mostraregistro($_REQUEST['pklogradouro']);
    printf("  <form action='logradouroExcluir.php' method='post'>\n");
    printf("   <input type='hidden' name='bloco' value='3'>\n");
    printf("   <input type='hidden' name='sair' value='$sair'>\n");
    printf("   <input type='hidden' name='pklogradouro' value='$_REQUEST[pklogradouro]'>\n");
    botoes("Excluir",FALSE,TRUE);
    printf("  </form>\n");
    break;
   
    
  }
  case($bloco==3):
    {

    # Tratamento da transação
        # montando o comando SQL que será 'submetido' ao SGBD.
        $cmdsql="DELETE FROM logradouros WHERE pklogradouro='$_REQUEST[pklogradouro]'";
        $tenta=TRUE;
       while ( $tenta )
       { 

        mysqli_query($link,"START TRANSACTION");
        mysqli_query($link,$cmdsql);
     
           if ( mysqli_errno($link)==0 ){
    
             mysqli_query($link,"COMMIT");
             $tenta=FALSE;
             $mens="Registro com código $_REQUEST[pklogradouro] excluído!";
             $mostrar=TRUE;
          
            
           }
           else
           {
             if ( mysqli_errno($link)==1213 )
             { # abortar a trans e reiniciar
               $tenta=TRUE;
             }
             else
             { # abortar a trans e NÃO reiniciar
               $tenta=FALSE;
               $mens=mysqli_errno($link)."-".mysqli_error($link);
             }
             mysqli_query($link,"ROLLBACK");
             $mostrar=FALSE;
           }
       
       # a variável $mens contém a mensagem que vai ser exibida de qualquer modo de saída do laço.
       printf("$mens<br>\n");
       
    
       
         break;
       }

    }
 
  }
  terminapagina("Logradouros","Excluir","logradouroExcluir.php");
?>
