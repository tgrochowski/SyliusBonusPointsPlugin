<?php

declare(strict_types=1);

namespace BitBag\SyliusBonusPointsPlugin\Entity;

use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;

class BonusPoints implements BonusPointsInterface
{
    use TimestampableTrait;

    /** @var int */
    protected $id;

    /** @var OrderInterface */
    protected $order;

    /** @var int */
    protected $points;

    /** @var bool */
    protected $isUsed = false;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrder(): ?OrderInterface
    {
        return $this->order;
    }

    public function setOrder(?OrderInterface $order): void
    {
        $this->order = $order;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): void
    {
        $this->points = $points;
    }

    public function isUsed(): bool
    {
        return $this->isUsed;
    }

    public function setIsUsed(bool $isUsed): void
    {
        $this->isUsed = $isUsed;
    }
}
