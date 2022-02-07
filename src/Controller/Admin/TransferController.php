<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


final class TransferController extends BaseController
{
    /**
     * @Route("/admin/transfer", name="admin_transfer")
     */

    public function index(): Response
    {
        return $this->render('admin/transfer/index.html.twig', [
            'site' => $this->site(),
        ]);
    }
}