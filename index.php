<?php

    require_once "controllers/routes.controllers.php";
    require_once "controllers/cursos.controller.php";
    require_once "controllers/clientes.controller.php";
    require_once "models/clientes.modelo.php";
    require_once "models/cursos.modelo.php";

    $rutas = new ControladorRutas();
    $rutas->inicio();

?>