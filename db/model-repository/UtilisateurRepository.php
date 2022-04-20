<?php

class UtilisateurRepository extends ModelRepository
{

    public function selectAll(): array
    {
        $requete = $this->connexion->prepare("SELECT * FROM utilisateur");
        $requete->execute();

        $utilisateurs = array();
        while ($record = $requete->fetch())
            $utilisateurs[] = $this->constructUtilisateurFromRecord($record);

        return $utilisateurs;
    }


    /**
     * @param string $id L'identifant unique de l'utilisateur à sélectionner.
     * @return Utilisateur L'utilisateur si trouvé, sinon null.
     */
    public function select($id): ?Utilisateur
    {
        $requete = $this->connexion->prepare("SELECT * FROM utilisateur WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();

        $utilisateur = null;
        if ($record = $requete->fetch())
            $utilisateur = $this->constructUtilisateurFromRecord($record);

        return $utilisateur;
    }

        /**
     * @param string $id L'identifant unique de l'utilisateur à sélectionner.
     * @return Utilisateur L'utilisateur si trouvé, sinon null.
     */
    public function selectUtilisateur($username): ?Utilisateur
    {
        $password = "";
        $requete = $this->connexion->prepare("SELECT * FROM utilisateur WHERE username=:username");
        $requete->bindValue(":username", $username);
        $requete->execute();

        $utilisateur = null;
        if ($record = $requete->fetch())
        {
            $utilisateur = $this->constructUtilisateurFromRecord($record);
        }

        return $utilisateur;
    }

    /**
     * @param Tag $tag Le tag à insérer en BD. Un nouvel id sera affecté à l'objet.
     * @return int Le nouvel id du tag. 0 si l'insertion ne se produit pas. 
     */
    public function insert(Utilisateur $utilisateur): int
    {
        $this->connexion->beginTransaction();

        $requete = $this->connexion->prepare("INSERT INTO utilisateur(username, courriel, password) VALUE(:username, :courriel, :password)");
        $requete->bindValue(":username", $utilisateur->getUsername());
        $requete->bindValue(":courriel", $utilisateur->getCourriel());
        $requete->bindValue(":password", $utilisateur->getPassword());
        $requete->execute();

        $id = $this->connexion->lastInsertId();

        $this->connexion->commit();

        $utilisateur->setId($id);
        return $id;
    }

    /**
     * @param Utilisateur $utilisateur Le tag à mettre à jour en BD.
     * @return bool Vrai si la mise à jour a été effectuée. Faux dans le cas contraire.
     */
    public function update(Utilisateur $utilisateur): bool
    {
        $this->connexion->beginTransaction();
        $requete = $this->connexion->prepare("UPDATE utilisateur SET username=:username, courriel=:courriel, password=:password WHERE id=:id");
        $requete->bindValue(":username", $utilisateur->getUsername());
        $requete->bindValue(":courriel", $utilisateur->getCourriel());
        $requete->bindValue(":password", $utilisateur->getPassword());
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
        $requete = $this->connexion->prepare("DELETE FROM utilisateur WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();
        $succes = $requete->rowCount() != 0;
        $this->connexion->commit();
        return $succes;
    }

    private function constructUtilisateurFromRecord($record): ?Utilisateur
    {
        return new Utilisateur(
            $record['username'],
            $record['courriel'],
            $record['password'],
            $record['id']
        );
    }

 
}
