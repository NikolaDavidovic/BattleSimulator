<?php

class ArmyValidator
{
    /**
     * @param int $numOfSoldiers
     * @throws Exception
     */
    public function validate($numOfSoldiers)
    {
        if (!is_int($numOfSoldiers) || $numOfSoldiers <= 0) {
            throw new Exception("Please provide valid number greater than 0.");
        }
    }
}