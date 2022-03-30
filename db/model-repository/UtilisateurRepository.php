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
     * @param Tag $tag Le tag à insérer en BD. Un nouvel id sera affecté à l'objet.
     * @return int Le nouvel id du tag. 0 si l'insertion ne se produit pas. 
     */
    public function insert(Utilisateur $utilisateur) : int
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
