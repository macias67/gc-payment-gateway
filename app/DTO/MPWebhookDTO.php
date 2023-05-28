<?php

namespace App\DTO;

class MPWebhookDTO
{
    private string $action;
    private string $apiVersion;
    private int $paymentId;
    private string $dateCreated;
    private int $id;
    private bool $liveMode;
    private string $type;
    private string $userId;

    public function __construct(array $data)
    {
        $this->action = $data['action'];
        $this->apiVersion = $data['api_version'];
        $this->paymentId = $data['data']['id'];
        $this->dateCreated = $data['date_created'];
        $this->id = $data['id'];
        $this->liveMode = $data['live_mode'];
        $this->type = $data['type'];
        $this->userId = $data['user_id'];
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     * @return void
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * @param string $apiVersion
     * @return void
     */
    public function setApiVersion(string $apiVersion): void
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * @return int
     */
    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    /**
     * @param int $paymentId
     * @return void
     */
    public function setPaymentId(int $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    /**
     * @return string
     */
    public function getDateCreated(): string
    {
        return $this->dateCreated;
    }

    /**
     * @param string $dateCreated
     * @return void
     */
    public function setDateCreated(string $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isLiveMode(): bool
    {
        return $this->liveMode;
    }

    /**
     * @param bool $liveMode
     * @return void
     */
    public function setLiveMode(bool $liveMode): void
    {
        $this->liveMode = $liveMode;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return void
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }
}
