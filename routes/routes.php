<?php

$arrayRutas = explode("/", $_SERVER['REQUEST_URI']);

// echo "<pre>"; print_r($arrayRutas); echo "<pre>";

if(isset($_GET["pagina"]) && is_numeric($_GET["pagina"])){

    $cursos = new ControladorCursos();
    $cursos->index($_GET["pagina"]);
    
} else {

    if (count(array_filter($arrayRutas)) == 1){

        $json = array(
            "detalle"=>"no encontrado"
        );
        echo json_encode($json, true);
        return;

    } else {
 
        if (count(array_filter($arrayRutas)) == 2){
            if (array_filter($arrayRutas)[2] == "cursos"){

                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){

                    $cursos = new ControladorCursos();
                    $cursos->index(null);
                
                } else if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){

                    // Capturar datos
                    $datos = array(
                        "titulo" => $_POST["titulo"],
                        "descripcion" => $_POST["descripcion"],
                        "instructor" => $_POST["instructor"],
                        "imagen" => $_POST["imagen"],
                        "precio" => $_POST["precio"]
                    );

                    $cursos = new ControladorCursos();
                    $cursos->create($datos);

                } 

            }

            if (array_filter($arrayRutas)[2] == "clientes"){

                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){

                    $clientes = new ControladorClientes();
                    $clientes->index();
                
                } else if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){

                    $datos = array("nombre" => $_POST["nombre"],
                    "apellido" => $_POST["apellido"],
                    "email" => $_POST["email"]);

                    $clientes = new ControladorClientes();
                    $clientes->create($datos);

                } 

            }
        } else {
            if (array_filter($arrayRutas)[2] == "cursos" && is_numeric(array_filter($arrayRutas)[3])){

                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){

                    $cursos = new ControladorCursos();
                    $cursos->show(array_filter($arrayRutas)[3]);
                
                } 
            
                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "PUT"){

                    // Capturar datos
                    $datos = array();
                    parse_str(file_get_contents('php://input'), $datos);

                    $editarCursos = new ControladorCursos();
                    $editarCursos->update(array_filter($arrayRutas)[3], $datos);
                
                } 

                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "DELETE"){

                    $borrarCursos = new ControladorCursos();
                    $borrarCursos->delete(array_filter($arrayRutas)[3]);
                
                } 

            }
        } 

    }

}

?>