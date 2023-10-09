<?php 
    include_once 'header_restrito.php';
    include_once '../includes/header.php';
    if (isset($_POST['btn-confirmarreativar'])):
        $id = mysqli_escape_string($connect, $_GET['id']);
        $sql = "ALTER TABLE usuarios DROP COLUMN WHERE id = '$id';";
        if(mysqli_query($connect, $sql)):
            header('location: funcionarioinativo.php?sucesso');
        else:
            header('location: funcionarioinativo.php?error');
        endif;
    endif;
        //Ao clicar no botão "Concluir Edição de Funcionário" registrar as auterações de nome/login/senha/adm no banco de dados

    if (isset($_POST['btn-cancel'])):
        header('location: editarfuncionario.php');
        //se apertar em "cancelar" retorna à pagina de editar funcionários
    endif;

    if (isset($_POST['btn-verativos'])):
        header('location: editarfuncionario.php');
        //se apertar em "cancelar" retorna à pagina de horários
    endif;

    if (isset($_POST['btn-editarfuncionario'])):
        $id = mysqli_escape_string($connect, $_POST['id']);
        $nome = mysqli_escape_string($connect, $_POST['nome']);
        $login = mysqli_escape_string($connect, $_POST['matricula']);
        $senha = mysqli_escape_string($connect, $_POST['senha']);
        $nivel = mysqli_escape_string($connect, $_SESSION['novonivel']);
        $senha = md5($senha);
        $ativo = true;
        if($senha == ""):
            $sql = "UPDATE usuarios SET ativo = '$ativo' WHERE id= '$id' ";
            if(mysqli_query($connect, $sql)):
                header('location: funcionarioinativo.php?sucesso');
            else:
                header('location: funcionarioinativo.php?error');
            endif;
        else:
            $sql = "UPDATE usuarios SET ativo = '$ativo' WHERE id= '$id' ";
            if(mysqli_query($connect, $sql)):
                header('location: funcionarioinativo.php?sucesso');
            else:
                header('location: funcionarioinativo.php?error');
            endif;
        endif;
        //Ao clicar no botão "Efetivar a reativação desse funcionário" registrar as auterações de nome/login/senha/adm no banco de dados
    endif;

    if (isset($_POST['btn-inativar'])):
        $id = mysqli_escape_string($connect, $_POST['id']);
        $nome = mysqli_escape_string($connect, $_POST['nome']);
        $login = mysqli_escape_string($connect, $_POST['matricula']);
        $senha = mysqli_escape_string($connect, $_POST['senha']);
        $nivel = mysqli_escape_string($connect, $_SESSION['novonivel']);
        $senha = md5($senha);
        $ativo = false;
        if($senha == ""):
            $sql = "UPDATE usuarios SET ativo = '0' WHERE id= '$id' ";
            if(mysqli_query($connect, $sql)):
                header('location: funcionarioinativo.php?sucesso');
            else:
                header('location: funcionarioinativo.php?error');
            endif;
        else:
            $sql = "UPDATE usuarios SET ativo = '0' WHERE id= '$id' ";
            if(mysqli_query($connect, $sql)):
                header('location: funcionarioinativo.php?sucesso');
            else:
                header('location: funcionarioinativo.php?error');
            endif;
        endif;
        //Ao clicar no botão "Efetivar a reativação desse funcionário" registrar as auterações de nome/login/senha/adm no banco de dados
    endif;