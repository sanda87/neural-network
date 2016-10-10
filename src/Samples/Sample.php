<?php

namespace App\Samples;

use InvalidArgumentException;

/**
 * Class Sample
 */
class Sample implements ISample
{
    /**
     * Название
     * @var
     */
    private $name;

    /**
     * Вес
     * @var
     */
    private $weight;

    /**
     * Мощность двигателя
     * @var
     */
    private $enginePower;

    /**
     * Количество посадочных мест
     * @var
     */
    private $numberSeats;

    /**
     * Грузоподъемность
     * @var
     */
    private $capacity;

    /**
     * Ожидаемое значение
     * @var
     */
    private $expectedResult;

    /**
     * Sample constructor.
     * @param $name
     * @param $weight
     * @param $enginePower
     * @param $numberSeats
     * @param $capacity
     */
    public function __construct($name, $weight, $enginePower, $numberSeats, $capacity)
    {
        $this->name = $name;
        $this->setWeight($weight);
        $this->setEnginePower($enginePower);
        $this->setNumberSeats($numberSeats);
        $this->setCapacity($capacity);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int|float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int|float $weight
     */
    public function setWeight($weight)
    {
        if (!is_numeric($weight)) {
            throw new \InvalidArgumentException("Weight is not numeric");
        }
        if ($weight <= 0.5) {
            $this->weight = 0;
        } else if ($weight > 0.5 && $weight <= 1) {
            $this->weight = 0.25;
        } else if ($weight > 1 && $weight <= 2) {
            $this->weight = 0.5;
        } else if ($weight > 2 && $weight <= 5) {
            $this->weight = 0.75;
        } else if ($weight > 5) {
            $this->weight = 1;
        }
    }

    /**
     * @return int|float
     */
    public function getEnginePower()
    {
        return $this->enginePower;
    }

    /**
     * @param int|float $enginePower
     */
    public function setEnginePower($enginePower)
    {
        if (!is_numeric($enginePower)) {
            throw new \InvalidArgumentException("EnginePower is not numeric");
        }
        if ($enginePower <= 20) {
            $this->enginePower = 0;
        } else if ($enginePower > 20 && $enginePower <= 50) {
            $this->enginePower = 0.25;
        } else if ($enginePower > 50 && $enginePower <= 100) {
            $this->enginePower = 0.5;
        } else if ($enginePower > 100 && $enginePower <= 200) {
            $this->enginePower = 0.75;
        } else if ($enginePower > 200) {
            $this->enginePower = 1;
        }
    }

    /**
     * @return int|float
     */
    public function getNumberSeats()
    {
        return $this->numberSeats;
    }

    /**
     * @param int|float $numberSeats
     */
    public function setNumberSeats($numberSeats)
    {
        if (!is_numeric($numberSeats)) {
            throw new \InvalidArgumentException("NumberSeats is not numeric");
        }
        if ($numberSeats <= 2) {
            $this->numberSeats = 0;
        } else if ($numberSeats > 2 && $numberSeats <= 5) {
            $this->numberSeats = 0.25;
        } else if ($numberSeats > 5 && $numberSeats <= 10) {
            $this->numberSeats = 0.5;
        } else if ($numberSeats > 10 && $numberSeats <= 20) {
            $this->numberSeats = 0.75;
        } else if ($numberSeats > 20) {
            $this->numberSeats = 1;
        }
    }

    /**
     * @return int|float
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param int|float $capacity
     */
    public function setCapacity($capacity)
    {
        if (!is_numeric($capacity)) {
            throw new \InvalidArgumentException("Capacity is not numeric");
        }
        if ($capacity <= 1) {
            $this->capacity = 0;
        } else if ($capacity > 1 && $capacity <= 2) {
            $this->capacity = 0.25;
        } else if ($capacity > 2 && $capacity <= 3) {
            $this->capacity = 0.5;
        } else if ($capacity > 3 && $capacity <= 4) {
            $this->capacity = 0.75;
        } else if ($capacity > 4) {
            $this->capacity = 1;
        }
        $this->capacity = $capacity;
    }

    /**
     * @return int
     */
    public function getExpectedResult()
    {
        if ($this->expectedResult === null) {
            throw new \RuntimeException("The expected result is not set");
        }
        return $this->expectedResult;
    }


    /**
     * Установить ожидаемый результат
     * @param $expected_result
     * @return void
     */
    public function setExpectedResult($expected_result)
    {
        if (!in_array($expected_result, [0, 1])) {
            throw new InvalidArgumentException("Incorrect expected result");
        }
        $this->expectedResult = $expected_result;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            $this->getWeight(),
            $this->getEnginePower(),
            $this->getNumberSeats(),
            $this->getCapacity()
        ];
    }
}