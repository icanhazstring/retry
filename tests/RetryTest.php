<?php

declare(strict_types=1);

namespace icanhazstring\Retry\Test;

use LogicException;
use PHPUnit\Framework\TestCase;

use function icanhaztring\Retry\retry;

/**
 * @covers \icanhaztring\Retry\retry()
 */
final class RetryTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCallTheCallbackAtLeastOnce(): void
    {
        $calls = 0;

        retry(
            function () use (&$calls) {
                ++$calls;
            }
        );

        self::assertGreaterThanOrEqual(1, $calls);
    }

    /**
     * @test
     */
    public function itShouldRetryTwice(): void
    {
        $calls = 2;

        $value = retry(
            function () use (&$calls) {
                if ($calls > 0) {
                    --$calls;
                    throw new LogicException('stop');
                }

                return 1;
            },
            $calls
        );

        self::assertSame(0, $calls);
        self::assertSame(1, $value);
    }

}
