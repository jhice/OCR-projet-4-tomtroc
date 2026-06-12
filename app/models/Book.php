<?php

/**
 * Entité Book (livre)
 */
 class Book extends AbstractEntity 
 {
    private string $title = "";
    private string $author = "";
    private string $comment = "";
    private bool $available = true;
    private ?string $photo = "";
    private int $userId;
    // permet d'associer l'objet directement (voir BookManager)
    private User $user;

    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of author
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param string $author
     *
     * @return self
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }
    
    /**
     * Get the value of comment
     *
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @param string $comment
     *
     * @return self
     */
    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of available
     *
     * @return bool
     */
    public function getAvailable(): bool
    {
        return $this->available;
    }

    /**
     * Set the value of available
     *
     * @param bool $available
     *
     * @return self
     */
    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    /**
     * Get the value of photo
     *
     * @return string
     */
    public function getPhoto(): ?string
    {
        if (empty($this->photo)) {
            return "_default.jpg";
        }
        
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @param string $photo
     *
     * @return self
     */
    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of userId
     *
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @param int $userId
     *
     * @return self
     */
    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of user
     *
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param User $user
     *
     * @return self
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}