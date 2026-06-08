<?php

/**
 * Entité Message
 */
 class Message extends AbstractEntity 
 {
    private int $conversationId;
    private int $senderId;
    private int $receiverId;
    private string $content;
    private bool $isRead;
    private DateTime $createdAt;

    /**
     * Get the value of conversationId
     *
     * @return int
     */
    public function getConversationId(): int
    {
        return $this->conversationId;
    }

    /**
     * Set the value of conversationId
     *
     * @param int $conversationId
     *
     * @return self
     */
    public function setConversationId(int $conversationId): self
    {
        $this->conversationId = $conversationId;

        return $this;
    }

    /**
     * Get the value of senderId
     *
     * @return int
     */
    public function getSenderId(): int
    {
        return $this->senderId;
    }

    /**
     * Set the value of senderId
     *
     * @param int $senderId
     *
     * @return self
     */
    public function setSenderId(int $senderId): self
    {
        $this->senderId = $senderId;

        return $this;
    }

    /**
     * Get the value of receiverId
     *
     * @return int
     */
    public function getReceiverId(): int
    {
        return $this->receiverId;
    }

    /**
     * Set the value of receiverId
     *
     * @param int $receiverId
     *
     * @return self
     */
    public function setReceiverId(int $receiverId): self
    {
        $this->receiverId = $receiverId;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of isRead
     *
     * @return bool
     */
    public function getIsRead(): bool
    {
        return $this->isRead;
    }

    /**
     * Set the value of isRead
     *
     * @param bool $isRead
     *
     * @return self
     */
    public function setIsRead(bool $isRead): self
    {
        $this->isRead = $isRead;

        return $this;
    }

    /**
     * Get the value of createdAt
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(string|DateTime $createdAt, string $format = 'Y-m-d H:i:s'): self
    {
        if (is_string($createdAt)) {
            $createdAt = DateTime::createFromFormat($format, $createdAt);
        }

        $this->createdAt = $createdAt;

        return $this;
    }
}