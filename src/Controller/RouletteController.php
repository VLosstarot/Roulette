<?php

namespace App\Controller;

use App\Repository\StatisticRepository;
use App\Service\RouletteServiceInterface;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class RouletteController extends AbstractController
{
    /**
     * @Route("/statistic", methods={"GET"}, name="statistic")
     * @param StatisticRepository $repository
     * @return JsonResponse
     * @throws DBALException
     */
    public function statistic(StatisticRepository $repository): JsonResponse
    {
        return $this->json([
            'users' => $repository->getRoundsStatistic(),
            'rounds' => $repository->getUsersStatistic(),
        ]);
    }

    /**
     * @Route("/roulette", methods={"POST"}, name="roulette")
     * @param Request $request
     * @param RouletteServiceInterface $service
     * @return JsonResponse
     */
    public function roulette(Request $request, RouletteServiceInterface $service): JsonResponse
    {
        // Принимает json объект users с массивом идентификаторов пользователей (можно просто имена)
        if (0 !== strpos($request->headers->get('Content-Type'), 'application/json')) {
            throw new BadRequestHttpException();
        }

        $userNames = array_unique(
            json_decode($request->getContent(), true)['users']
        );
        $service->turn($userNames);

        return $this->json('success');
    }

}
