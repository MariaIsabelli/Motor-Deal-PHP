
  <?php
    //Define o padrão de formatação dos caracteres.
    header("Content-Type: text;html; charset=utf-8");

    //Variaveis de conexão com a base de dados.
    $host = "localhost";
    $user = "root";
    $password = "root";
    $database = "software_web_db";

    //Comando de conexão com o banco de dados MySQL.
    $connect = mysqli_connect($host, $user, $password, $database);

    //Retorna o código do erro de conexão com a base de dados.
    if(!$connect){
      print("Falha na conexão com a base de dados... Código do erro: " . mysqli_connect_errno());
    }
  ?>
