<?php

class Appareil
{
    private int $id;
    private string $name;
    private float $kilowatts_heure;

    public function __construct(string $name, float $kilowatts_heure,int $id = 0)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setKiloWattsheure($kilowatts_heure);
    }

        /**
         * Get the value of id
         */
        public function getId():int
        {
                return $this->id;
        }

        /**
         * Set the value of id
         */
        public function setId($id): self
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of name
         */
        public function getName(): string
        {
                return $this->name;
        }

        /**
         * Set the value of name
         */
        public function setName($name): self
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of kilowatts_heure
         */
        public function getKilowattsHeure(): float
        {
                return $this->kilowatts_heure;
        }

        /**
         * Set the value of kilowatts_heure
         */
        public function setKilowattsHeure($kilowatts_heure): self
        {
                $this->kilowatts_heure = $kilowatts_heure;

                return $this;
        }
    

}

?>