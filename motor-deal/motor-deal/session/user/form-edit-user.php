<?php
    //Chamada de inclusão do arquivo de conexão com o BD.
    include("../../configuration/connection.php");

    //Chamada para o arquivo que verifica se o usuário está logado.
    include("../../configuration/user-session.php");

    //Recupera o ID do usuário via método GET.
    $id = $_GET["id"];

    //Instrução SQL que puxa os dados do usuário.
    $SQL = "SELECT nome, cpf, data_nascimento, genero, cep, logradouro, 
                   numero_residencia, complemento, bairro, cidade, estado,
                   codigo_area, numero_celular, email
            FROM usuario
            WHERE id = $id;";

    //Executa a instrução SQL.
    $consulta = mysqli_query($connect, $SQL);

    //Criar um array, para exibir as informações do usuário.
    $usuario = mysqli_fetch_assoc($consulta);
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Motor Deal - Edição de Cadastro de Usuário</title>

    <!-- Link de referência ao CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
        <div class="row justify-content-center">

            <!-- Captura e apresenta os retornos para o usuário -->
            <div class="row mb-4">
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

            <form action="proccess-edit-user.php" method="post" class="row">
                
                <!-- Nome e CPF -->
                <div class="row">
                    <div class="col-2 my-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?php print($id); ?>" readonly>
                    </div>
                    <div class="col-5 my-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php print($usuario["nome"]); ?>">
                    </div>
                    <div class="col-5 my-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php print($usuario["cpf"]); ?>">
                    </div>
                </div>

                <!-- Data de nascimento e genêro -->
                <div class="row">
                    <div class="col-8 my-3">
                        <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value="<?php print($usuario["data_nascimento"]); ?>">
                    </div>
                    <div class="col-4 my-3">
                        <label for="genero" class="form-label">Gênero</label>
                        <select id="genero" name="genero" class="form-select">
                          <option selected>Selecione o gênero...</option>
                          <option value="M">Masculino</option>
                          <option value="F">Feminino</option>
                          <option value="N">Não informar</option>
                        </select>
                    </div>
                </div>

                <!-- CEP, endereço e número da residência -->
                <div class="row">
                    <div class="col-4 my-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" value="<?php print($usuario["cep"]); ?>">
                    </div>
                    <div class="col-4 my-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" value="<?php print($usuario["logradouro"]); ?>">
                    </div>
                    <div class="col-4 my-3">
                        <label for="numeroResidencia" class="form-label">Número da Residência</label>
                        <input type="text" class="form-control" id="numeroResidencia" name="numeroResidencia" value="<?php print($usuario["numero_residencia"]); ?>">
                    </div>
                </div>

                <!-- Complemento, bairro e cidade -->
                <div class="row">
                    <div class="col-4 my-3">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento" value="<?php print($usuario["complemento"]); ?>">
                    </div>
                    <div class="col-4 my-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" value="<?php print($usuario["bairro"]); ?>">
                    </div>
                    <div class="col-4 my-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" value="<?php print($usuario["cidade"]); ?>">
                    </div>
                </div>

                <!-- Estado, código de área e celular -->
                <div class="row">
                    <div class="col-4 my-3">
                        <label for="estado" class="form-label">UF</label>
                        <select id="estado" name="estado" class="form-select">
                          <option selected>Selecione o estado...</option>
                          <option value="AC">Acre</option>
                          <option value="AL">Alagoas</option>
                          <option value="AP">Amapá</option>
                          <option value="AM">Amazonas</option>
                          <option value="BA">Bahia</option>
                          <option value="CE">Ceará</option>
                          <option value="DF">Distrito Federal</option>
                          <option value="ES">Espirito Santo</option>
                          <option value="GO">Goiás</option>
                          <option value="MA">Maranhão</option>
                          <option value="MS">Mato Grosso do Sul</option>
                          <option value="MT">Mato Grosso</option>
                          <option value="MG">Minas Gerais</option>
                          <option value="PA">Pará</option>
                          <option value="PB">Paraíba</option>
                          <option value="PR">Paraná</option>
                          <option value="PE">Pernambuco</option>
                          <option value="PI">Piauí</option>
                          <option value="RJ">Rio de Janeiro</option>
                          <option value="RN">Rio Grande do Norte</option>
                          <option value="RS">Rio Grande do Sul</option>
                          <option value="RO">Rondônia</option>
                          <option value="RR">Roraima</option>
                          <option value="SC">Santa Catarina</option>
                          <option value="SP">São Paulo</option>
                          <option value="SE">Sergipe</option>
                          <option value="TO">Tocantins</option>
                        </select>
                    </div>
                    <div class="col-4 my-3">
                        <label for="codigoArea" class="form-label">Código de Área</label>
                        <select id="codigoArea" name="codigoArea" class="form-select">
                          <option selected>Selecione o código de área...</option>
                          <option value="+55">Brasil (+55)</option>
                        </select>
                    </div>
                    <div class="col-4 my-3">
                        <label for="celular" class="form-label">Celular com DDD</label>
                        <input type="celular" class="form-control" id="celular" name="celular" value="<?php print($usuario["numero_celular"]); ?>">
                    </div>
                </div>

                <!-- E-mail e senha -->
                <div class="row">
                    <div class="col-12 my-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php print($usuario["email"]); ?>">
                    </div>
                </div>
                
                <!-- Botão de voltar e de salvar -->
                <div class="row">
                    <div class="col-12 my-3">
                        <a href="proccess-list-users.php" class="btn btn-primary">Voltar</a>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Link de referência ao JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
<?php 
    //Encerra a conexão com o BD.
    mysqli_close($connect);
?>