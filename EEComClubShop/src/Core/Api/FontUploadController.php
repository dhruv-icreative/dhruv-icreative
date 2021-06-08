<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Api;

use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FontUploadController
 * @package EECom\ClubShop\Core\Api
 *
 * @RouteScope(Scopes={"api"})
 */
class FontUploadController extends AbstractController
{

    /**
     * @Route("/api/v{version}/eecom/upload/font", name="api.action.eecom.upload.font", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function fileUpload(Request $request): JsonResponse
    {
        $file = $request->files->get('file');

        if(!empty($file)) {

            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();

            $fileAddUrl = $this->get('kernel')->getProjectDir().'/public/fonts/';

            $file->move($fileAddUrl, $fileName);

            return new JsonResponse(['status' => 'success', 'fileName' => $fileName, 'fileExtension' => $fileExtension]);
        }
        else {
            return new JsonResponse(['status' => 'failed']);
        }
    }
}
