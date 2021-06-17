<?php

namespace App\Services\Campus;

class GetAllCampus
{
    public function __invoke($db): array
    {
        try {
            $sql = "SELECT * FROM sedes";

            $stmt = $db->prepare($sql);

            $stmt->execute();

            $dbCampus = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return [
                'error'  => false,
                'status' => 200,
                'data'   => (array) $dbCampus
            ];
        } catch (\Exception $exception) {
            return [
                'error'  => true,
                'status' => 500,
                'data' => array('message' => 'Ocurrio un error en el servidor: ' . $exception->getMessage())
            ];
        }
    }
}
