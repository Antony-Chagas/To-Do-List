<?php
session_start();
require 'conexao.php';

if (isset($_POST['create_tarefa'])) {
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $descricao = mysqli_real_escape_string($conexao, trim($_POST['descricao']));
    $data_limite = mysqli_real_escape_string($conexao, trim($_POST['data_limite']));

    $sql = "INSERT INTO lista_de_tarefas (nome, descricao, data_limite) VALUES ('$nome', '$descricao', '$data_limite')";

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem_sucesso'] = 'Tarefa criada com sucesso.';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem_erro'] = 'Erro ao criar Tarefa!';
        header('Location: index.php');
        exit;
    }
}

if (isset($_POST['update_tarefa'])) {
    $tarefa_id = mysqli_real_escape_string($conexao, $_POST['tarefa_id']);

    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $descricao = mysqli_real_escape_string($conexao, trim($_POST['descricao']));
    $data_limite = mysqli_real_escape_string($conexao, trim($_POST['data_limite']));
    $status = mysqli_real_escape_string($conexao, trim($_POST['status']));

    $sql = "UPDATE lista_de_tarefas SET nome = '$nome', descricao = '$descricao ', data_limite = '$data_limite', status = '$status' ";

    $sql .= "WHERE ID  = '$tarefa_id'";
    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem_sucesso'] = 'Tarefa atualizada com sucesso.';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem_erro'] = 'Erro ao atualzar Tarefa!';
        header('Location: index.php');
        exit;
    }
}

if (isset($_POST['delete_tarefa'])) {
    $tarefa_id = mysqli_real_escape_string($conexao, $_POST['delete_tarefa']);
    
    $sql = "DELETE FROM lista_de_tarefas WHERE id = '$tarefa_id'";

    mysqli_query($conexao, $sql);

    if(mysqli_affected_rows($conexao) > 0){
        $_SESSION['mensagem'] = 'Tarefa excluida com sucesso';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem_erro'] = 'Erro ao excluir tarefa';
        header('Location: index.php');
        exit;
    }
}
