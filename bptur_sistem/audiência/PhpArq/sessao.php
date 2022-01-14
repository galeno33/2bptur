<?php
    //iniciar sessão
    session_start();

    if(isset($_SESSION["Matricula"]) && $_SESSION["senha"] === true){
        header( 'Location: http://localhost/projetos/bptur_sistem/');
        exit;
    }

?>