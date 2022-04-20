<?php

class Maison
{
    private int $id;
    private string $address;
    private string $codePostal;
    private int $utilisateur_id;

    public function __construct(string $address, string $codePostal, int $utilisateur_id, int $id = 0)
    {
        $this->setId($id);
        $this->setaddress($address);
        $this->setCodePostal($codePostal);
        $this->setUtilisateurId($utilisateur_id);
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
         * Get the value of address
         */
        public function getAddress(): string
        {
                return $this->address;
        }

        /**
         * Set the value of address
         */
        public function setAddress($address): self
        {
                $this->address = $address;

                return $this;
        }

        /**
         * Get the value of code postal
         */
        public function getCodePostal(): string
        {
                return $this->codePostal;
        }

        /**
         * Set the value of code postal
         */
        public function setCodePostal($codePostal): self
        {
                $this->codePostal = $codePostal;

                return $this;
        }
    
        /**
         * Get the value of proprietaire id
         */
        public function getUtilisateurId(): int
        {
                return $this->utilisateur_id;
        }

        /**
         * Set the value of proprietaire id
         */
        public function setUtilisateurId($utilisateur_id): self
        {
                $this->utilisateur_id = $utilisateur_id;

                return $this;
        }
}

?>