<?php

use \App\Session\Login;

$usuarioLogado = Login::getUserLogado();
$usuario = $usuarioLogado ? $usuarioLogado['nome'].'<a href="logout.php" class="text-light font-weight-bold ml-2"> Sair</a>'  :
' Visitante <a href="login.php" class="text-light font-weight-bold ml-2"> Entrar</a>';

?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WF Vagas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-dark text-light">

    <div class="container">

      <div class="jumbotron bg-danger">
        <h1>WF Software</h1>
        <p></p>

        <hr class="border-light">

        <div class="d-flex justify-content-start">
          <?= $usuario ?>
        </div>

      </div>
