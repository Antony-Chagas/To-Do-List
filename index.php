<?php
session_start();
require 'conexao.php';
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-4">
        <?php include('mensagem.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Lista de tarefas
                            <a href="tarefa-create.php" class="btn btn-primary float-end"> Adicionar tarefa</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="box-search" style="display: flex;">
                            <input type="search" class="form-control " placeholder="Pesquisar" id="pesquisar">
                            <button onclick="pesquisarDados()" class="btn btn-secondary btn-sm">
                                Pesquisar
                            </button>
                        </div>
                        <table class="table table-borderred  table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Data Limite</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($_GET['pesquisar'])) {
                                    $dados = $_GET['pesquisar'];
                                    $sql = "SELECT * FROM lista_de_tarefas WHERE ID LIKE '%$dados%' or status LIKE '%$dados%'";
                                } else {
                                    $sql = 'SELECT * FROM lista_de_tarefas';
                                }
                                $tarefas = mysqli_query($conexao, $sql);
                                if (mysqli_num_rows($tarefas) > 0) {
                                    foreach ($tarefas as $tarefa) {
                                ?>
                                        <tr>
                                            <td><?= $tarefa['ID']; ?></td>
                                            <td><?= $tarefa['nome']; ?></td>
                                            <td><?= $tarefa['descricao']; ?></td>
                                            <td><?= date('d/m/Y', strtotime($tarefa['data_limite'])); ?></td>
                                            <td><?= $tarefa['status']; ?></td>
                                            <td>
                                                <a href="tarefa_view.php?ID=<?= $tarefa['ID'] ?>" class="btn btn-info btn-sm">Visualizar</a>
                                                <a href="tarefa_edit.php?ID=<?= $tarefa['ID'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="acoes.php" method="POST" class="d-inline">
                                                    <button onclick="return confirm('Tem certeza que deseja exclir essa tarefa?')" type="submit" name="delete_tarefa" value="<?= $tarefa['ID'] ?>" class="btn btn-danger btn-sm">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<h5> Nenhum usuário encontrado</h5>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script>
    var pesquisar = document.getElementById('pesquisar');

    function pesquisarDados() {
        window.location = 'index.php?pesquisar=' + pesquisar.value;
    }
</script>

</html>