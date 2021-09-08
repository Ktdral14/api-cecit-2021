<?php

namespace App\Services\Assessor;

use App\App\Constants;
use App\App\Database;
use App\Models\AssessorModel;

class UploadImage
{
    private AssessorModel $assessor;

    public function __construct(array $params)
    {
        $this->assessor = new AssessorModel(array(
            'curp' => $params['curp'], 
            'image_ine' => $params['image_ine']
        ));
    }

    public function __invoke(): array
    {
        $db = new Database();
        $db = $db->connect();

        try {
            if ($this->assessor->ineImage != "") {
                $assessorINEImageDirectory = DIRECTORY_SEPARATOR . 'assessors-ine';
                $assessorINEImageExtension = pathinfo($this->assessor->ineImage->getClientFilename(), PATHINFO_EXTENSION);
                $assessorINEImageBasename =
                    'asesor-'
                    . $this->assessor->curp;
                $assessorINEImageFilename = sprintf('%s.%0.8s', $assessorINEImageBasename, $assessorINEImageExtension);
                $this->assessor->ineImage->moveTo(Constants::FILE_UPLOAD_BASE_DIR . $assessorINEImageDirectory . DIRECTORY_SEPARATOR . $assessorINEImageFilename);
                $this->assessor->ineImageUrl = $assessorINEImageDirectory . DIRECTORY_SEPARATOR . $assessorINEImageFilename;
            } else {
                $this->assessor->ineImageUrl = "";
            }

            $sql =
                "CALL SP_update_asesor_image (
                    @result,
                    :curp_in,
                    :img_ine_in
                )";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':curp_in', $this->assessor->curp, \PDO::PARAM_STR);
            $stmt->bindParam(':img_ine_in', $this->assessor->ineImageUrl, \PDO::PARAM_STR);

            $stmt->execute();

            return [
                'error'  => false,
                'status' => 200,
                'data' => array('message' => 'Se ha subido la imagen correctamente')
            ];
        } catch (\Exception $exception) {
            return [
                'error'  => true,
                'status' => 500,
                'data' => array('message' => 'Ocurrió un error en el servidor: ' . $exception->getMessage())
            ];
        }
    }
}
