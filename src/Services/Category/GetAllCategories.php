<?php

namespace App\Services\Category;

class GetAllCategories
{
    public function __invoke($db): array
    {
        try {
            $sql = "SELECT * FROM categorias";

            $stmt = $db->prepare($sql);

            $stmt->execute();

            $dbCategories = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return [
                'error'  => false,
                'status' => 200,
                'data'   => (array) $dbCategories
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
