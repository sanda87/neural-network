<?php

namespace App\Neurons;

use App\Samples\ISample;

/**
 * Interface INeuron
 * @package App\Neurons
 */
interface INeuron
{

    /**
     * Обучить на примере
     * @param ISample $sample
     */
    public function train(ISample $sample);

    /**
     * Предсказать результат
     * @param ISample $sample
     * @return int|float
     */
    public function predict(ISample $sample);

    /**
     * Получить название нейрона
     * @return string
     */
    public function getName();

}