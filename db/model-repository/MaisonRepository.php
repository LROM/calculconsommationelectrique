<?php

//require_once 'model/Appareil.php';
//require_once 'ModelRepository.php';

class MaisonRepository extends ModelRepository
{
    public function selectAll(): array
    {
        $requete = $this->connexion->prepare("SELECT * FROM maison");
        $requete->execute();

        $maisons = array();
        while ($record = $requete->fetch())
        {
            $maison = new Maison($record['address'], $record['postal_code'], $record['utilisateur_id'], $record['id']);
            $maisons[] = $maison;

        }
        //$appareils[] = $this->constructAppareilFromRecord($record);

        return $maisons;
    }

    public function select($id): ?Maison
    {
        $requete = $this->connexion->prepare("SELECT * FROM maison WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();

        $appareil = null;
        if ($record = $requete->fetch())
        {
            $maison = new Maison($record['address'], $record['postal_code'], $record['utilisateur_id'], $record['id']);
        }

        return $maison;
    }

    public function insert(Maison $maison): int
    {
        $this->connexion->beginTransaction();

        $requete = $this->connexion->prepare("INSERT INTO maison(address, postal_code, utilisateur_id) VALUE(:address, :postal_code, :utilisateur_id)");
        $requete->bindValue(":address", $maison->getAddress());
        $requete->bindValue(":postal_code", $maison->getCodePostal());
        $requete->bindValue(":utilisateur_id", $maison->getUtilisateurId());
        $requete->execute();

        $id = $this->connexion->lastInsertId();

        $this->connexion->commit();

        $maison->setId($id);
        return $id;
    }

    /**
     * @param Maison $maison La maison à mettre à jour en BD.
     * @return bool Vrai si la mise à jour a été effectuée. Faux dans le cas contraire.
     */
    public function update(Maison $maison): bool
    {
        $this->connexion->beginTransaction();
        $requete = $this->connexion->prepare("UPDATE appareil SET address=:address, postal_code=:postal_code, utilisateur_id=:utilisateur_id WHERE id=:id");
        $requete->bindValue(":address", $maison->getAddress());
        $requete->bindValue(":postal_code", $maison->getCodePostal());
        $requete->bindValue(":utilisateur_id", $maison->getUtilisateurId());
        $requete->bindValue(":id", $maison->getId());
        $requete->execute();
        $succes = $requete->rowCount() != 0;
        $this->connexion->commit();
        return $succes;
    }


    /**
     * @param string $id L'id de la maison à supprimer en BD.
     * @return bool Vrai si la suppression a été effectuée. Faux dans le cas contraire.
     */
    public function delete($id): bool
    {
        $this->connexion->beginTransaction();
        $requete = $this->connexion->prepare("DELETE FROM maison WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();
        $succes = $requete->rowCount() != 0;
        $this->connexion->commit();
        return $succes;
    }

    public function selectAllUtilisateurId($utilisaeur_id): array
    {
        $requete = $this->connexion->prepare("SELECT * FROM maison WHERE utilisateur_id=:utilisateur_id");
        $requete->bindValue(":utilisateur_id", $utilisaeur_id);
        $requete->execute();

        $maisons = array();
        while ($record = $requete->fetch())
        {
            $maison = new Maison($record['address'], $record['postal_code'], $record['utilisateur_id'], $record['id']);
            $maisons[] = $maison;
        }
        //$appareils[] = $this->constructAppareilFromRecord($record);

        return $maisons;
    }


}
