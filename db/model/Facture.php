<?php

class Facture
{
    private int $id;
    private int $maisonId;
    private int $numeroFacture;
    private ?DateTime $date_debut;
    private ?DateTime $date_fin;
    private float $cout_kwh_jusqua_40kw_par_jour;
    private float $cout_kwh_apres_40kw_par_jour;
    private float $frais_access_reseau_par_jour;
    private float $total_sans_taxe;

    public function __construct(
        int $maisonId,
        int $numeroFacture, 
        ?DateTime $date_debut,
        ?DateTime $date_fin,
        float $cout_kwh_jusqua_40kw_par_jour,
        float $cout_kwh_apres_40kw_par_jour,
        float $frais_access_reseau_par_jour,
        float $total_sans_taxe,
        int $id = 0)
    {
        $this->setMaisonId($maisonId);
        $this->setNumeroFacture($numeroFacture);
        $this->setDateDebut($date_debut);
        $this->setDateFin($date_fin);
        $this->setCoutKWHJusqua40kwParJour($cout_kwh_jusqua_40kw_par_jour);
        $this->setCoutKWHApres40kwParJour($cout_kwh_apres_40kw_par_jour);
        $this->setFraisAccessReseauParJour($frais_access_reseau_par_jour);
        $this->setTotalSansTaxe($total_sans_taxe);
        $this->setId($id);
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
     * Get the value of maisonId
     *
     * @return int
     */
    public function getMaisonId(): int
    {
        return $this->maisonId;
    }

    /**
     * Set the value of maisonId
     *
     * @param int $maisonId
     *
     * @return self
     */
    public function setMaisonId(int $maisonId): self
    {
        $this->maisonId = $maisonId;

        return $this;
    }

    /**
     * Get the value of numeroFacture
     *
     * @return int
     */
    public function getNumeroFacture(): int
    {
        return $this->numeroFacture;
    }

    /**
     * Set the value of numeroFacture
     *
     * @param int $numeroFacture
     *
     * @return self
     */
    public function setNumeroFacture(int $numeroFacture): self
    {
        $this->numeroFacture = $numeroFacture;

        return $this;
    }

    /**
     * Get the value of date_debut
     *
     * @return DateTime
     */
    public function getDateDebut(): ?DateTime
    {
        return $this->date_debut;
    }

    /**
     * Set the value of date_debut
     *
     * @param DateTime $date_debut
     *
     * @return self
     */
    public function setDateDebut(?DateTime $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    /**
     * Get the value of date_fin
     *
     * @return DateTime
     */
    public function getDateFin(): ?DateTime
    {
        return $this->date_fin;
    }

    /**
     * Set the value of date_fin
     *
     * @param DateTime $date_fin
     *
     * @return self
     */
    public function setDateFin(?DateTime $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    /**
     * Get the value of cout_kwh_jusqua_40kw_par_jour
     *
     * @return float
     */
    public function getCoutKWHJusqua40kwParJour(): float
    {
        return $this->cout_kwh_jusqua_40kw_par_jour;
    }

    /**
     * Set the value of cout_kwh_jusqua_40kw_par_jour
     *
     * @param float $cout_kwh_jusqua_40kw_par_jour
     *
     * @return self
     */
    public function setCoutKWHJusqua40kwParJour(float $cout_kwh_jusqua_40kw_par_jour): self
    {
        $this->cout_kwh_jusqua_40kw_par_jour = $cout_kwh_jusqua_40kw_par_jour;

        return $this;
    }

    /**
     * Get the value of cout_kwh_apres_40kw_par_jour
     *
     * @return float
     */
    public function getCoutKWHApres40kwParJour(): float
    {
        return $this->cout_kwh_apres_40kw_par_jour;
    }

    /**
     * Set the value of cout_kwh_apres_40kw_par_jour
     *
     * @param float $cout_kwh_apres_40kw_par_jour
     *
     * @return self
     */
    public function setCoutKWHApres40kwParJour(float $cout_kwh_apres_40kw_par_jour): self
    {
        $this->cout_kwh_apres_40kw_par_jour = $cout_kwh_apres_40kw_par_jour;

        return $this;
    }

    /**
     * Get the value of total_sans_taxe
     *
     * @return float
     */
    public function getTotalSansTaxe(): float
    {
        return $this->total_sans_taxe;
    }

    /**
     * Set the value of total_sans_taxe
     *
     * @param float $total_sans_taxe
     *
     * @return self
     */
    public function setTotalSansTaxe(float $total_sans_taxe): self
    {
        $this->total_sans_taxe = $total_sans_taxe;

        return $this;
    }

    /**
     * Get the value of frais_access_reseau_par_jour
     *
     * @return float
     */
    public function getFraisAccessReseauParJour(): float
    {
        return $this->frais_access_reseau_par_jour;
    }

    /**
     * Set the value of frais_access_reseau_par_jour
     *
     * @param float $frais_access_reseau_par_jour
     *
     * @return self
     */
    public function setFraisAccessReseauParJour(float $frais_access_reseau_par_jour): self
    {
        $this->frais_access_reseau_par_jour = $frais_access_reseau_par_jour;

        return $this;
    }
}

?>