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
 * Returns the global Mime Registry being used.
 *
 * On the first call to this function, you have the option of setting a custom
 * registry instance.
 */
function registry(Registry $registry = null): Registry
{
    static $innerRegistry;
    if (null === $innerRegistry) {
        $innerRegistry = $registry ?? new FixedRegistry();
    }

    return $innerRegistry;
}
