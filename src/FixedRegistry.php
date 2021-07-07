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

/**
 * Class FixedRegistry.
 */
final class FixedRegistry extends FileRegistry
{
    public function __construct()
    {
        parent::__construct(__DIR__.'/../mime.types');
    }
}
