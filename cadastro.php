<?php
include_once 'includes/header.php';
include_once 'restrito/header_restrito.php';
$login = $_SESSION['login'];
$_SESSION['erroadicionar'] = "noerror";
$mostrarlogin = strtoupper($login);
//verifica se o usuário está logado e redireciona se for uma pagina restrita
?>
<br>
<div class="row">
    
    <div class="col s12 m6 push-m3 ">
        <div class="card-panel teal lighten-2">
            <h5 class="light center"><?php echo "BEM VINDO(A) AO SEU CONTROLE DE PONTO, $mostrarlogin"; ?> </h5>
        </div>
        
        <table class="striped">
            <thead>
                <tr>
                <th>Data</th>
                <th>Entrada</th>
                <th>Intervalo</th>
                <th>Fim do Intervalo</th>
                <th>Fim do Expediente</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM ponto WHERE login = '$login' ";
                $resultado = mysqli_query($connect, $sql);
                while($dados = mysqli_fetch_array($resultado)):
                //consulta banco de daddos e retorna todos os horários registrados para o login selecionado
                ?>

                <?php ?>
                <tr>
                    <?php //Mostra na tela todos os horários encontrados ?>
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
            setcookie('bp', "btnorange", time()+64800);
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
        //ativa ou desativa os botões exclusivos de adiministrador
        if($_SESSION['nivel'] == "adm"):
            $adm_able = "";
        else:
            $adm_able = "disabled";
        endif;
        ?>

        <form action="restrito/novoponto.php" method="POST">
        <div class="card-panel teal lighten-3"><center>
        <button name="btn-ponto"class="<?php echo $btn_color['0']; ?>" <?php echo $btn_able['0']; ?> ><i class="material-icons">check</i> Bater Ponto</button>
        <button name="btn-intervalo"class="<?php echo $btn_color['1']; ?>" <?php echo $btn_able['1']; ?> ><i class="material-icons">expand_more</i> Intervalo</button>
        <button name="btn-fim-intervalo"class="<?php echo $btn_color['2']; ?>" <?php echo $btn_able['2']; ?> ><i class="material-icons">expand_less</i> Fim do Intervalo</button>
        <button name="btn-fim-expediente"class="<?php echo $btn_color['3']; ?>" <?php echo $btn_able['3']; ?>><i class="material-icons">not_interested</i> Fim do Expediente</button>
        <button name="btn-deslogar"class="<?php echo $btn_color['4']; ?>"  ><i class="material-icons">cancel</i> Deslogar</button><br><br><br>
        
        </div></center><center>
        <div class="card-panel teal lighten-4">
        <button name="btn-adicionar"class="btn" <?php echo $adm_able; ?> ><i class="material-icons">add</i> Adicionar Funcionários</button>
        <button name="btn-editar"class="btn" <?php echo $adm_able; ?> ><i class="material-icons">edit</i> Editar Funcionários</button>
        <button name="btn-verpontos"class="btn" <?php echo $adm_able; ?> ><i class="material-icons">access_alarm</i> Ver pontos de hoje</button>
        </div><center>

        </form>

<?php
include_once 'includes/footer.php';
?>
