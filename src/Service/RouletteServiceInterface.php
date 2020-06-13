<?php

declare(strict_types=1);

namespace App\Service;


interface RouletteServiceInterface
{
    /**
     * Прокрутка рулетки
     * @param array $userNames Пользователи участвующие в прокрутке
     * @return mixed
     */
    public function turn(array $userNames);
}
