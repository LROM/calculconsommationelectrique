<?php

class Tarif
{
    private int $id;
    private int $annee;
    private float $kilowatts_heure_moins_egal_40;
    private float $kilowatts_heure_plus_40;
    private float $cout_access_reseau_par_jour;
 

    public function __construct(
        int $annee,
        float $kilowatts_heure_moins_egal_40, 
        float $kilowatts_heure_plus_40,
        float $cout_access_reseau_par_jour,
        int $id = 0)
    {
        $this->setId($id);
        $this->setAnnee($annee);
        $this->setKilowattsHeureMoinsEgal40($kilowatts_heure_moins_egal_40);
        $this->setKilowattsHeurePlus40($kilowatts_heure_plus_40);
        $this->setCoutAccessReseauParJour($cout_access_reseau_par_jour);
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of kilowatts_heure_moins_egal_40
     *
     * @return float
     */
    public function getKilowattsHeureMoinsEgal40(): float
    {
        return $this->kilowatts_heure_moins_egal_40;
    }

    /**
     * Set the value of kilowatts_heure_moins_egal_40
     *
     * @param float $kilowatts_heure_moins_egal_40
     *
     * @return self
     */
    public function setKilowattsHeureMoinsEgal40(float $kilowatts_heure_moins_egal_40): self
    {
        $this->kilowatts_heure_moins_egal_40 = $kilowatts_heure_moins_egal_40;

        return $this;
    }

    /**
     * Get the value of kilowatts_heure_plus_40
     *
     * @return float
     */
    public function getKilowattsHeurePlus40(): float
    {
        return $this->kilowatts_heure_plus_40;
    }

    /**
     * Set the value of kilowatts_heure_plus_40
     *
     * @param float $kilowatts_heure_plus_40
     *
     * @return self
     */
    public function setKilowattsHeurePlus40(float $kilowatts_heure_plus_40): self
    {
        $this->kilowatts_heure_plus_40 = $kilowatts_heure_plus_40;

        return $this;
    }

    /**
     * Get the value of cout_access_reseau_par_jour
     *
     * @return float
     */
    public function getCoutAccessReseauParJour(): float
    {
        return $this->cout_access_reseau_par_jour;
    }

    /**
     * Set the value of cout_access_reseau_par_jour
     *
     * @param float $cout_access_reseau_par_jour
     *
     * @return self
     */
    public function setCoutAccessReseauParJour(float $cout_access_reseau_par_jour): self
    {
        $this->cout_access_reseau_par_jour = $cout_access_reseau_par_jour;

        return $this;
    }

    /**
     * Get the value of annee
     *
     * @return int
     */
    public function getAnnee(): int
    {
        return $this->annee;
    }

    /**
     * Set the value of annee
     *
     * @param int $annee
     *
     * @return self
     */
    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }
}

?>