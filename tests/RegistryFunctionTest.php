<?php

declare(strict_types=1);

/**
 * @project Castor Mime
 * @link https://github.com/castor-labs/mime
 * @package castor/mime
 * @author Matias Navarro-Carter mnavarrocarter@gmail.com
 * @license MIT
 * @copyright 2021 CastorLabs Ltd
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Castor\Mime;

use PHPUnit\Framework\TestCase;

/**
 * Class RegistryFunctionTest.
 *
 * @internal
 * @coversNothing
 */
class RegistryFunctionTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testItReturnsDefaultInstanceInConsecutiveCalls(): void
    {
        $registry = registry();
        $registry2 = registry();
        self::assertSame($registry, $registry2);
        self::assertInstanceOf(FixedRegistry::class, $registry);
    }

    /**
     * @runInSeparateProcess
     */
    public function testItReturnsSameInstanceWithDefault(): void
    {
        $stub = $this->createStub(Registry::class);
        $registry = registry($stub);
        $registry2 = registry();
        self::assertSame($stub, $registry);
        self::assertSame($stub, $registry2);
    }

    /**
     * @runInSeparateProcess
     */
    public function testItCannotBeChangedAfterFirstCall(): void
    {
        $stub = $this->createStub(Registry::class);
        $registry = registry();
        $registry2 = registry($stub);
        self::assertNotSame($stub, $registry);
        self::assertNotSame($stub, $registry2);
        self::assertSame($registry, $registry2);
    }
}
