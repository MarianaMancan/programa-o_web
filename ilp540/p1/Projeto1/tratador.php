<html>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='./projeto1.css'>

</head>
<body>

<table width='95%'  >
      <tr >
        <td width='10%'></td>
        <td ><h1>Logradouros</h1></td>
        <td width='10%'></td>
      </tr>
      <tr  >
        <td width='10%'></td>
        <td class='form2'><label for='pklogradouro'>id logradouro:</label></td>
        <td class='form2'><?php echo $_POST["pklogradouro"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr  >
        <td width='10%'></td>
        <td class='form1'><label for='fkcidade'>Cidade</label></td>
        <td class='form1'>
        <?php echo $_POST["fkcidade"]; ?>
        </td>
        <td ></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td class='form2'><label for='txnomelogradouro'>Nome logradouro:</label></td>
        <td class='form2'> <?php echo $_POST["txnomelogradouro"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td class='form1'><label for='dtcadlogradouro'>Data de registro:</label></td>
        <td class='form1'><?php echo $_POST["dtcadlogradouro"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr  >
        <td width='10%'></td>
        <td class='form2'><label for='hrcadlogradouro'>Hora de registro:</label></td>
        <td class='form2'><?php echo $_POST["hrcadlogradouro"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td class='form1'><label for='tiponegocio'>Para:</label></td>
        <td class='form1'>
        <?php echo $_POST["tiponegocio"]; ?>
       
       </td>
        <td width='10%'></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td class='form2'><label for='tipologradouro'>Tipo logradouro:</label></td>
        <td class='form2'>
        <?php echo $_POST["tipologradouro"]; ?>
        </td>
       
        <td width='10%'></td>
      </tr>
      <tr  >
        <td width='10%'></td>
        <td class='form1'><label for='corlogradouro'>Cor logradouro:</label></td>
        <td class='form1'>   <?php echo $_POST["corlogradouro"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr  >
        <td width='10%'></td>
        <td class='form2'> <label for='imglogradouro'>Imagem logradouro:</label></td>
        <td class='form2'><?php echo $_POST["imglogradouro"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td class='form1'><label for='nomeProprietario'>Nome proprietario:</label></td>
        <td class='form1'><?php echo $_POST["nomeProprietario"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td class='form2'><label for='senhaProprietario'>Senha proprietario:</label></td>
        <td class='form2'><?php echo $_POST["senhaProprietario"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr  >
        <td width='10%'></td>
        <td class='form1'><label for='emailProprietario'>Email proprietario:</label></td>
        <td class='form1'><?php echo $_POST["emailProprietario"]; ?></td>
        <td width='10%'></td>
      </tr>
    </tr>
    <tr >
      <td width='10%'></td>
      <td class='form2'><label for='animais'>Permiti animais:</label></td>
      <td class='form2'><?php echo $_POST["animais"]; ?></td>
      <td width='10%'></td>
    </tr>
      <tr >
        <td width='10%'></td>
        <td class='form1'><label for='telefoneProprietario'>Telefone proprietario:</label></td>
        <td class='form1'><?php echo $_POST["telefoneProprietario"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td class='form2'><label for='siteProprietario'>Site:</label></td>
        <td class='form2'><?php echo $_POST["siteProprietario"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td  class='form1'><label for='pesquisar'>Pesquisar logradouro:</label></td>
        <td  class='form1'><?php echo $_POST["q"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td  class='form2'><label for='datatime'>Data time:</label></td>
        <td  class='form2'><?php echo $_POST["datatime"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td  class='form1'><label for='mes'>Mês:</label></td>
        <td  class='form1'><?php echo $_POST["mes"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td  class='form2'><label for='week'>Semana:</label></td>
        <td  class='form2'><?php echo $_POST["week"]; ?></td>
        <td width='10%'></td>
      </tr>
      <tr >
        <td width='10%'></td>
        <td class='form1'><label for='observacao'>Observações:</label></td>
        <td class='form1'><?php echo $_POST["observacao"]; ?></td>
        <td width='10%'></td>
      </tr>
      
    </table>
</body>
</html>