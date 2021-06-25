<?php

declare(strict_types=1);

namespace icanhaztring\Retry;

use Throwable;

/**
 * @throws Throwable Rethrows the base exception that was causing the retry to happen in the first place.
 */
function retry(callable $callable, int $retries = 1, int $sleepInMilliseconds = 0): mixed
{
    try {
        return $callable();
    } catch(Throwable $throwable) {
        if ($retries > 0) {
            if ($sleepInMilliseconds > 0) {
                usleep($sleepInMilliseconds * 1000);
            }

            return retry($callable, $retries-1, $sleepInMilliseconds);
        }

        throw $throwable;
    }
}
