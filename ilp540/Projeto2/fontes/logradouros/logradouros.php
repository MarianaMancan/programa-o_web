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
printf("<p class='margem1'>\n");
printf("Mariana Frederico Mançan - RA: 0210482123027, desenvolvimento de um sistema de gerenciamento de dados de logradouros<br>\n");
printf("como parte da disciplina de Programação Web na Fatec Ourinhos...<br>\n");
printf("Este sistema permite que os usuários realizem diversas operações, como consultar, alterar, incluir, excluir e listar logradouros.<br>\n");
printf("A funcionalidade de inclusão (Incluir-PA) coleta dados por meio de campos de um formulário e os grava em uma tabela, possibilitando adicionar novos logradouros ao sistema.<br>\n"); # <icog>&#x1f7a5;</icog>
printf("A funcionalidade de exclusão (Excluir-PA) permite ao usuário escolher um registro da tabela de logradouros e exclui a linha correspondente da tabela, possibilitando remover logradouros existentes do sistema.<br>\n"); # <icog>&#x1f7ac;</icog>
printf("A funcionalidade de consulta (Consultar-PA) permite ao usuário selecionar um registro da tabela de logradouros e exibir os dados desse registro específico, fornecendo informações detalhadas sobre um logradouro no sistema.\n"); # <icog>&#x1f50d;&#xfe0e;</icog>
printf("A funcionalidade de listagem (Listar-PA) permite ao usuário selecionar os dados desejados e a ordem de exibição para gerar uma lista de dados da tabela de logradouros, possibilitando obter uma lista personalizada de logradouros com base em critérios específicos, como ordenação alfabética ou filtragem por campos específicos.<br>\n"); # <icog>&#x1f5a8;</icog>
printf("A funcionalidade de alteração (Alterar-PA) permite ao usuário escolher um registro da tabela de logradouros e realizar a alteração dos valores desse registro, possibilitando a atualização das informações de um logradouro existente no sistema.<br>\n"); # <icog>&#x1f589;</icog>
printf("Essas funcionalidades fornecem ao usuário um amplo conjunto de operações para gerenciar eficientemente os dados dos logradouros.");
printf("</p>\n");
terminapagina("Logradouros","Abertura","logradouros.php");
?>