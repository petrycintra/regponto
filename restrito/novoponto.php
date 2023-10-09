<html>
    <head><title>Formulario</title></head>
    <?php
    include_once 'header_restrito.php';
    include_once '../includes/header.php';
    $login = $_SESSION['login'];
    date_default_timezone_set('America/Sao_Paulo');
    $datahora =  date(" H:i");
    $dataponto =  date("d/m/Y");
    $identificador = null;

    //verifica se o usuário está logado e redireciona se for uma pagina restrita

    if (isset($_POST['btn-ponto'])):
        $sql = "INSERT INTO ponto (login, dia, entrada) VALUES ('$login', '$dataponto', '$datahora')";
        $_SESSION['horainicial'] = $datahora;
        //Ao clicar no botão "Bater Ponto" registrar o horário no banco de dados "Login/Entrada"

        if(mysqli_query($connect, $sql)):
            $_SESSION['bp'] = "btn orange";
            header('location: ../cadastro.php?sucesso');
        else:
            header('location: ../cadastro.php?error');
        endif;
    endif;
    if (isset($_POST['btn-intervalo'])):
        $_SESSION['bp'] = "btn";
        $horaentrada = $_SESSION['horainicial'];
        $sql = "UPDATE ponto SET intervalo = '$datahora' WHERE login= '$login' AND dia = '$dataponto' AND entrada = '$horaentrada' ";
        //Ao clicar no botão "Intervalo" registrar o horário no banco de dados "Login/Intervalo"

        if(mysqli_query($connect, $sql)):
            header('location: ../cadastro.php?sucesso');
        else:
            header('location: ../cadastro.php?error');
        endif;
    endif;
    if (isset($_POST['btn-fim-intervalo'])):
        $_SESSION['bp'] = "btn black";
        $horaentrada = $_SESSION['horainicial'];
        $sql = "UPDATE ponto SET fim_intervalo = '$datahora' WHERE login= '$login' AND dia = '$dataponto' AND entrada = '$horaentrada' ";
        //Ao clicar no botão "Fim do Intervalo" registrar o horário no banco de dados "Login/Fim_Intervalo"

        if(mysqli_query($connect, $sql)):
            header('location: ../cadastro.php?sucesso');
        else:
            header('location: ../cadastro.php?error');
        endif;
    endif;
    if (isset($_POST['btn-fim-expediente'])):
        $_SESSION['bp'] = "btn red";
        $horaentrada = $_SESSION['horainicial'];
        $sql = "UPDATE ponto SET fim_expediente = '$datahora' WHERE login= '$login' AND dia = '$dataponto' AND entrada = '$horaentrada' ";
        //Ao clicar no botão "Fim do Expediente" registrar o horário no banco de dados "Login/Fim_Expediente"

        if(mysqli_query($connect, $sql)):
            header('location: ../cadastro.php?sucesso');
        else:
            header('location: ../cadastro.php?error');
        endif;
    endif;
    if (isset($_POST['btn-deslogar'])):
        $_SESSION['bp'] = null;
        session_unset();
        session_destroy();
        header('location: ../index.php');
        //Ao clicar no botão "Deslogar" encerrar a sessão atual e redirecionar para pagina inicial
    endif;


    //APARTIR DAQUI SÃO AÇÕES EXCLUSIVAS DE ADMINISTRADOR

    if (isset($_POST['btn-adicionar'])):
        header('location: novofuncionario.php');
        //se clicar em "Adicionar Funcionário" abrirá essa pagina
    endif;
    if (isset($_POST['btn-editar'])):
        header('location: editarfuncionario.php');
        //se clicar em "Editar Funcionário" abrirá essa pagina
    endif;

    if (isset($_POST['btn-novofuncionario'])):
        //Limpeza
        function clear($input){
        global $connect;
        $var = mysqli_escape_string($connect, $input);
        $var = htmlspecialchars($var);
        return $var;
        }
        $nome = clear($_POST['nome']);
        $login = clear($_POST['matricula']);
        $senha = clear($_POST['senha']);
        $nivel = clear($_POST['nivel']);
        //Ao clicar no botão "Cadastrar Funcionário" registrar o nome/login/senha/adm no banco de dados
        if($nome == null || $login == null || $senha == null || $nivel == null):
            $_SESSION['erroadicionar'] = "error";
            header('location: novofuncionario.php?error');
        else:
            if($nivel == "adm" || $nivel == "fun"):
                $senha = md5($senha);
                $sql = "INSERT INTO usuarios (nome, login, senha, nivel, ativo) VALUES ('$nome', '$login', '$senha', '$nivel', '1');";
                if(mysqli_query($connect, $sql)):
                    header('location: novofuncionario.php?sucesso');
                    $_SESSION['erroadicionar'] = "noerror";
                else:
                    header('location: novofuncionario.php?error');
                endif;
            else:
                header('location: novofuncionario.php?error');
                $_SESSION['erroadicionar'] = "admorfun";
            endif;
        endif;
    endif;

    if (isset($_POST['btn-cancel'])):
        header('location: ../cadastro.php');
        //se apertar em "cancelar" retorna à pagina de horários
    endif;

    if (isset($_POST['btn-verinativos'])):
        header('location: funcionarioinativo.php');
        //se apertar em "cancelar" retorna à pagina de horários
    endif;

    if (isset($_POST['btn-verpontos'])):
        header('location: pontodosfuncionarios.php');
        //se apertar em "cancelar" retorna à pagina de horários
    endif;




    

//btn-ponto = Botão para baer o ponto
//btn-intervalo = botão para bater o intervalo
//btn-fim-intervalo = botão para bater o fim do intervalo
//btn-fim-expediente = botão para bater o fim do expediente
//btn-deslogar = botão para deslogar

//btn-adicionar = botão para ir até a pagina de adição de funcionários
//btn-novofuncionario = botão para inserir novo funcionário no banco de dados
//btn-cancel = botão para cancelar (funcionamento exclusivo dentro de paginas restritas)
//btn-editar = Botão para Editar algum funcionário
//btn deletar = Botão pra deletar algum funcionário


    ?>
