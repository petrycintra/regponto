<?php
include_once '../includes/header.php';
include_once 'header_restrito.php';
$login = $_SESSION['login'];
$_SESSION['erroadicionar'] = "noerror";
date_default_timezone_set('America/Sao_Paulo');
$data = date("d/m/Y");
$mostrarlogin = strtoupper($login);
//verifica se o usuário está logado e redireciona se for uma pagina restrita
?>
<br>
<div class="row">
    
    <div class="col s12 m6 push-m3 ">
        <div class="card-panel teal lighten-2">
            <h5 class="light center"><?php echo "MOSTRANDO TODOS OS PONTOS BATIDOS HOJE, $mostrarlogin"; ?> </h5>
        </div>
        <table class="striped">
            <thead>
                <tr>
                <th>Matricula/Login</th>
                <th>Data</th>
                <th>Entrada</th>
                <th>Intervalo</th>
                <th>Fim do Intervalo</th>
                <th>Fim do Expediente</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM ponto WHERE dia = '$data' ";
                //$sql = "SELECT * FROM ponto WHERE data = '$data' ";
                $resultado = mysqli_query($connect, $sql);
                while($dados = mysqli_fetch_array($resultado)):
                //consulta banco de daddos e retorna todos os horários registrados para a data de hoje
                ?>

                <?php ?>
                <tr>
                    <?php //Mostra na tela todos os horários encontrados ?>
                    <td><?php echo $dados['login']; ?></td>
                    <td><?php echo $dados['dia']; ?></td>
                    <td><?php echo $dados['entrada']; ?></td>
                    <td><?php echo $dados['intervalo']; ?></td>
                    <td><?php echo $dados['fim_intervalo']; ?></td>
                    <td><?php echo $dados['fim_expediente']; ?></td>
                </tr>
                <?php
                endwhile; 
                ?>
            </tbody>
        </table>
        <br>
        <?php
        $colors = ["btn green", "btn orange", "btn", "btn black", "btn red"];
        $disable = "btn grey";
        if (!$_SESSION['bp'] == $colors['0']):
            //Ativa botão "Bater ponto" e desativa os demais.
            $btn_color = [$colors['0'], $disable, $disable, $disable, $disable];
            $btn_able = ["", "disabled", "disabled", "disabled", "disabled" ];
        else:
            if ($_SESSION['bp'] == $colors['1']):
                //Ativa botão "Intervalo" e desativa os demais.
                $btn_color = [$disable, $colors['1'], $disable, $disable, $disable];
                $btn_able = ["disabled", "", "disabled", "disabled", "disabled" ];
            else:
                if ($_SESSION['bp'] == $colors['2']):
                    //Ativa botão "Fim do Intervalo" e desativa os demais.
                    $btn_color = [$disable, $disable, $colors['2'], $disable, $disable];
                    $btn_able = ["disabled", "disabled", "", "disabled", "disabled" ];
                else:
                    if ($_SESSION['bp'] == $colors['3']):
                        //Ativa botão "Fim do Expediente" e desativa os demais.
                        $btn_color = [$disable, $disable, $disable, $colors['3'], $disable];
                        $btn_able = ["disabled", "disabled", "disabled", "", "disabled" ];
                    else:
                        if ($_SESSION['bp'] == $colors['4']):
                            //Ativa botão "Deslogar" e desativa os demais.
                            $btn_color = [$disable, $disable, $disable, $disable,  $colors['4']];
                            $btn_able = ["disabled", "disabled", "disabled", "disabled", "" ];
                        endif;
                    endif;
                endif;
            endif;
        endif;
        if($_SESSION['nivel'] == "adm"):
            $adm_able = "";
        else:
            $adm_able = "disabled";
        endif;
        ?>
        <form action="novoponto.php" method="POST">
        <div class="card-panel teal lighten-4 center">
        <button name="btn-cancel"class="btn red" <?php echo $adm_able; ?> ><i class="material-icons">cancel</i> Cancelar</button>
        </div><center>

        </form>
<?php
include_once '../includes/footer.php';
?>