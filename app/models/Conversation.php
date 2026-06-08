<?php

/**
 * Entité Conversation
 */
 class Conversation extends AbstractEntity 
 {
    private int $user1Id;
    private int $user2Id;
    private array $messages = [];
    private User $user1;
    private User $user2;

    /**
     * Get the value of user1Id
     *
     * @return int
     */
    public function getUser1Id(): int
    {
        return $this->user1Id;
    }

    /**
     * Set the value of user1Id
     *
     * @param int $user1Id
     *
     * @return self
     */
    public function setUser1Id(int $user1Id): self
    {
        $this->user1Id = $user1Id;

        return $this;
    }

    /**
     * Get the value of user2Id
     *
     * @return int
     */
    public function getUser2Id(): int
    {
        return $this->user2Id;
    }

    /**
     * Set the value of user2Id
     *
     * @param int $user2Id
     *
     * @return self
     */
    public function setUser2Id(int $user2Id): self
    {
        $this->user2Id = $user2Id;

        return $this;
    }

    /**
     * Get the value of messages
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * Set the value of messages
     *
     * @param array $messages
     *
     * @return self
     */
    public function setMessages(array $messages): self
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * Get the value of user1
     *
     * @return User
     */
    public function getUser1(): User
    {
        return $this->user1;
    }

    /**
     * Set the value of user1
     *
     * @param User $user1
     *
     * @return self
     */
    public function setUser1(User $user1): self
    {
        $this->user1 = $user1;

        return $this;
    }

    /**
     * Get the value of user2
     *
     * @return User
     */
    public function getUser2(): User
    {
        return $this->user2;
    }

    /**
     * Set the value of user2
     *
     * @param User $user2
     *
     * @return self
     */
    public function setUser2(User $user2): self
    {
        $this->user2 = $user2;

        return $this;
    }
}