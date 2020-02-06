<?php

$url = "https://jsonplaceholder.typicode.com/users"; 
$data = file_get_contents($url); 
$users = json_decode($data,1);
$match = "";

if (isset($_GET['filtro'])) {
  if (($_GET['filtro'] != '')&&($_GET['valorFiltro'] != '')) {
    foreach ($users as $user) {
      $arrayExplode = explode(" ",$user[$_GET['filtro']]);
      if (array_search($_GET['valorFiltro'],$arrayExplode)!== false) {
        $match = $user[$_GET['filtro']];
      }
    }
  }
}

if (isset($_GET['dir'])) {
  if ($_GET['dir'] != '') {
  foreach ($users as $user => $row) {
        $user_name[$user] = $row[$_GET['field']];
      }
      array_multisort($user_name, SORT_ASC, $users);
      if ($_GET['dir'] != 'desc') {
        array_multisort($user_name, SORT_DESC, $users);
      }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <meta charset="UTF-8">
      <title>Table Api Rest</title>
  </head>

  <style>

  h1,label {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  }

  #clientTable {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #clientTable td, #clientTable th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #clientTable tr:nth-child(even){background-color: #f2f2f2;}

  #clientTable tr:hover {background-color: #ddd;}

  #clientTable th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #343252;
    color: white;
  }

  #btnShowInfo {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    cursor: pointer;
    padding: 5px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    box-shadow: 0 2px 8px 0 rgba(0,0,0,0.15);
    border: 0;
    background: #7bda7b;
    color: white;
    border-radius: 3px;
    font-size: 16px;
    float: right;
  }
  </style>
  <body>
    <h1>Clientes</h1>
    <hr>
    <br>
    <form action="index.php">
    <label>Pesquisar por:</label>
    <select name = "filtro">
      <option value="name">Nome</option>
      <option value="username">Usuário</option>
      <option value="email">E-mail</option>
      <option value="phone">Telefone</option>
    </select>
    <input type="text" name="valorFiltro" id="filtro">
    <input type="submit" value="Pesquisar">
    </form> 
    <table id = "clientTable">
      <tr>
        
        <th>
          Nome
          <a href="index.php?dir=desc&field=name">
            <img style = "width:20px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDUgNTEyLjAwNSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwNSA1MTIuMDA1OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiPjxnPjxnPgoJPGc+CgkJPHBhdGggZD0iTTM5Mi4xNzMsMjM2LjI5M2MtNy45NTctMy4zMjgtMTcuMTUyLTEuNDkzLTIzLjI1Myw0LjYyOUwyNTYuMDAyLDM1My44NEwxNDMuMDg1LDI0MC45MjIgICAgYy02LjEwMS02LjEwMS0xNS4yNTMtNy45NTctMjMuMjUzLTQuNjI5Yy03Ljk3OSwzLjI4NS0xMy4xNjMsMTEuMDkzLTEzLjE2MywxOS43MTJ2MTA4LjEzOWMwLDUuNzE3LDIuMzA0LDExLjE3OSw2LjMzNiwxNS4xNjggICAgbDEyOCwxMjYuNTI4YzQuMTYsNC4wOTYsOS41NzksNi4xNjUsMTQuOTk3LDYuMTY1YzUuNDE5LDAsMTAuODM3LTIuMDY5LDE0Ljk5Ny02LjE2NWwxMjgtMTI2LjUyOCAgICBjNC4wNTMtMy45ODksNi4zMzYtOS40NTEsNi4zMzYtMTUuMTY4di0xMDguMTRDNDA1LjMzNSwyNDcuMzg2LDQwMC4xNTEsMjM5LjU3NywzOTIuMTczLDIzNi4yOTN6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0zOTIuMTczLDEuNjI2Yy03Ljk1Ny0zLjMwNy0xNy4xNTItMS40NzItMjMuMjUzLDQuNjI5TDI1Ni4wMDIsMTE5LjE3M0wxNDMuMDg1LDYuMjU2ICAgIGMtNi4xMDEtNi4xMDEtMTUuMjUzLTcuOTM2LTIzLjI1My00LjYyOWMtNy45NzksMy4yODUtMTMuMTYzLDExLjA5My0xMy4xNjMsMTkuNzEydjEwOC4xMzljMCw1LjcxNywyLjMwNCwxMS4xNzksNi4zMzYsMTUuMTY4ICAgIGwxMjgsMTI2LjUyOGM0LjE2LDQuMDk2LDkuNTc5LDYuMTY1LDE0Ljk5Nyw2LjE2NWM1LjQxOSwwLDEwLjgzNy0yLjA2OSwxNC45OTctNi4xNjVsMTI4LTEyNi41MjggICAgYzQuMDUzLTMuOTg5LDYuMzM2LTkuNDUxLDYuMzM2LTE1LjE2OFYyMS4zMzhDNDA1LjMzNSwxMi43Miw0MDAuMTUxLDQuOTEyLDM5Mi4xNzMsMS42MjZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />
          </a>
          <a href="index.php?dir=asc&field=name">
            <img style = "width:20px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDEgNTEyLjAwMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwMSA1MTIuMDAxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSIiPjxnPjxnPgoJPGc+CgkJPHBhdGggZD0iTTM5OC45OTgsMTMyLjY3MmwtMTI4LTEyNi41MjhjLTguMzQxLTguMTkyLTIxLjY3NS04LjE5Mi0yOS45OTUsMGwtMTI4LDEyNi41MjhjLTQuMDUzLDMuOTg5LTYuMzM2LDkuNDUxLTYuMzM2LDE1LjE2OCAgICB2MTA4LjEzOWMwLDguNjQsNS4xODQsMTYuNDI3LDEzLjE2MywxOS43MTJjNy45NTcsMy4zMDcsMTcuMTMxLDEuNDcyLDIzLjI1My00LjYyOUwyNTYsMTU4LjE0NGwxMTIuOTE3LDExMi45MTcgICAgYzQuMDc1LDQuMDk2LDkuNTM2LDYuMjUxLDE1LjA4Myw2LjI1MWMyLjc1MiwwLDUuNTI1LTAuNTEyLDguMTcxLTEuNjIxYzcuOTc5LTMuMjg1LDEzLjE2My0xMS4wNzIsMTMuMTYzLTE5LjcxMlYxNDcuODQgICAgQzQwNS4zMzQsMTQyLjEyMyw0MDMuMDMsMTM2LjY2MSwzOTguOTk4LDEzMi42NzJ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0zOTguOTk4LDM2Ny4zNDdsLTEyOC0xMjYuNTI4Yy04LjM0MS04LjIxMy0yMS42NzUtOC4yMTMtMjkuOTk1LDBsLTEyOCwxMjYuNTI4Yy00LjA1MywzLjk4OS02LjMzNiw5LjQ1MS02LjMzNiwxNS4xNjggICAgdjEwOC4xMzljMCw4LjYxOSw1LjE4NCwxNi40MDUsMTMuMTYzLDE5LjcxMmM3Ljk1NywzLjMyOCwxNy4xMzEsMS40NzIsMjMuMjUzLTQuNjI5TDI1NiwzOTIuODE5bDExMi45MTcsMTEyLjkxNyAgICBjNC4wNzUsNC4wNzUsOS41MzYsNi4yNTEsMTUuMDgzLDYuMjUxYzIuNzUyLDAsNS41MjUtMC41MTIsOC4xNzEtMS42MjFjNy45NzktMy4zMDcsMTMuMTYzLTExLjA5MywxMy4xNjMtMTkuNzEyVjM4Mi41MTUgICAgQzQwNS4zMzQsMzc2Ljc5OCw0MDMuMDMsMzcxLjMzNiwzOTguOTk4LDM2Ny4zNDd6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />
          </a>
        </th>
        
        <th>
          Usuário
          <a href="index.php?dir=desc&field=username">
            <img style = "width:20px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDUgNTEyLjAwNSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwNSA1MTIuMDA1OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiPjxnPjxnPgoJPGc+CgkJPHBhdGggZD0iTTM5Mi4xNzMsMjM2LjI5M2MtNy45NTctMy4zMjgtMTcuMTUyLTEuNDkzLTIzLjI1Myw0LjYyOUwyNTYuMDAyLDM1My44NEwxNDMuMDg1LDI0MC45MjIgICAgYy02LjEwMS02LjEwMS0xNS4yNTMtNy45NTctMjMuMjUzLTQuNjI5Yy03Ljk3OSwzLjI4NS0xMy4xNjMsMTEuMDkzLTEzLjE2MywxOS43MTJ2MTA4LjEzOWMwLDUuNzE3LDIuMzA0LDExLjE3OSw2LjMzNiwxNS4xNjggICAgbDEyOCwxMjYuNTI4YzQuMTYsNC4wOTYsOS41NzksNi4xNjUsMTQuOTk3LDYuMTY1YzUuNDE5LDAsMTAuODM3LTIuMDY5LDE0Ljk5Ny02LjE2NWwxMjgtMTI2LjUyOCAgICBjNC4wNTMtMy45ODksNi4zMzYtOS40NTEsNi4zMzYtMTUuMTY4di0xMDguMTRDNDA1LjMzNSwyNDcuMzg2LDQwMC4xNTEsMjM5LjU3NywzOTIuMTczLDIzNi4yOTN6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0zOTIuMTczLDEuNjI2Yy03Ljk1Ny0zLjMwNy0xNy4xNTItMS40NzItMjMuMjUzLDQuNjI5TDI1Ni4wMDIsMTE5LjE3M0wxNDMuMDg1LDYuMjU2ICAgIGMtNi4xMDEtNi4xMDEtMTUuMjUzLTcuOTM2LTIzLjI1My00LjYyOWMtNy45NzksMy4yODUtMTMuMTYzLDExLjA5My0xMy4xNjMsMTkuNzEydjEwOC4xMzljMCw1LjcxNywyLjMwNCwxMS4xNzksNi4zMzYsMTUuMTY4ICAgIGwxMjgsMTI2LjUyOGM0LjE2LDQuMDk2LDkuNTc5LDYuMTY1LDE0Ljk5Nyw2LjE2NWM1LjQxOSwwLDEwLjgzNy0yLjA2OSwxNC45OTctNi4xNjVsMTI4LTEyNi41MjggICAgYzQuMDUzLTMuOTg5LDYuMzM2LTkuNDUxLDYuMzM2LTE1LjE2OFYyMS4zMzhDNDA1LjMzNSwxMi43Miw0MDAuMTUxLDQuOTEyLDM5Mi4xNzMsMS42MjZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />
          </a>
          <a href="index.php?dir=asc&field=username">
            <img style = "width:20px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDEgNTEyLjAwMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwMSA1MTIuMDAxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSIiPjxnPjxnPgoJPGc+CgkJPHBhdGggZD0iTTM5OC45OTgsMTMyLjY3MmwtMTI4LTEyNi41MjhjLTguMzQxLTguMTkyLTIxLjY3NS04LjE5Mi0yOS45OTUsMGwtMTI4LDEyNi41MjhjLTQuMDUzLDMuOTg5LTYuMzM2LDkuNDUxLTYuMzM2LDE1LjE2OCAgICB2MTA4LjEzOWMwLDguNjQsNS4xODQsMTYuNDI3LDEzLjE2MywxOS43MTJjNy45NTcsMy4zMDcsMTcuMTMxLDEuNDcyLDIzLjI1My00LjYyOUwyNTYsMTU4LjE0NGwxMTIuOTE3LDExMi45MTcgICAgYzQuMDc1LDQuMDk2LDkuNTM2LDYuMjUxLDE1LjA4Myw2LjI1MWMyLjc1MiwwLDUuNTI1LTAuNTEyLDguMTcxLTEuNjIxYzcuOTc5LTMuMjg1LDEzLjE2My0xMS4wNzIsMTMuMTYzLTE5LjcxMlYxNDcuODQgICAgQzQwNS4zMzQsMTQyLjEyMyw0MDMuMDMsMTM2LjY2MSwzOTguOTk4LDEzMi42NzJ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0zOTguOTk4LDM2Ny4zNDdsLTEyOC0xMjYuNTI4Yy04LjM0MS04LjIxMy0yMS42NzUtOC4yMTMtMjkuOTk1LDBsLTEyOCwxMjYuNTI4Yy00LjA1MywzLjk4OS02LjMzNiw5LjQ1MS02LjMzNiwxNS4xNjggICAgdjEwOC4xMzljMCw4LjYxOSw1LjE4NCwxNi40MDUsMTMuMTYzLDE5LjcxMmM3Ljk1NywzLjMyOCwxNy4xMzEsMS40NzIsMjMuMjUzLTQuNjI5TDI1NiwzOTIuODE5bDExMi45MTcsMTEyLjkxNyAgICBjNC4wNzUsNC4wNzUsOS41MzYsNi4yNTEsMTUuMDgzLDYuMjUxYzIuNzUyLDAsNS41MjUtMC41MTIsOC4xNzEtMS42MjFjNy45NzktMy4zMDcsMTMuMTYzLTExLjA5MywxMy4xNjMtMTkuNzEyVjM4Mi41MTUgICAgQzQwNS4zMzQsMzc2Ljc5OCw0MDMuMDMsMzcxLjMzNiwzOTguOTk4LDM2Ny4zNDd6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />
          </a>
        </th>

        <th>
          E-mail
          <a href="index.php?dir=desc&field=email">
            <img style = "width:20px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDUgNTEyLjAwNSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwNSA1MTIuMDA1OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiPjxnPjxnPgoJPGc+CgkJPHBhdGggZD0iTTM5Mi4xNzMsMjM2LjI5M2MtNy45NTctMy4zMjgtMTcuMTUyLTEuNDkzLTIzLjI1Myw0LjYyOUwyNTYuMDAyLDM1My44NEwxNDMuMDg1LDI0MC45MjIgICAgYy02LjEwMS02LjEwMS0xNS4yNTMtNy45NTctMjMuMjUzLTQuNjI5Yy03Ljk3OSwzLjI4NS0xMy4xNjMsMTEuMDkzLTEzLjE2MywxOS43MTJ2MTA4LjEzOWMwLDUuNzE3LDIuMzA0LDExLjE3OSw2LjMzNiwxNS4xNjggICAgbDEyOCwxMjYuNTI4YzQuMTYsNC4wOTYsOS41NzksNi4xNjUsMTQuOTk3LDYuMTY1YzUuNDE5LDAsMTAuODM3LTIuMDY5LDE0Ljk5Ny02LjE2NWwxMjgtMTI2LjUyOCAgICBjNC4wNTMtMy45ODksNi4zMzYtOS40NTEsNi4zMzYtMTUuMTY4di0xMDguMTRDNDA1LjMzNSwyNDcuMzg2LDQwMC4xNTEsMjM5LjU3NywzOTIuMTczLDIzNi4yOTN6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0zOTIuMTczLDEuNjI2Yy03Ljk1Ny0zLjMwNy0xNy4xNTItMS40NzItMjMuMjUzLDQuNjI5TDI1Ni4wMDIsMTE5LjE3M0wxNDMuMDg1LDYuMjU2ICAgIGMtNi4xMDEtNi4xMDEtMTUuMjUzLTcuOTM2LTIzLjI1My00LjYyOWMtNy45NzksMy4yODUtMTMuMTYzLDExLjA5My0xMy4xNjMsMTkuNzEydjEwOC4xMzljMCw1LjcxNywyLjMwNCwxMS4xNzksNi4zMzYsMTUuMTY4ICAgIGwxMjgsMTI2LjUyOGM0LjE2LDQuMDk2LDkuNTc5LDYuMTY1LDE0Ljk5Nyw2LjE2NWM1LjQxOSwwLDEwLjgzNy0yLjA2OSwxNC45OTctNi4xNjVsMTI4LTEyNi41MjggICAgYzQuMDUzLTMuOTg5LDYuMzM2LTkuNDUxLDYuMzM2LTE1LjE2OFYyMS4zMzhDNDA1LjMzNSwxMi43Miw0MDAuMTUxLDQuOTEyLDM5Mi4xNzMsMS42MjZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />
          </a>
          <a href="index.php?dir=asc&field=email">
            <img style = "width:20px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDEgNTEyLjAwMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwMSA1MTIuMDAxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSIiPjxnPjxnPgoJPGc+CgkJPHBhdGggZD0iTTM5OC45OTgsMTMyLjY3MmwtMTI4LTEyNi41MjhjLTguMzQxLTguMTkyLTIxLjY3NS04LjE5Mi0yOS45OTUsMGwtMTI4LDEyNi41MjhjLTQuMDUzLDMuOTg5LTYuMzM2LDkuNDUxLTYuMzM2LDE1LjE2OCAgICB2MTA4LjEzOWMwLDguNjQsNS4xODQsMTYuNDI3LDEzLjE2MywxOS43MTJjNy45NTcsMy4zMDcsMTcuMTMxLDEuNDcyLDIzLjI1My00LjYyOUwyNTYsMTU4LjE0NGwxMTIuOTE3LDExMi45MTcgICAgYzQuMDc1LDQuMDk2LDkuNTM2LDYuMjUxLDE1LjA4Myw2LjI1MWMyLjc1MiwwLDUuNTI1LTAuNTEyLDguMTcxLTEuNjIxYzcuOTc5LTMuMjg1LDEzLjE2My0xMS4wNzIsMTMuMTYzLTE5LjcxMlYxNDcuODQgICAgQzQwNS4zMzQsMTQyLjEyMyw0MDMuMDMsMTM2LjY2MSwzOTguOTk4LDEzMi42NzJ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0zOTguOTk4LDM2Ny4zNDdsLTEyOC0xMjYuNTI4Yy04LjM0MS04LjIxMy0yMS42NzUtOC4yMTMtMjkuOTk1LDBsLTEyOCwxMjYuNTI4Yy00LjA1MywzLjk4OS02LjMzNiw5LjQ1MS02LjMzNiwxNS4xNjggICAgdjEwOC4xMzljMCw4LjYxOSw1LjE4NCwxNi40MDUsMTMuMTYzLDE5LjcxMmM3Ljk1NywzLjMyOCwxNy4xMzEsMS40NzIsMjMuMjUzLTQuNjI5TDI1NiwzOTIuODE5bDExMi45MTcsMTEyLjkxNyAgICBjNC4wNzUsNC4wNzUsOS41MzYsNi4yNTEsMTUuMDgzLDYuMjUxYzIuNzUyLDAsNS41MjUtMC41MTIsOC4xNzEtMS42MjFjNy45NzktMy4zMDcsMTMuMTYzLTExLjA5MywxMy4xNjMtMTkuNzEyVjM4Mi41MTUgICAgQzQwNS4zMzQsMzc2Ljc5OCw0MDMuMDMsMzcxLjMzNiwzOTguOTk4LDM2Ny4zNDd6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />
          </a>
        </th>
        
        <th>
          Telefone
          <a href="index.php?dir=desc&field=phone">
          <img style = "width:20px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDUgNTEyLjAwNSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwNSA1MTIuMDA1OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiPjxnPjxnPgoJPGc+CgkJPHBhdGggZD0iTTM5Mi4xNzMsMjM2LjI5M2MtNy45NTctMy4zMjgtMTcuMTUyLTEuNDkzLTIzLjI1Myw0LjYyOUwyNTYuMDAyLDM1My44NEwxNDMuMDg1LDI0MC45MjIgICAgYy02LjEwMS02LjEwMS0xNS4yNTMtNy45NTctMjMuMjUzLTQuNjI5Yy03Ljk3OSwzLjI4NS0xMy4xNjMsMTEuMDkzLTEzLjE2MywxOS43MTJ2MTA4LjEzOWMwLDUuNzE3LDIuMzA0LDExLjE3OSw2LjMzNiwxNS4xNjggICAgbDEyOCwxMjYuNTI4YzQuMTYsNC4wOTYsOS41NzksNi4xNjUsMTQuOTk3LDYuMTY1YzUuNDE5LDAsMTAuODM3LTIuMDY5LDE0Ljk5Ny02LjE2NWwxMjgtMTI2LjUyOCAgICBjNC4wNTMtMy45ODksNi4zMzYtOS40NTEsNi4zMzYtMTUuMTY4di0xMDguMTRDNDA1LjMzNSwyNDcuMzg2LDQwMC4xNTEsMjM5LjU3NywzOTIuMTczLDIzNi4yOTN6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0zOTIuMTczLDEuNjI2Yy03Ljk1Ny0zLjMwNy0xNy4xNTItMS40NzItMjMuMjUzLDQuNjI5TDI1Ni4wMDIsMTE5LjE3M0wxNDMuMDg1LDYuMjU2ICAgIGMtNi4xMDEtNi4xMDEtMTUuMjUzLTcuOTM2LTIzLjI1My00LjYyOWMtNy45NzksMy4yODUtMTMuMTYzLDExLjA5My0xMy4xNjMsMTkuNzEydjEwOC4xMzljMCw1LjcxNywyLjMwNCwxMS4xNzksNi4zMzYsMTUuMTY4ICAgIGwxMjgsMTI2LjUyOGM0LjE2LDQuMDk2LDkuNTc5LDYuMTY1LDE0Ljk5Nyw2LjE2NWM1LjQxOSwwLDEwLjgzNy0yLjA2OSwxNC45OTctNi4xNjVsMTI4LTEyNi41MjggICAgYzQuMDUzLTMuOTg5LDYuMzM2LTkuNDUxLDYuMzM2LTE1LjE2OFYyMS4zMzhDNDA1LjMzNSwxMi43Miw0MDAuMTUxLDQuOTEyLDM5Mi4xNzMsMS42MjZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />
          </a>
          <a href="index.php?dir=asc&field=phone">
            <img style = "width:20px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDEgNTEyLjAwMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwMSA1MTIuMDAxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSIiPjxnPjxnPgoJPGc+CgkJPHBhdGggZD0iTTM5OC45OTgsMTMyLjY3MmwtMTI4LTEyNi41MjhjLTguMzQxLTguMTkyLTIxLjY3NS04LjE5Mi0yOS45OTUsMGwtMTI4LDEyNi41MjhjLTQuMDUzLDMuOTg5LTYuMzM2LDkuNDUxLTYuMzM2LDE1LjE2OCAgICB2MTA4LjEzOWMwLDguNjQsNS4xODQsMTYuNDI3LDEzLjE2MywxOS43MTJjNy45NTcsMy4zMDcsMTcuMTMxLDEuNDcyLDIzLjI1My00LjYyOUwyNTYsMTU4LjE0NGwxMTIuOTE3LDExMi45MTcgICAgYzQuMDc1LDQuMDk2LDkuNTM2LDYuMjUxLDE1LjA4Myw2LjI1MWMyLjc1MiwwLDUuNTI1LTAuNTEyLDguMTcxLTEuNjIxYzcuOTc5LTMuMjg1LDEzLjE2My0xMS4wNzIsMTMuMTYzLTE5LjcxMlYxNDcuODQgICAgQzQwNS4zMzQsMTQyLjEyMyw0MDMuMDMsMTM2LjY2MSwzOTguOTk4LDEzMi42NzJ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0zOTguOTk4LDM2Ny4zNDdsLTEyOC0xMjYuNTI4Yy04LjM0MS04LjIxMy0yMS42NzUtOC4yMTMtMjkuOTk1LDBsLTEyOCwxMjYuNTI4Yy00LjA1MywzLjk4OS02LjMzNiw5LjQ1MS02LjMzNiwxNS4xNjggICAgdjEwOC4xMzljMCw4LjYxOSw1LjE4NCwxNi40MDUsMTMuMTYzLDE5LjcxMmM3Ljk1NywzLjMyOCwxNy4xMzEsMS40NzIsMjMuMjUzLTQuNjI5TDI1NiwzOTIuODE5bDExMi45MTcsMTEyLjkxNyAgICBjNC4wNzUsNC4wNzUsOS41MzYsNi4yNTEsMTUuMDgzLDYuMjUxYzIuNzUyLDAsNS41MjUtMC41MTIsOC4xNzEtMS42MjFjNy45NzktMy4zMDcsMTMuMTYzLTExLjA5MywxMy4xNjMtMTkuNzEyVjM4Mi41MTUgICAgQzQwNS4zMzQsMzc2Ljc5OCw0MDMuMDMsMzcxLjMzNiwzOTguOTk4LDM2Ny4zNDd6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNGRkZGRkYiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" />
          </a>
        </th>
        <th></th>
      </tr>
      <?php foreach ($users as $user) { 
              if ( ($match!=='') && ($match!==$user[$_GET['filtro']]) ) {
                continue;
              }
      ?>
      <tr>
        <td> <?php echo $user['name']; ?> </td>
        <td> <?php echo $user['username']; ?> </td>
        <td> <?php echo $user['email']; ?> </td>
        <td> 
          <?php echo $user['phone']; ?> 
        </td>
        <td width = "1%"><button onclick = "showInfo(this)" id = "btnShowInfo"> Visualizar </button></td>  
       </tr>
      <?php }; ?>
    </table>
    <script>
        function showInfo(btn) {
          console.log(btn.parentNode.parentNode.getElementsByTagName('td')[0].innerText)
          console.log(btn.parentNode.parentNode.getElementsByTagName('td')[1].innerText)
          console.log(btn.parentNode.parentNode.getElementsByTagName('td')[2].innerText)
          console.log(btn.parentNode.parentNode.getElementsByTagName('td')[3].innerText)
        }
    </script>    
  </body>
</html>