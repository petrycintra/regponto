    <?php 
    //<link rel="stylesheet" href="index.css">
    //inicia a sessão e conecta ao banco de dados
    session_start();
    require_once 'db_connect.php';
    //se não houver usuário logado retornar à pagina de login, exeto se já estiver na pagina inicial
    if (!isset($_SESSION['logado']) && $_SERVER['PHP_SELF'] !== "/index.php"):
        header('location: index.php');
    endif;
    ?>