<html>
    <head><title>Formulario</title></head>
    <?php
    include_once 'restrito/header_restrito.php';
    include_once 'includes/header.php';
    //verifica se o usuário está logado e redireciona se for uma pagina restrita
    if (isset($_SESSION['logado'])):
        header('location: cadastro.php');
    endif;
    ?>
<body>

<?php
//ao apertar o botão "Fazer Login" no formulario ele executa a ação abaixo
//gera uma variavel contendo erros e outra contendo login e senha digitado pelo usuário
if (isset($_POST['btn-login'])):
    $erros = array();
    $login = mysqli_escape_string($connect, $_POST['matricula']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    if(empty($login) || empty($senha)):
        //se login e senha estiverem vazios, retorna a seguinte mensagem na tela
        $erros[] = "<li> O campo Matricula/Senha precisa ser preenchido </li>";

    else:
        //se login e senha estiverem preenchidos, verificar se o login existe no banco de dados
        $sql = "SELECT login FROM usuarios WHERE login = '$login'";
        $resultado = mysqli_query($connect, $sql);
        
        if (mysqli_num_rows($resultado) > 0):
            //se login existe no sistema
            //verificar se o login e senha conferem
            //com os que estão cadastrados banco de dados
            $senha = md5($senha);
            $ativo = true;
            $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha' AND ativo = '$ativo'";
            $resultado = mysqli_query($connect, $sql);

                if(mysqli_num_rows($resultado) == 1):
                    //se login e senha conferirem
                    //criar sessão com os dados obtidos e redirecionar
                    //para a pagina de registro de ponto
                    $dados = mysqli_fetch_array($resultado);
                    $_SESSION['logado'] = true; //informa que existe um login ativo
                    $_SESSION['id_usuario'] = $dados['id']; //captura o id do login ativo
                    $_SESSION['nome'] = $dados['nome']; //captura o nome do login ativo
                    $_SESSION['login'] = $dados['login']; //captura a matricula do login ativo
                    $_SESSION['nivel'] = $dados['nivel']; //captura o nivel do login ativo
                    $_SESSION['bp'] = null; //ativa o controle dos botões de ponto/intervalo/etc...
                    setcookie('bp', "inicio", time()+60);
                    header('location: cadastro.php');

                else:
                    //se login e senha não conferirem, retorna a seguinte mensagem
                    $erros[] = "<li>Matricula/Senha não conferem</li>";
                endif;

        else:
            //se login não conferir, retornar a seguinte mensagem
            $erros[] = "<li> Usuário Inexistente </li>";
        endif;
    endif;
endif;

//formulário para inserir matricula/senha com botão de enviar
?>
<br>
<div class="row">
	<div class="col s12 m6 push-m3">
        <div class="card-panel teal lighten-2">
        <h5 class="light center"> CONTROLE DE PONTO </h5>
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <div class="input-field col s6">
            <input name="matricula" placeholder ="SEU LOGIN" id="matricula" type="text" class="validate">
            <label for="matricula">Matricula</label>
        </div>

        <div class="input-field col s6">
            <input name="senha" placeholder ="SUA SENHA" id="senha" type="password" class="validate">
            <label for="senha">Senha</label>
        </div><br><br><br><br>
        <div class="card-panel teal lighten-2">
        <center><button type="submit" class="btn" name="btn-login"><i class="material-icons">check</i> Fazer Login </button></center>
        </div>

<font name="mensagem" id="mensagem"><?php if (!empty($erros)): foreach($erros as $erro): endforeach; echo "<hr> $erro" ; endif;
// se existir erros a mensagem será exibida aqui
?><br>
</form>
</div>

</body>
</html>
<?php
include_once 'includes/footer.php';
?>
