<?php

class NaturalDisasters
{
    const FLOOD = 1;
    const EARTHQUAKE = 2;
    const VOLCANIC_ERUPTION = 3;

    const KILLS_PER_ARMY_FLOOD = ['min' => 2, 'max' => 5];
    const KILLS_PER_ARMY_EARTHQUAKE = ['min' => 4, 'max' => 10];
    const KILLS_PER_ARMY_VOLCANIC_ERUPTION = ['min' => 5, 'max' => 15];

    private $disaster;

    /**
     * NaturalDisasters constructor.
     */
    public function __construct()
    {
        $this->disaster = rand(1, 3);
    }

    /**
     * @return int
     */
    public function getKillsPerArmy()
    {
        $kills = [
            1 => self::KILLS_PER_ARMY_FLOOD,
            2 => self::KILLS_PER_ARMY_EARTHQUAKE,
            3 => self::KILLS_PER_ARMY_VOLCANIC_ERUPTION,
        ];

        return rand($kills[$this->disaster]['min'], $kills[$this->disaster]['max']);
    }

    /**
     * @return mixed
     */
    public function getDisasterName()
    {
        $disasterNames = [
            1 => 'flood',
            2 => 'earthquake',
            3 => 'volcanic eruption',
        ];

        return $disasterNames[$this->disaster];
    }
}