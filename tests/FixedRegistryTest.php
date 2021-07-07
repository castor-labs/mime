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
 * Class FixedRegistryTest.
 *
 * @internal
 * @coversNothing
 */
class FixedRegistryTest extends TestCase
{
    public function testItGetsMimeType(): void
    {
        $registry = new FixedRegistry();
        self::assertSame('application/pdf', $registry->getMimeType('pdf'));
    }

    public function getExtension(): void
    {
        $registry = new FixedRegistry();
        self::assertSame('docx', $registry->getExtension('application/vnd.openxmlformats-officedocument.wordprocessingml.document'));
    }
}
