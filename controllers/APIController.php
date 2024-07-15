<?php 

namespace Controllers; // API.- 2

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController {

    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    // Fetch (Ajax).- 2
    public static function guardar() {
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // Almacena las citas y el servicio
        $idServicios = explode(",", $_POST['servicios']);

        // Almacena los id de serviciios
        foreach($idServicios as $idServicio) {
            $args = [
                'citas_id' => $id,
                'servicios_id' => $idServicio
            ];

            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // debuguear($_SERVER);

            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}