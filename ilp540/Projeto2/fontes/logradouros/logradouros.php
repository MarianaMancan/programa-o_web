<?php
#################################################################################################################################################################################### Programa.: medicos (medicos.php)
# Descrição: Inclui a execução dos arquivos externos ("../../funcoes/toolskit1.php" e "./medicosfuncoes.php"), identifica valor de variável
#            de controle de saltos entre aplicativos ($sair). Executa funções externas e exibe mensagem de orientação do uso do sistema.
# Ojetivo..: Funcionalidade "Abertura" do Sistema de Gerenciamento de Dados na tabela medicos.
# Autor....: Mariana Frederico Mançan
# Criação..: 2023-05-18

#################################################################################################################################################################################### Referenciando o arquivo toolskit.php
# estrutura de diretórios onde se posicionam os arquivos dos PA
# localhost/funcoes/ - arquivo de funções (toolsbag.php)
#          /fontes/NomeTab/ - Arquivos dos PAs e o arquivo .css configurando os elementos da página do SI de Gerenciamento de Dados.
# O NomeTab deve ser o nome da tabela como está escrito na base de dados do exercício PRATICASQL.
require_once("../../funcoes/catalogo.php");
require_once("./logradouroFuncoes.php"); 

# Determinando o valor de $sair.
$sair=( ISSET($_REQUEST['sair']) ) ? $_REQUEST['sair'] : 1;
$menu=$sair-1;
# monstrando o valor de $sair em cada execução
# printf("$sair<br>\n");
iniciapagina(TRUE,"logradouros","logradouros","Abertura");
montamenu("Abertura",$sair);
printf("<texto>\n");
printf("Sistema desenvolvido por Mariana Frederico Mançan - RA:0210482123027.<br>\n");
printf("Na displina de programação web na instituição Fatec ourinhos.<br>\n");
printf("Este sistema faz o Gerenciamento de dados da Tabela logradouros.<br>\n");
printf("Permintindo ao usuario consultar,alterar,incluir,excluir e listar logradouros.<br>\n");
printf("<u>Incluir</u>-PA que coleta dados (em campos de um formulário) e grava em uma tabela.<br>\n"); # <icog>&#x1f7a5;</icog>
printf("<u>Excluir</u>-PA que permite escolher um registro de uma tabela e excluir a linha escolhida da tabela.<br>\n"); # <icog>&#x1f7ac;</icog>
printf("<u>Consultar</u>-PA que permite escolher um registro de uma tabela e mostra os dados dos registro escolhido.<br>\n"); # <icog>&#x1f50d;&#xfe0e;</icog>
printf("<u>Listar</u> -PA que permite escolher dados e ordenação para emitir uma listagem de dados da tabela.<br>\n"); # <icog>&#x1f5a8;</icog>
printf("<u>Alterar</u>-PA que permite escolher um registro de uma tabela e executar a alteração de valores do mesmo registro.<br>\n"); # <icog>&#x1f589;</icog>
printf("</texto>\n");
terminapagina("Logradouros","Abertura","logradouros.php");
?>