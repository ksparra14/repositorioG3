<?php

require_once "vendor/autoload.php";

class DeleteController {

    /* Método para eliminar datos de la base de datos */
    static public function deleteData($table, $id, $suffix) {
        // Llamar al modelo para eliminar los datos
        $response = DeleteModel::deleteData($table, $id, $suffix);

        // Instanciar la clase y manejar la respuesta
        $controller = new DeleteController();
        return $controller->finRespuesta($response);
    }

    /* Método privado para manejar la respuesta */
    private function finRespuesta($response) {
        // Comprobar si la respuesta es válida y contiene un estado de éxito
        if (is_array($response) && isset($response['status']) && $response['status'] === 'success') {
            $json = array(
                'status' => 200,
                'result' => $response['data']
            );
        } else {
            // Si hay un error, devolver el mensaje de error
            $json = array(
                'status' => 400,
                'result' => isset($response['error']) ? $response['error'] : 'Error en la eliminación'
            );
        }

        // Codificar la respuesta como JSON y enviar el código de estado HTTP adecuado
        echo json_encode($json);
        http_response_code($json['status']);
    }
}
