<?php

class ArmyService
{
    /**
     * @param array $soldiers
     * @return int
     */
    public function getNumberOfMedics(array $soldiers)
    {
        $numberOfMedics = 0;
        /** @var Soldier $soldier */
        foreach ($soldiers as $soldier) {
            if ($soldier->isMedic()) {
                $numberOfMedics++;
            }
        }

        return $numberOfMedics;
    }

    /**
     * @param int   $health
     * @param array $soldiers
     */
    public function increaseSoldiersHealth($health, array $soldiers)
    {
        /** @var Soldier $soldier */
        foreach ($soldiers as $soldier) {
            $soldier->increaseHealth($health);
        }
    }

    /**
     * @param Army $army
     */
    public function killAllSoldiers(Army $army)
    {
        /** @var Soldier $soldier */
        foreach ($army->getSoldiers() as $key => $soldier) {
            $army->reduceTotalDamage($soldier->getDamage());
            $soldier->setIsDead(true);
            $army->killSoldier($key);
        }
    }
}