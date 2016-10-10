<?php

use App\NeuralNetwork;
use App\Neurons\Neuron;
use App\Samples\Sample;

require __DIR__ . '/vendor/autoload.php';

$neuralNetwork = new NeuralNetwork();

$neurons = [
    new Neuron("Легковой автомобиль", 4, 0.05),
    new Neuron("Пассажирский транспорт", 4, 0.05),
    new Neuron("Грузовой транспорт", 4, 0.05)
];

$samples = [
    new Sample("Ока", 0.645, 33, 4, 0.34),
    new Sample("Газель пасcaжир", 2.880, 152, 14, 1.5),
    new Sample("Лада Калина", 1.110, 88, 5, 0.475),
    new Sample("Камаз(3 оси)", 10.400, 260, 3, 6),
    new Sample("Газель груз", 2.880, 152, 3, 1.5),
    new Sample("ПАЗ4234(пазик)", 9.895, 122, 30, 6.2),
    new Sample("ЗИЛ-5301(бычок)", 3.695, 136, 3, 3),
    new Sample("УАЗ Патриот", 2.170, 116, 5, 0.6),
    new Sample("ЛиАЗ-6213", 27.895, 278, 150, 11),
];

$expected_results = [
    [1, 0, 0],
    [0, 1, 0],
    [1, 0, 0],
    [0, 0, 1],
    [0, 0, 1],
    [0, 1, 0],
    [0, 0, 1],
    [1, 0, 0],
    [0, 1, 0]
];

$test_samples = [
    new Sample("Камри", 1.815, 160, 5, 0.45),
    new Sample("Hiace", 1.745, 150, 10, 1.145),
    new Sample("Трамвай", 18.4, 245, 168, 12),
];

$neuralNetwork->train($neurons, $samples, $expected_results, 5000);

echo "Обучающая выборка" . PHP_EOL . PHP_EOL;
$neuralNetwork->test($samples);

echo PHP_EOL . PHP_EOL . "Тестовая выборка" . PHP_EOL . PHP_EOL;
$neuralNetwork->test($test_samples);