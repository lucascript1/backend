<?php
session_start();
if (empty($_SESSION['email'])) {
  header("Location: index.php");
  exit(); // Adicionando exit após header para garantir que o script não continue
}
?>
<!doctype html>
<html lang="pt-br">

<head>
  <title>Clientes DB</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.3.2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/7511ed294b.js" crossorigin="anonymous"></script>

</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg fixed-top">
      <a class="navbar-brand" href="#">main</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="menu.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <main class="container mt-5 pt-4">
    <h1 class="text-center">Cadastro de Cliente</h1>
    <form id="frmBuscarCliente">
      <div class="input-group mb-3">
        <input type="text" class="form-control" id="expressaoBusca" placeholder="Nome a ser buscado...">
        <button class="btn btn-secondary" id="btnBusca" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
    </form>

    <!-- Tabela de clientes -->
    <div id="content"></div>

    <div class="text-center mb-3">
      <button id="btnIncluirCliente" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalIncluirCliente">Incluir Novo Cliente</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalIncluirCliente" tabindex="-1" aria-labelledby="modalIncluirClienteLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalIncluirClienteLabel">Adicionar Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="frmIncluirCliente">
              <div class="form-floating mb-3">
                <input type="text" name="nome" id="inNome" class="form-control" placeholder="Nome Sobrenome">
                <label for="inNome">Nome</label>
              </div>

              <div class="form-floating mb-3">
                <input type="email" name="email" id="inEmail" class="form-control" placeholder="name@example.com">
                <label for="inEmail">Email</label>
              </div>

              <div class="mb-3">
                <label for="id_uf" class="form-label">UF</label>
                <select name="id_uf" id="id_uf" class="form-select"></select>
              </div>

              <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-dark">Apagar</button>
                <button type="submit" id="btnIncluir" class="btn btn-secondary">Submeter</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Alterar Informações</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="frmAlterarCliente">
              <div class="mb-3">
                <label for="uCodigo" class="form-label">Código</label>
                <input type="text" name="codigo" class="form-control" id="uCodigo" readonly>
              </div>
              <div class="mb-3">
                <label for="uNome" class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" id="uNome">
              </div>
              <div class="mb-3">
                <label for="uEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="uEmail">
              </div>
              <div class="mb-3">
                <label for="uUf" class="form-label">UF</label>
                <select name="uf" id="uUf" class="form-select">
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fechar</button>
            <button type="button" id="btnAtualizar" class="btn btn-success">Salvar Alterações</button>
          </div>
        </div>
      </div>
    </div>

  </main>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="js/busca-clientes.js"></script>
</body>

</html>