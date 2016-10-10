<?php

namespace App;

use App\Neurons\INeuron;
use App\Samples\ISample;
use Exception;

class NeuralNetwork
{
    /**
     * Нейроны
     * @var INeuron[]
     */
    private $neurons;

    /**
     * Добавить нейрон
     * @param INeuron $neuron
     */
    public function addNeuron(INeuron $neuron)
    {
        $this->neurons[] = $neuron;
    }

    /**
     * Получить нейрон
     * @param integer $index
     * @return INeuron
     * @throws Exception
     */
    public function getNeuron($index)
    {
        if (!isset($this->neurons[$index])) {
            throw new Exception("Neuron `{$index}` index was not found");
        }
        return $this->neurons[$index];
    }

    /**
     * Обучить сеть
     * @param INeuron[] $neurons
     * @param ISample[] $samples
     * @param array $expected_results
     * @param integer $iterations Количество эпох обучения
     */
    public function train(array $neurons, array $samples, array $expected_results, $iterations)
    {
        for ($i = 0; $i < count($neurons); $i++) {
            for ($k = 0; $k < $iterations; $k++) {
                for ($j = 0; $j < count($samples); $j++) {
                    $samples[$j]->setExpectedResult($expected_results[$j][$i]);
                    $neurons[$i]->train($samples[$j]);
                }
            }
            $this->addNeuron($neurons[$i]);
        }
    }

    /**
     * Спрогнозировать результат
     * @param ISample $sample
     * @return array
     */
    public function predict(ISample $sample)
    {
        if (!$this->neurons) {
            throw new \RuntimeException("No neutrons");
        }

        $results = [];
        for ($i = 0; $i < count($this->neurons); $i++) {
            $results[$i] = $this->neurons[$i]->predict($sample);
        }
        return $results;
    }

    /**
     * Проверка сети с выводом результатов
     * @param ISample[] $samples
     */
    public function test(array $samples)
    {
        /**
         * @var \App\Samples\ISample $sample
         */
        foreach ($samples as $sample) {
            $results = $this->predict($sample);
            foreach ($results as $neuron_index => $percents) {
                $neuron_name = $this->getNeuron($neuron_index)->getName();
                echo "{$neuron_name} {$sample->getName()} = {$percents}" . PHP_EOL;
            }
            echo PHP_EOL;
        }
    }
}