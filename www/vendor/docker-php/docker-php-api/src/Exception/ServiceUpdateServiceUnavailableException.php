<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Docker\API\Exception;

class ServiceUpdateServiceUnavailableException extends \RuntimeException implements ServerException
{
    private $errorResponse;

    public function __construct(\Docker\API\Model\ErrorResponse $errorResponse)
    {
        parent::__construct('node is not part of a swarm', 503);
        $this->errorResponse = $errorResponse;
    }

    public function getErrorResponse()
    {
        return $this->errorResponse;
    }
}
