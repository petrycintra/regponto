<?php
include_once '../includes/header.php';
include_once 'header_restrito.php';
//verifica se o usuário está logado e redireciona se for uma pagina restrita
$login = $_SESSION['login'];
$mostrarlogin = strtoupper($login);
if ($_SESSION['nivel'] !== "adm"):
    header('location: ../index.php');
endif;
if(isset($_POST['checkadm'])):
    $_SESSION['novonivel'] = "adm";
else:
    $_SESSION['novonivel'] = "fun";
endif;

?>
<br>
<div class="row">
	<div class="col s12 m6 push-m3">
        <div class="card-panel teal lighten-2">
            <h5 class="light center"><?php echo "BEM VINDO(A) A PAGINA PARA ADICIONAR FUNCIONÁRIO, $mostrarlogin "; ?> </h5>
        </div>

        <form action="novoponto.php" method="POST">

        <div class="input-field col s6">
            <input name="nome" placeholder ="NOME COMPLETO" id="nome" type="text" class="validate">
            <label for="nome">Nome</label>
        </div>

        <div class="input-field col s6">
            <input name="matricula" placeholder ="SEU LOGIN" id="matricula" type="text" class="validate">
            <label for="matricula">Matricula</label>
        </div>

        <div class="input-field col s6">
            <input name="senha" placeholder ="SUA SENHA" id="senha" type="password" class="validate">
            <label for="senha">Senha</label>
        </div>

        <div class="input-field col s6">
            <input name="nivel" placeholder ="adm ou fun?" id="nivel" type="text" class="validate">
            <label for="nivel">Nivel (Administrador ou Funcionário?)</label>
        </div><br><br><br><br><br><br><br><br>
            
            <div class="card-panel teal lighten-3 center">
            <button type="submit" class="btn" name="btn-novofuncionario"><i class="material-icons">add</i> Cadastrar Funcionário </button>
            <button type="submit" class="btn red" name="btn-cancel"><i class="material-icons">cancel</i> Cancelar </button>
            <?php $vazio = $_SESSION['erroadicionar']; if($vazio == "error"): echo "<br><br><li>Todos os campos são obrigatorios"; endif;
                if($vazio == "admorfun"): echo "<br><br><li>\"Nivel deve ser obrigatoriamente \"adm\" ou \"fun\" (sem as aspas)."; endif; ?>
            </div>
        </form>
    </div>
<div>
<font name="mensagem" id="mensagem"><?php if (!empty($erros)): foreach($erros as $erro): endforeach; echo "<hr> $erro" ; endif;
// se existir erros a mensagem será exibida aqui
?><br>
<?php
include_once '../includes/footer.php';
?>