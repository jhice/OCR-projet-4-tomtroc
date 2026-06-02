<?php

/**
 * Entité User
 */
 class User extends AbstractEntity 
 {
    private string $login = "";
    private string $password = "";
    private string $nickname = "";
    private string $avatar = "";

    /**
     * Get the value of login
     *
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @param string $login
     *
     * @return self
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of nickname
     *
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * Set the value of nickname
     *
     * @param string $nickname
     *
     * @return self
     */
    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get the value of avatar
     *
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @param string $avatar
     *
     * @return self
     */
    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}