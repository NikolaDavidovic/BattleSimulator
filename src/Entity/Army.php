<?php
include 'Soldier.php';
include 'src/Validator/ArmyValidator.php';

class Army
{
    private $numOfSoldiers;
    private $totalDamage = 0;
    private $soldiers = [];

    /**
     * Army constructor.
     * @param int $numOfSoldiers
     */
    public function __construct($numOfSoldiers)
    {
        $validator = new ArmyValidator();
        try {
            $validator->validate($numOfSoldiers);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        $this->numOfSoldiers = $numOfSoldiers;
        $this->setSoldiers();
    }

    /**
     * @return array
     */
    public function getSoldiers()
    {
        return $this->soldiers;
    }

    /**
     * @return mixed
     */
    public function getTotalDamage()
    {
        return $this->totalDamage;
    }

    /**
     * @return int
     */
    public function getSoldiersCount()
    {
        return count($this->soldiers);
    }

    /**
     * @return bool
     */
    public function areSoldiersAlive()
    {
        return !!count($this->soldiers);
    }

    /**
     * @param $damage
     */
    public function reduceTotalDamage($damage)
    {
        $this->totalDamage -= $damage;
    }

    public function killSoldier($key)
    {
        unset($this->soldiers[$key]);
    }

    public function randomFormation()
    {
        shuffle($this->soldiers);
    }

    /**
     * Generate soldiers
     */
    private function setSoldiers()
    {
        for ($i = 0; $i < $this->numOfSoldiers; $i++) {
            $soldier = new Soldier();
            $this->soldiers[$i] = $soldier;
            $this->totalDamage += $soldier->getDamage();
        }
    }
}