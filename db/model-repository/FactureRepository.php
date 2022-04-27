<?php
    
class FactureRepository extends ModelRepository
{
    public function selectAll(): array
    {
        $requete = $this->connexion->prepare("SELECT * FROM facture");
        $requete->execute();

        $factures = array();
        while ($record = $requete->fetch())
        {

            $dateDebut = DateTime::createFromFormat('Y-M-j', $record['date_debut']);
            $dateFin = DateTime::createFromFormat('Y-M-j', $record['date_fin']);
            $facture = new Facture(
                $record['maisonId'], 
                $record['numeroFacture'], 
                $dateDebut, 
                $dateFin, 
                $record['cout_kwh_jusqua_40kw_par_jour'], 
                $record['cout_kwh_apres_40kw_par_jour'], 
                $record['frais_access_reseau_par_jour'], 
                $record['total_sans_taxe'], 
                $record['id']);
            $facture[] = $facture;
        }

        return $factures;
    }

    public function select($id): ?Facture
    {
        $requete = $this->connexion->prepare("SELECT * FROM facture WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();

        $facture = null;
        if ($record = $requete->fetch())
        {
            $facture = new Facture(
                $record['maisonId'], 
                $record['numeroFacture'],
                $record['date_debut'], 
                $record['date_fin'], 
                $record['cout_kwh_jusqua_40kw_par_jour'], 
                $record['cout_kwh_apres_40kw_par_jour'], 
                $record['frais_access_reseau_par_jour'], 
                $record['total_sans_taxe'], 
                $record['id']);
        }

        return $facture;
    }

    public function selectByMaisonId($maisonId): array
    {
        $requete = $this->connexion->prepare("SELECT * FROM facture WHERE maisonId=:maisonId");
        $requete->bindValue(":maisonId", $maisonId);
        $requete->execute();

        $factures = array();
        while ($record = $requete->fetch())
        {
            $dateDebut = DateTime::createFromFormat('Y-m-j', $record['date_debut']);
            $dateFin = DateTime::createFromFormat('Y-m-j', $record['date_fin']);
            $facture = new Facture(
                $record['maisonId'], 
                $record['numeroFacture'], 
                $dateDebut, 
                $dateFin, 
                $record['cout_kwh_jusqua_40kw_par_jour'], 
                $record['cout_kwh_apres_40kw_par_jour'], 
                $record['frais_access_reseau_par_jour'], 
                $record['total_sans_taxe'], 
                $record['id']);
            $factures[] = $facture;
        }

        return $factures;
    }

    public function insert(Facture $facture): int
    {
        $this->connexion->beginTransaction();

        $requete = $this->connexion->prepare(
            "INSERT 
                INTO facture(maisonId,numeroFacture, date_debut, date_fin, cout_kwh_jusqua_40kw_par_jour, cout_kwh_apres_40kw_par_jour, frais_access_reseau_par_jour, total_sans_taxe) " . 
                "VALUE(:maisonId, :numeroFacture, :date_debut, :date_fin, :cout_kwh_jusqua_40kw_par_jour, :cout_kwh_apres_40kw_par_jour, :frais_access_reseau_par_jour, :total_sans_taxe)");
        $requete->bindValue(":maisonId", $facture->getMaisonId());
        $requete->bindValue(":numeroFacture", $facture->getNumeroFacture());
        $requete->bindValue(":date_debut", $facture->getDateDebut());
        $requete->bindValue(":date_fin", $facture->getDateFin());
        $requete->bindValue(":cout_kwh_jusqua_40kw_par_jour", $facture->getCoutKWHJusqua40kwParJour());
        $requete->bindValue(":cout_kwh_apres_40kw_par_jour", $facture->getCoutKWHApres40kwParJour());
        $requete->bindValue(":frais_access_reseau_par_jour", $facture->getFraisAccessReseauParJour());
        $requete->bindValue(":total_sans_taxe", $facture->getTotalSansTaxe());
        $requete->execute();

        $id = $this->connexion->lastInsertId();

        $this->connexion->commit();

        $facture->setId($id);
        return $id;
    }

    /**
     * @param Facture $facture à mettre à jour en BD.
     * @return bool Vrai si la mise à jour a été effectuée. Faux dans le cas contraire.
     */
    public function update(Facture $facture): bool
    {
        $this->connexion->beginTransaction();
        $requete = $this->connexion->prepare("UPDATE facture 
            SET 
                maisonId=:maisonId, 
                numeroFacture=:numeroFacture, 
                date_debut=:date_debut, 
                date_fin=:date_fin,
                cout_kwh_jusqua_40kw_par_jour=:cout_kwh_jusqua_40kw_par_jour,
                cout_kwh_apres_40kw_par_jour=:cout_kwh_apres_40kw_par_jour,
                frais_access_reseau_par_jour=:frais_access_reseau_par_jour,
                total_sans_taxe=:total_sans_taxe,
                WHERE id=:id");
        $requete->bindValue(":maisonId", $facture->getMaisonId());
        $requete->bindValue(":numeroFacture", $facture->getNumeroFacture());
        $requete->bindValue(":date_debut", $facture->getDateDebut());
        $requete->bindValue(":date_fin", $facture->getDateFin());
        $requete->bindValue(":cout_kwh_jusqua_40kw_par_jour", $facture->getCoutKWHJusqua40kwParJour());
        $requete->bindValue(":cout_kwh_apres_40kw_par_jour", $facture->getCoutKWHApres40kwParJour());
        $requete->bindValue(":frais_access_reseau_par_jour", $facture->getFraisAccessReseauParJour());
        $requete->bindValue(":total_sans_taxe", $facture->getTotalSansTaxe());
        $requete->bindValue(":id", $facture->getId());
        $requete->execute();
        $succes = $requete->rowCount() != 0;
        $this->connexion->commit();
        return $succes;
    }


    /**
     * @param string $id L'id de la facture à supprimer en BD.
     * @return bool Vrai si la suppression a été effectuée. Faux dans le cas contraire.
     */
    public function delete($id): bool
    {
        $this->connexion->beginTransaction();
        $requete = $this->connexion->prepare("DELETE FROM facture WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();
        $succes = $requete->rowCount() != 0;
        $this->connexion->commit();
        return $succes;
    }
}
