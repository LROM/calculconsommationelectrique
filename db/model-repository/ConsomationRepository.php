<?php

class ConsomationRepository extends ModelRepository
{
    private MaisonRepository $maisonRepo;
    private AppareilRepository $appareilRepo;

    public function __construct(
        ModelRepositoryConfig $config, 
        MaisonRepository $maisonRepository, 
        AppareilRepository $appareilRepository)
    {
        parent::__construct($config);
        $this->maisonRepo = $maisonRepository;
        $this->appareilRepo = $appareilRepository;
    }

    public function selectAll(): array
    {
        $requete = $this->connexion->prepare("SELECT * FROM consommation");
        $requete->execute();
 
        $consomations = array();
 
        while ($record = $requete->fetch())
        {
            $maisonId = $record['id_maison'];
            $maison = $this->maisonRepo->select($maisonId);
            $appareilId = $record['id_appareil'];
            $appareil = $this->appareilRepo->select($appareilId);
 
            $consomation = new Consommation(
                $maison, 
                $appareil, 
                $record['heures_par_jour_printemps'], 
                $record['heures_par_jour_ete'], 
                $record['heures_par_jour_automme'], 
                $record['heures_par_jour_hiver'], 
                $record['id']);
            $consomations[] = $consomation;
        }

        return $consomations;
    }


    public function select($id): ?Consommation
    {
        $requete = $this->connexion->prepare("SELECT * FROM consommation WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();

        $consommation = null;
        if ($record = $requete->fetch())
        {
            $maisonId = $record['id_maison'];
            $maison = $this->maisonRepo->select($maisonId);
            $appareilId = $record['id_appareil'];
            $appareil = $this->appareilRepo->select($appareilId);
 
            $consommation = new Consommation(
                $maison, 
                $appareil, 
                $record['heures_par_jour_printemps'], 
                $record['heures_par_jour_ete'], 
                $record['heures_par_jour_automme'], 
                $record['heures_par_jour_hiver'], 
                $record['id']);
        }

        return $consommation;
    }

    public function selectByMaison(int $maisonId): array
    {
        $requete = $this->connexion->prepare("SELECT * FROM consommation  WHERE id_maison=:maisonId");
        $requete->bindValue(":maisonId", $maisonId);
        $requete->execute();
 
        $consomations = array();
 
        while ($record = $requete->fetch())
        {
            $maisonId = $record['id_maison'];
            $maison = $this->maisonRepo->select($maisonId);
            $appareilId = $record['id_appareil'];
            $appareil = $this->appareilRepo->select($appareilId);
 
            $consomation = new Consommation(
                $maison, 
                $appareil, 
                $record['heures_par_jour_printemps'], 
                $record['heures_par_jour_ete'], 
                $record['heures_par_jour_automme'], 
                $record['heures_par_jour_hiver'], 
                $record['id']);
            $consomations[] = $consomation;
        }

        return $consomations;
    }

    /**
    * @param Consomation $consomation Le consomation à insérer en BD. Un nouvel id sera affecté à l'objet.
    * @return int Le nouvel id de la consomation. 0 si l'insertion ne se produit pas. 
    */
    public function insert(Consommation $consommation): int
    {
        $this->connexion->beginTransaction();
        $id_maison = $consommation->getMaison()->getId();
        $requete = $this->connexion->prepare(
            "INSERT 
                INTO consommation(
                    id_maison, 
                    id_appareil, 
                    heures_par_jour_printemps, 
                    heures_par_jour_ete, 
                    heures_par_jour_automme, 
                    heures_par_jour_hiver) 
                VALUE(
                    :id_maison, 
                    :id_appareil, 
                    :heures_par_jour_printemps, 
                    :heures_par_jour_ete, 
                    :heures_par_jour_automme, 
                    :heures_par_jour_hiver)");
        $requete->bindValue(":id_maison", $id_maison);
        $requete->bindValue(":id_appareil", $consommation->getAppareil()->getId());
        $requete->bindValue(":heures_par_jour_printemps", $consommation->getHeuresParJourPrintemps());
        $requete->bindValue(":heures_par_jour_ete", $consommation->getHeuresParJourEte());
        $requete->bindValue(":heures_par_jour_automme", $consommation->getHeuresParJourAutomme());
        $requete->bindValue(":heures_par_jour_hiver", $consommation->getHeuresParJourHiver());
        $requete->execute();

        $id = $this->connexion->lastInsertId();

        $this->connexion->commit();

        $consommation->setId($id);
        return $id;
    }

        /**
    * @param int $id L'id de la consommation à supprimer en BD.
    * @return bool Vrai si la suppression a été effectuée. Faux dans le cas contraire.
    */
    public function delete($id): bool
    {
        $this->connexion->beginTransaction();
        $requete = $this->connexion->prepare("DELETE FROM consommation WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();
        $succes = $requete->rowCount() != 0;
        $this->connexion->commit();
        return $succes;
    }

   /**
     * @param Consommation $consomation La consommation à mettre à jour en BD.
     * @return bool Vrai si la mise à jour a été effectuée. Faux dans le cas contraire.
     */
    public function update(Consommation $consommation): bool
    {
        $this->connexion->beginTransaction();
        $requete = $this->connexion->prepare(
            "UPDATE consommation 
                SET id_maison=:id_maison, 
                    id_appareil=:id_appareil, 
                    heures_par_jour_printemps=:heures_par_jour_printemps, 
                    heures_par_jour_ete=:heures_par_jour_ete, 
                    heures_par_jour_automme=:heures_par_jour_automme, 
                    heures_par_jour_hiver=:heures_par_jour_hiver 
                WHERE id=:id");
        $requete->bindValue(":id_maison", $consommation->getMaison()->getId());
        $requete->bindValue(":id_appareil", $consommation->getAppareil()->getId());
        $requete->bindValue(":heures_par_jour_printemps", $consommation->getHeuresParJourPrintemps());
        $requete->bindValue(":heures_par_jour_ete", $consommation->getHeuresParJourEte());
        $requete->bindValue(":heures_par_jour_automme", $consommation->getHeuresParJourAutomme());
        $requete->bindValue(":heures_par_jour_hiver", $consommation->getHeuresParJourHiver());
        $requete->bindValue(":id", $consommation->getId());
        $requete->execute();
        $succes = $requete->rowCount() != 0;
        $this->connexion->commit();
        return $succes;
    }
}
?>