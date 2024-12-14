<?php
session_start();
require 'conexao.php';
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar tarefa</h4>

                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['ID'])) {
                            $tarefa_id = mysqli_real_escape_string($conexao, $_GET['ID']);
                            $sql =  "SELECT * FROM lista_de_tarefas WHERE id='$tarefa_id'";
                            $query = mysqli_query($conexao, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $tarefa = mysqli_fetch_array($query);
                        ?>
                                <form action="acoes.php" method="POST">
                                    <input type="hidden" name="tarefa_id" value="<?= $tarefa['ID']; ?>">
                                    <div class="mb-3">
                                        <label>Nome</label>
                                        <input type="text" name="nome" class="form-control" value="<?= $tarefa['nome']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Descrição</label>
                                        <input type="text" name="descricao" class="form-control" value="<?= $tarefa['descricao']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Data Limite</label>
                                        <input type="date" name="data_limite" class="form-control" value="<?= $tarefa['data_limite']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Status</label> <br>
                                        <select id="inlineFormCustomSelectPref" class="form-control" name="status">
                                            <option selected>Pendente</option>
                                            <option >Em andamento</option>
                                            <option >Concluído</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_tarefa" class="btn btn-primary">Salvar Alterações</button>
                                        <a href="index.php" class="btn btn-danger">Cancelar</a>
                                    </div>
                                </form>
                        <?php
                            } else {
                                echo "<h5>Tarefa não encontrada</h5>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>