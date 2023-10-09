<?php
include_once '../includes/header.php';
include_once 'header_restrito.php';
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
//verifica se o usuário está logado e redireciona se for uma pagina restrita
if(isset($_GET['id'])):
    $id = mysqli_escape_string($connect, $_GET['id']);
    $identificacao = substr($id, 2, -2);
    $sql = "SELECT * FROM usuarios WHERE id = $identificacao";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
endif;

?>
<br>
<div class="row">
	<div class="col s12 m6 push-m3">
        <div class="card-panel teal lighten-2">
            <h5 class="light center"><?php echo "BEM VINDO(A) A PAGINA PARA EDITAR FUNCIONÁRIO INATIVO, $mostrarlogin "; ?> </h5>
        </div>

    <form action="editarfuncionarioinativo.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $identificacao; ?>" id="id" type="text" class="validate">
		
		<div class="input-field col s6">
            <input name="nome" value="<?php echo $dados['nome']; ?>" id="nome" type="text" class="validate">
            <label for="nome">Nome</label>
        </div>

        <div class="input-field col s6">
            <input name="matricula" value="<?php echo $dados['login']; ?>" id="matricula" type="text" class="validate">
            <label for="matricula">Matricula</label>
        </div>

        <div class="input-field col s6">
            <input name="senha" id="senha" value="" type="password" class="validate">
            <label for="senha">Senha</label>
        </div>

        <div class="input-field col s6">
            <input name="nivel" value="<?php echo $dados['nivel']; ?>" id="nivel" type="text" class="validate">
            <label for="nivel">Nivel (Administrador ou Funcionário?)</label>
        </div><br><br><br><br><br><br><br><br><br><br>

        <div class="card-panel teal lighten-3 center">
        <button type="submit" class="btn" name="btn-editarfuncionario"><i class="material-icons">add</i> EFETIVAR A REATIVAÇÃO DESSE FUNCIONARIO </button>
        <button type="submit" class="btn red" name="btn-cancel"><i class="material-icons">cancel</i> Cancelar </button>
        </div>
</form>

<font name="mensagem" id="mensagem"><?php if (!empty($erros)): foreach($erros as $erro): endforeach; echo "<hr> $erro" ; endif;
// se existir erros a mensagem será exibida aqui
?><br>
<?php

include_once '../includes/footer.php';
?>