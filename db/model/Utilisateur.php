<?php

class Utilisateur
{
    private int $id;
    private string $username;
    private string $courriel;
    private string $password;


    public function __construct(string $username, string $courriel, string $password, int $id = 0)
    {
        $this->setId($id);
        $this->setUsername($username);
        $this->setCourriel($courriel);
        $this->setPassword($password);
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
     * Get the value of username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername(string $username): self
    {
        $username = trim($username);
        if (strlen($username) > 50 || empty($username))
            throw new Exception("Le username '$username' doit être >= 1 ET <= 50.");
        $this->username = $username;
        return $this;
    }

    /**
     * Get the value of courriel
     *
     * @return string
     */
    public function getCourriel(): string
    {
        return $this->courriel;
    }

    /**
     * Set the value of courriel
     *
     * @param string $courriel
     *
     * @return self
     */
    public function setCourriel(string $courriel): self
    {
        $courriel = trim($courriel);
        if (!filter_var($courriel, FILTER_VALIDATE_EMAIL) || strlen($courriel) > 255)
            throw new Exception("Le courriel '$courriel' n'est pas de format valide.");
        $this->courriel = $courriel;
        return $this;
    }

    /**
     * Get the value of hash
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of hash
     *
     * @param string $hash
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $password = trim($password);
        if (strlen($password) < 4)
            throw new Exception("Le password doit avoir un longueur de 6 ou plus ");
        $this->password = $password;
        return $this;
    }
}
