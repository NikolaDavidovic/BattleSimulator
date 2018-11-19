<?php

class Soldier
{
    const WEAPON_SWORD = 1;
    const WEAPON_GUN = 2;
    const WEAPON_SWORD_DAMAGE = 5;
    const WEAPON_GUN_DAMAGE = 8;

    const FIGHTING_SKILLS_LOW = 1;
    const FIGHTING_SKILLS_AVERAGE = 2;
    const FIGHTING_SKILLS_HIGH = 3;

    const MAX_HEALTH = 25;
    const MEDIC_HEAL = 5;

    private $weapon;
    private $fightingSkills;
    private $damage;
    private $isMedic;
    private $health = self::MAX_HEALTH;
    private $isDead = false;

    /**
     * Soldier constructor.
     */
    public function __construct()
    {
        $this->setWeapon();
        $this->setFightingSkills();
        $this->setIsMedic();
        $this->setDamage();
    }

    /**
     * @return mixed
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @return mixed
     */
    public function isMedic()
    {
        return $this->isMedic;
    }

    /**
     * @param int $health
     */
    public function increaseHealth($health)
    {
        $this->health += $health;
        if ($this->health > self::MAX_HEALTH) {
            $this->health = self::MAX_HEALTH;
        }
    }

    /**
     * @param int $health
     */
    public function reduceHealth($health)
    {
        $this->health -= $health;
        if ($this->health <= 0) {
            $this->setIsDead(true);
        }
    }

    /**
     * @return bool
     */
    public function isDead()
    {
        return $this->isDead;
    }

    /**
     * @param bool $isDead
     */
    public function setIsDead($isDead) {
        $this->isDead = $isDead;
    }

    /**
     * Random generates soldiers weapon
     */
    private function setWeapon()
    {
        $this->weapon = rand(1, 2) === 1 ? self::WEAPON_SWORD : self::WEAPON_GUN;
    }

    /**
     * Random generates soldiers fighting skills
     */
    private function setFightingSkills()
    {
        $fightingSkills = [
            1 => self::FIGHTING_SKILLS_LOW,
            2 => self::FIGHTING_SKILLS_AVERAGE,
            3 => self::FIGHTING_SKILLS_HIGH
        ];

        $this->fightingSkills = $fightingSkills[rand(1, 3)];
    }

    /**
     * Calculates soldiers damage
     */
    private function setDamage()
    {
        $weaponDamage = $this->weapon === self::WEAPON_SWORD ? self::WEAPON_SWORD_DAMAGE : self::WEAPON_GUN_DAMAGE;
        $this->damage = $weaponDamage * $this->fightingSkills;
    }

    /**
     * Chance for a soldier to be a medic is 1/10
     */
    private function setIsMedic()
    {
        $this->isMedic = 10 === rand(1, 10) ? 1 : 0;
    }
}