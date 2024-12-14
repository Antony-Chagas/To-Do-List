<?php
require 'conexao.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar tarefa
                            <a href="index.php" class="btn btn-secondary float-end">Voltar</a>
                        </h4>
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
                                <div class="mb-3">
                                    <label>ID</label>
                                    <p class="form-control"> <?= $tarefa['ID']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Nome</label>
                                    <p class="form-control"> <?= $tarefa['nome']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Descrição</label>
                                    <p class="form-control"><?= $tarefa['descricao']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Data Limite</label>
                                    <p class="form-control"><?= date('d/m/Y', strtotime($tarefa['data_limite'])); ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <p class="form-control"><?= $tarefa['status']; ?></p>
                                </div>
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