<?php

//require_once 'model/Appareil.php';
//require_once 'ModelRepository.php';

class AppareilRepository extends ModelRepository
{
    public function selectAll(): array
    {
        $requete = $this->connexion->prepare("SELECT * FROM appareil");
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

    public function select($id): ?Appareil
    {
        $requete = $this->connexion->prepare("SELECT * FROM appareil WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();

        $appareil = null;
        if ($record = $requete->fetch())
        {
            $appareil = new Appareil($record['name'], $record['kilowatts_heure'],  $record['id']);
        }

        return $appareil;
    }

    public function insert(Appareil $appareil): int
    {
        $this->connexion->beginTransaction();

        $requete = $this->connexion->prepare("INSERT INTO appareil(name,kilowatts_heure) " . "VALUE(:name, :kilowatts_heure)");
        $requete->bindValue(":name", $appareil->getName());
        $requete->bindValue(":kilowatts_heure", $appareil->getKilowattsHeure());
        $requete->execute();

        $id = $this->connexion->lastInsertId();

        $this->connexion->commit();

        $appareil->setId($id);
        return $id;
    }

    /**
     * @param Appareil $apparreil Le tag à mettre à jour en BD.
     * @return bool Vrai si la mise à jour a été effectuée. Faux dans le cas contraire.
     */
    public function update(Appareil $appareil): bool
    {
        $this->connexion->beginTransaction();
        $requete = $this->connexion->prepare("UPDATE appareil SET name=:name, kilowatts_heure=:kilowatts_heure WHERE id=:id");
        $requete->bindValue(":name", $appareil->getName());
        $requete->bindValue(":kilowatts_heure", $appareil->getKilowattsHeure());
        $requete->bindValue(":id", $appareil->getId());
        $requete->execute();
        $succes = $requete->rowCount() != 0;
        $this->connexion->commit();
        return $succes;
    }


    /**
     * @param string $id L'id du appareil à supprimer en BD.
     * @return bool Vrai si la suppression a été effectuée. Faux dans le cas contraire.
     */
    public function delete($id): bool
    {
        $this->connexion->beginTransaction();
        $requete = $this->connexion->prepare("DELETE FROM appareil WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();
        $succes = $requete->rowCount() != 0;
        $this->connexion->commit();
        return $succes;
    }
}
