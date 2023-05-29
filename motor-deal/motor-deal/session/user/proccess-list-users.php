<?php
  //Chamada para o arquivo de conexão com o BD.
  include("../../configuration/connection.php");

  //Chamada para o arquivo que verifica se o usuário está logado.
  include("../../configuration/user-session.php");
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Motor Deal - Listagem de Usuários</title>

    <!-- Link de referência ao CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Link de referência do CSS de Icones do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  </head>
  <body>

    <!-- Cabeçalho do website -->
    <header class="p-3 text-center">
        <h2 class="text-uppercase text-danger">Motor Deal</h2>
        <h4>Escola SENAI "Luiz Massa" - Botucatu (SP)</h4>
    </header>

    <!-- Menu do website -->
    <nav class="navbar navbar-expand-lg bg-danger" id="navbarSupportedContent">
        <div class="container-fluid">
          <a class="text-uppercase navbar-brand text-light" href="../dashboard.php">Dashboard</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <!-- Itens dropdown do menu interno -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Usuários
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="form-create-user.php">Cadastrar</a></li>
                  <li><a class="dropdown-item" href="proccess-list-users.php">Listar</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Clientes
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Cadastrar</a></li>
                  <li><a class="dropdown-item" href="#">Listar</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Veículos
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Cadastrar</a></li>
                  <li><a class="dropdown-item" href="#">Listar</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Vendas
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Efetuar Venda</a></li>
                  <li><a class="dropdown-item" href="#">Listar Vendas</a></li>
                </ul>
              </li>

            </ul>

          </div>

          <!-- Itens alinhados a direita do menu interno -->
          <div class="navbar-nav">
            <a class="fw-bold d-flex nav-link text-light" href="exit.php">Sair</a>
          </div>

        </div>
    </nav>

    <!-- Seção do formulário -->
    <section class="container py-5">

      <div class="row">

        <!-- Captura e apresenta os retornos para o usuário -->
        <div class="row align-itens-center">
          <div class="text-center">
            <?php 
              //Verifica se existe alguma mensagem de retorno.
              if(isset($_SESSION['retorno'])){

                //Apresenta a mensagem de retorno para o usuário.
                print($_SESSION['retorno']);

                //Deleta a variável de sessão.
                unset($_SESSION['retorno']);
              }
            ?>
          </div>
        </div>  

        <div class="mx-auto mt-5">

            <!-- Tabela que exibe os usuários -->
            <table class="text-center table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Visualizar</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>
                <tbody>

                  <?php
                    //Chamada de inclusão do arquivo de conexão com o BD.
                    include("../configuration/connection.php");

                    //Instrução SQL de seleção dos usuários.
                    $SQL = "SELECT id, nome, cpf FROM usuario WHERE ativo = 1;";

                    //Executa a consulta SQL.
                    $consulta = mysqli_query($connect, $SQL);

                    //Verifica se existem retornos na consulta SQL.
                    if (mysqli_num_rows($consulta) > 0){

                      //Laço de repetição dos usuários.
                      //Apresenta todos os usuários do BD.
                      while ($usuario = mysqli_fetch_assoc($consulta)){
                        ?>
                        <tr>
                          <th scope="row"><?php print($usuario["id"]); ?></th>
                          <td><?php print($usuario["nome"]); ?></td>
                          <td><?php print($usuario["cpf"]); ?></td>
                          <td><a href="form-view-user.php?id=<?php print($usuario["id"]); ?>"><i class="bi bi-eye-fill"></i></a></td>
                          <td><a href="form-edit-user.php?id=<?php print($usuario["id"]); ?>"><i class="bi bi-pencil-square"></i></a></td>
                          <td><a href="proccess-delete-user.php?id=<?php print($usuario["id"]); ?>"><i class="bi bi-trash3-fill"></i></a></td>
                        </tr>
                        <?php
                      }
                      
                      //Fecha a conexâo com o BD.
                      mysqli_close($connect);

                    }else{
                      //Retorna a mensagem para o usuário.
                      print("Não existem usuários cadastrados no banco de dados.");

                      //Fecha a conexão com o BD.
                      mysqli_close($connect);
                    }
                  ?>
                    
                </tbody>
            </table>
        </div>

      </div>

    </section>

    <!-- Link de referência ao JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>