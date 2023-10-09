<?php
include_once '../includes/header.php';
include_once 'header_restrito.php';
$login = $_SESSION['login'];
$mostrarlogin = strtoupper($login);
$ativo = true;
if ($_SESSION['nivel'] !== "adm"):
    header('location: ../index.php');
endif;
//verifica se o usuário está logado e redireciona se for uma pagina restrita
?>
<br>

<div class="row">
    <div class="col s12 m6 push-m3">
        <div class="card-panel teal lighten-2">
            <h5 class="light center"><?php echo "BEM VINDO(A) A PAGINA PARA EDITAR FUNCIONÁRIO, $mostrarlogin ";  ?> </h5>
        </div>
        <table class="striped">
            <thead>
                <tr>
                <th>Nome</th>
                <th>Matricula/Login</th>
                <th>nível</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM usuarios WHERE ativo = '$ativo'";
                $resultado = mysqli_query($connect, $sql);
                while($dados = mysqli_fetch_array($resultado)):
                //consulta banco de daddos e retorna todos os horários registrados para o login selecionado
                ?>

                <?php ?>
                <tr>
                    <?php //Mostra na tela todos os horários encontrados ?>
                    <td><?php echo $dados['nome']; ?></td>
                    <td><?php echo $dados['login']; ?></td>
                    <td><?php echo $dados['nivel']; ?></td>
                    <td><a href=editarfuncionario2.php?id="<?php echo $dados['id']; ?>"   name="btn-editar" class="btn orange" ><i class="material-icons">edit</i> </a></td>
                    <td><a href=inativarfuncionario.php?id="<?php echo $dados['id']; ?>" name="btn-deletar" class="btn red"><i class="material-icons">delete</i> </a></td>
                </tr>
                <?php
                endwhile; 
                ?>
            </tbody>
        </table>
        <br>
        <div class="card-panel teal lighten-3 center">
        <form action="novoponto.php" method="POST">
        <button type="submit" class="btn orange" name="btn-verinativos"><i class="material-icons">chevron_left</i> Ver funcionario inativos </button>
        <button type="submit" class="btn red" name="btn-cancel"><i class="material-icons">cancel</i> Cancelar </button>
        <?php $vazio = $_SESSION['erroadicionar']; if($vazio == "error"): echo "<br><br><li>Todos os campos são obrigatorios"; endif;
                if($vazio == "admorfun"): echo "<br><br><li>\"Nivel deve ser obrigatoriamente \"adm\" ou \"fun\" (sem as aspas)."; endif; ?>
        </div>
</form>
<?php
include_once '../includes/footer.php';
?>
