<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Docker\API\Model;

class SwarmSpecDispatcher
{
    /**
     * The delay for an agent to send a heartbeat to the dispatcher.
     *
     * @var int
     */
    protected $heartbeatPeriod;

    /**
     * The delay for an agent to send a heartbeat to the dispatcher.
     *
     * @return int
     */
    public function getHeartbeatPeriod(): ?int
    {
        return $this->heartbeatPeriod;
    }

    /**
     * The delay for an agent to send a heartbeat to the dispatcher.
     *
     * @param int $heartbeatPeriod
     *
     * @return self
     */
    public function setHeartbeatPeriod(?int $heartbeatPeriod): self
    {
        $this->heartbeatPeriod = $heartbeatPeriod;

        return $this;
    }
}