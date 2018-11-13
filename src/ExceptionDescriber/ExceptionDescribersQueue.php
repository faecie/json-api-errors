<?php

declare(strict_types=1);

namespace Faecie\Bundle\JsonApiErrorsBundle\ExceptionDescriber;

use Throwable;

class ExceptionDescribersQueue implements ExceptionDescriberInterface
{
    private $describersQueue;

    /**
     * @param ExceptionDescriberInterface[] $describersQueue
     */
    public function __construct(array $describersQueue)
    {
        $this->describersQueue = $describersQueue;
    }

    public function extractErrors(Throwable $exception): array
    {
        foreach ($this->describersQueue as $describer) {
            $result = $describer->extractErrors($exception);

            if ($result) {
                return $result;
            }
        }

        return [];
    }
}