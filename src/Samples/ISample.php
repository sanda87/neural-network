<?php

namespace App\Samples;


interface ISample
{

    /**
     * Получить название примера
     * @return mixed
     */
    public function getName();

    /**
     * Получить ожидаемый результат
     * @return int
     */
    public function getExpectedResult();

    /**
     * Установить ожидаемый результат
     * @param $expected_result
     * @return void
     */
    public function setExpectedResult($expected_result);

    /**
     * Конвертировать в массив
     * @return mixed
     */
    public function toArray();

}