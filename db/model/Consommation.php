<?php

class Consommation
{
    private int $id;
    private Maison $maison;
    private Appareil $appareil;
    private int $heuresParJourPrintemps;
    private int $heuresParJourEte;
    private int $heuresParJourAutomme;
    private int $heuresParJourHiver;

    public function __construct(
            Maison $maison, 
            Appareil $appareil,
            int $heuresParJourPrintemps,
            int $heuresParJourEte,
            int $heuresParJourAutomme,
            int $heuresParJourHiver,
            int $id = 0)
    {
        $this->setId($id);
        $this->setMaison($maison);
        $this->setAppareil($appareil);
        $this->setHeuresParJourPrintemps($heuresParJourPrintemps);
        $this->setHeuresParJourEte($heuresParJourEte);
        $this->setHeuresParJourAutomme($heuresParJourAutomme);
        $this->setHeuresParJourHiver($heuresParJourHiver);
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
     * Get the value of maison
     *
     * @return Maison
     */
    public function getMaison(): Maison
    {
        return $this->maison;
    }

    /**
     * Set the value of maison
     *
     * @param Maison $maison
     *
     * @return self
     */
    public function setMaison(Maison $maison): self
    {
        $this->maison = $maison;

        return $this;
    }

    /**
     * Get the value of appareil
     *
     * @return Appareil
     */
    public function getAppareil(): Appareil
    {
        return $this->appareil;
    }

    /**
     * Set the value of appareil
     *
     * @param Appareil $appareil
     *
     * @return self
     */
    public function setAppareil(Appareil $appareil): self
    {
        $this->appareil = $appareil;

        return $this;
    }

    /**
     * Get the value of heuresParJourPrintemps
     *
     * @return int
     */
    public function getHeuresParJourPrintemps(): int
    {
        return $this->heuresParJourPrintemps;
    }

    /**
     * Set the value of heuresParJourPrintemps
     *
     * @param int $heuresParJourPrintemps
     *
     * @return self
     */
    public function setHeuresParJourPrintemps(int $heuresParJourPrintemps): self
    {
        $this->heuresParJourPrintemps = $heuresParJourPrintemps;

        return $this;
    }

    /**
     * Get the value of heuresParJourEte
     *
     * @return int
     */
    public function getHeuresParJourEte(): int
    {
        return $this->heuresParJourEte;
    }

    /**
     * Set the value of heuresParJourEte
     *
     * @param int $heuresParJourEte
     *
     * @return self
     */
    public function setHeuresParJourEte(int $heuresParJourEte): self
    {
        $this->heuresParJourEte = $heuresParJourEte;

        return $this;
    }

    /**
     * Get the value of heuresParJourAutomme
     *
     * @return int
     */
    public function getHeuresParJourAutomme(): int
    {
        return $this->heuresParJourAutomme;
    }

    /**
     * Set the value of heuresParJourAutomme
     *
     * @param int $heuresParJourAutomme
     *
     * @return self
     */
    public function setHeuresParJourAutomme(int $heuresParJourAutomme): self
    {
        $this->heuresParJourAutomme = $heuresParJourAutomme;

        return $this;
    }

    /**
     * Get the value of heuresParJourHiver
     *
     * @return int
     */
    public function getHeuresParJourHiver(): int
    {
        return $this->heuresParJourHiver;
    }

    /**
     * Set the value of heuresParJourHiver
     *
     * @param int $heuresParJourHiver
     *
     * @return self
     */
    public function setHeuresParJourHiver(int $heuresParJourHiver): self
    {
        $this->heuresParJourHiver = $heuresParJourHiver;

        return $this;
    }
}

?>