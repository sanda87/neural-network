<?php

namespace App\Neurons;

use App\Samples\ISample;
use InvalidArgumentException;

/**
 * Class Neuron
 */
class Neuron implements INeuron
{
    /**
     * Название класса
     * @var
     */
    private $name;

    /**
     * Веса
     * @var
     */
    private $w;

    /**
     * Коэффициент влияющий на скорость обучения (0,1)
     * @var
     */
    private $alpha;


    /**
     * Neuron constructor.
     * @param string $name Название класса
     * @param integer $number_inputs Количество входов
     * @param int|float $alpha Коэффициент влияющий на скорость обучения
     */
    public function __construct($name, $number_inputs, $alpha)
    {
        $this->w = array_fill(0, $number_inputs, 0);
        $this->name = $name;
        $this->setAlpha($alpha);
    }

    /**
     * Обучение
     * @param ISample $sample
     */
    public function train(ISample $sample)
    {
        $result = $this->predict($sample);
        if ($result != $sample->getExpectedResult()) {
            $this->optimize($sample->toArray(), $sample->getExpectedResult(), $result);
        }
    }

    /**
     * Сумматор
     * @param $sample
     * @return int|mixed
     */
    private function sum($sample)
    {
        $result = 0;
        for ($i = 0; $i < count($sample); $i++) {
            $result += $this->w[$i] * $sample[$i];
        }
        return $result;
    }

    /**
     * Функция активации
     * @param $u
     * @return int|float
     */
    private function activate($u)
    {
        if ($u <= 0) {
            return 0;
        } else if ($u > 1) {
            return 1;
        }
        return $u;
    }

    /**
     * Оптимизация весов
     * @param array $sample
     * @param $expected_result
     * @param $result
     */
    private function optimize($sample, $expected_result, $result)
    {
        for ($i = 0; $i < count($this->w); $i++) {
            $this->w[$i] = $this->w[$i] + $this->alpha * ($expected_result - $result) * $sample[$i];
        }
    }

    /**
     * Проверить правильность примера
     * @param $sample_to_array
     */
    private function validateSample($sample_to_array)
    {
        if (count($this->w) !== count($sample_to_array)) {
            throw new InvalidArgumentException("Incorrect sample");
        }
    }

    /**
     * Предсказать результат
     * @param ISample $sample
     * @return int|float
     */
    public function predict(ISample $sample)
    {
        $this->validateSample($sample->toArray());
        return $this->activate($this->sum($sample->toArray()));
    }

    /**
     * Установить значение коэффициента влияющего на скорость обучения
     * @param integer|float $alpha
     */
    public function setAlpha($alpha)
    {
        if (!is_numeric($alpha) || $alpha < 0 || $alpha > 1) {
            throw new InvalidArgumentException("Alpha is incorrect");
        }
        $this->alpha = $alpha;
    }

    /**
     * Получить название нейрона
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}