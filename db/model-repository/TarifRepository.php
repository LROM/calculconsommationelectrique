<?php

//require_once 'model/Appareil.php';
//require_once 'ModelRepository.php';

class TarifRepository extends ModelRepository
{
    public function selectAll(): array
    {
        $requete = $this->connexion->prepare("SELECT * FROM tarif_kwh");
        $requete->execute();

        $appareils = array();
        while ($record = $requete->fetch())
        {
            $appareil = new Appareil($record['name'], $record['kilowatts_heure'], $record['id']);
            $appareils[] = $appareil;
        }
        //$appareils[] = $this->constructAppareilFromRecord($record);

        return $appareils;
    }

    public function select($id): ?Tarif
    {
        $requete = $this->connexion->prepare("SELECT * FROM tarif_kwh WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();

        $tarif = null;
        if ($record = $requete->fetch())
        {
            $tarif = new Tarif(
                $record['annee'], 
                $record['kilowatts_heure_moins_egal_40'],  
                $record['kilowatts_heure_plus_40'],
                $record['cout_access_reseau_par_jour'],
                $record['id']);
        }

        return $tarif;
    }

    public function selectAnnee($annee): ?Tarif
    {
        $requete = $this->connexion->prepare("SELECT * FROM tarif_kwh WHERE annee=:annee");
        $requete->bindValue(":annee", $annee);
        $requete->execute();

        $tarif = null;
        if ($record = $requete->fetch())
        {
            $tarif = new Tarif(
                $record['annee'], 
                $record['kilowatts_heure_moins_egal_40'],  
                $record['kilowatts_heure_plus_40'],
                $record['cout_access_reseau_par_jour'],
                $record['id']);
        }

        return $tarif;
    }

    public function insert(Tarif $tarif): int
    {
        $this->connexion->beginTransaction();

        $requete = $this->connexion->prepare(
            "INSERT 
                INTO tarif(annee,kilowatts_heure_moins_egal_40, kilowatts_heure_plus_40, cout_access_reseau_par_jour) " . 
                "VALUE(:annee, :kilowatts_heure_moins_egal_40, :kilowatts_heure_plus_40, :cout_access_reseau_par_jour)");
        $requete->bindValue(":annee", $tarif->getAnnee());
        $requete->bindValue(":kilowatts_heure_moins_egal_40", $tarif->getKilowattsHeureMoinsEgal40());
        $requete->bindValue(":kilowatts_heure_plus_40", $tarif->getKilowattsHeurePlus40());
        $requete->bindValue(":cout_access_reseau_par_jour", $tarif->getCoutAccessReseauParJour());
        $requete->execute();

        $id = $this->connexion->lastInsertId();

        $this->connexion->commit();

        $tarif->setId($id);
        return $id;
    }

    /**
     * @param Tarif $tarif La tarif tag à mettre à jour en BD.
     * @return bool Vrai si la mise à jour a été effectuée. Faux dans le cas contraire.
     */
    public function update(Tarif $tarif): bool
    {
        $this->connexion->beginTransaction();
        $requete = $this->connexion->prepare("UPDATE tarif_kwh 
            SET 
                annee=:annee, 
                kilowatts_heure_moins_egal_40=:kilowatts_heure_moins_egal_40, 
                kilowatts_heure_plus_40=:kilowatts_heure_plus_40, 
                cout_access_reseau_par_jour=:cout_access_reseau_par_jour
                WHERE id=:id");
        $requete->bindValue(":annee", $tarif->getAnnee());
        $requete->bindValue(":kilowatts_heure_moins_egal_40", $tarif->getKilowattsHeureMoinsEgal40());
        $requete->bindValue(":kilowatts_heure_plus_40", $tarif->getKilowattsHeurePlus40());
        $requete->bindValue(":cout_access_reseau_par_jour", $tarif->getCoutAccessReseauParJour());
        $requete->bindValue(":id", $tarif->getId());
        $requete->execute();
        $succes = $requete->rowCount() != 0;
        $this->connexion->commit();
        return $succes;
    }


    /**
     * @param string $id L'id de la tarif à supprimer en BD.
     * @return bool Vrai si la suppression a été effectuée. Faux dans le cas contraire.
     */
    public function delete($id): bool
    {
        $this->connexion->beginTransaction();
        $requete = $this->connexion->prepare("DELETE FROM tarif_kwh WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();
        $succes = $requete->rowCount() != 0;
        $this->connexion->commit();
        return $succes;
    }
}
