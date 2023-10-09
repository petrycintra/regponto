<?php 
    include_once 'header_restrito.php';
    include_once '../includes/header.php';
if (isset($_POST['btn-editarfuncionario'])):
        //Limpeza
        function clear($input){
            global $connect;
            $var = mysqli_escape_string($connect, $input);
            $var = htmlspecialchars($var);
            return $var;
        }
        $id = clear($_POST['id']);
        $nome = clear($_POST['nome']);
        $login = clear($_POST['matricula']);
        $senha = clear($_POST['senha']);
        $nivel = clear($_POST['nivel']);
        $ativo = true;
        if($nivel == "adm" || $nivel == "fun"):
            if(empty($senha)):
                $sql = "UPDATE usuarios SET nome = '$nome', login = '$login', nivel= '$nivel', ativo = '$ativo' WHERE id= '$id' ";
                if(mysqli_query($connect, $sql)):
                    $_SESSION['erroadicionar'] = "noerror";
                    header('location: editarfuncionario.php?sucesso');
                else:
                    header('location: editarfuncionario.php?error');
                endif;
            else:
                $senha = md5($senha);
                $sql = "UPDATE usuarios SET nome = '$nome', login = '$login', senha = '$senha', nivel= '$nivel', ativo = '$ativo' WHERE id= '$id' ";
                if(mysqli_query($connect, $sql)):
                    $_SESSION['erroadicionar'] = "noerror";
                    echo $senha;
                    //header('location: editarfuncionario.php?sucesso');
                else:
                    echo $senha;
                    //header('location: editarfuncionario.php?error');
                endif;
            endif;
        else:
            $_SESSION['erroadicionar'] = "admorfun";
            header('location: editarfuncionario.php?error');
        endif;
        //Ao clicar no botão "Concluir Edição de Funcionário" registrar as auterações de nome/login/senha/adm no banco de dados
endif;

    if (isset($_POST['btn-cancel'])):
        header('location: editarfuncionario.php');
        //se apertar em "cancelar" retorna à pagina de editar funcionários
    endif;

    if (isset($_POST['btn-verativos'])):
        header('location: editarfuncionario.php');
        //se apertar em "cancelar" retorna à pagina de horários
    endif;
    