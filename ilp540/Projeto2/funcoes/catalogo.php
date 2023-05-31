
<?php

function iniciapagina($fundo,$tittab,$tabela,$acao)
{
  # Função.....: iniciapagina
  # Descricao..: Emite as TAGs de inicio de página HTML

  printf("<html>\n");
  printf("<head>\n");
  printf("<title>$tabela-$acao</title>\n");
  printf("<link rel='stylesheet' href='./$tabela.css'>\n");
  printf("</head>\n");
  printf($fundo ? " <body class='$acao'>\n" : " <body>\n");

}
function terminapagina($tabela,$acao,$prg)
{
  # Função.....: terminapagina
  printf(" <hr>$tabela %s | &copy; ".date('Y')." - Mariana Frederico Mançan FATEC-4ºADS | $prg",$acao? " - ".$acao : "");
  printf(" </body>\n");
  printf("</html>");
}
function conectamariadb($server,$username,$senha,$dbname)
{
 # função.....: conexão com bancos de dados do gerenciador MariaDB.
  global $link;
  $link=mysqli_connect($server,$username,$senha,$dbname);
}

conectamariadb("localhost","root","","ilp540");


?>

