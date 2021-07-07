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
 * Class FileRegistry.
 */
abstract class FileRegistry implements Registry
{
    private string $filename;
    private array $extensions;
    private array $mimeTypes;
    private bool $parsed;

    /**
     * FileRegistry constructor.
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->extensions = [];
        $this->mimeTypes = [];
        $this->parsed = false;
    }

    /**
     * @param string ...$extensions
     */
    public function register(string $mimeType, string ...$extensions): void
    {
        $this->mimeTypes[$mimeType] = $extensions;
        foreach ($extensions as $extension) {
            $this->extensions[$extension] = $mimeType;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getExtensions(string $mimeType): array
    {
        $this->parse();

        return $this->mimeTypes[$mimeType] ?? [];
    }

    /**
     * {@inheritDoc}
     */
    public function getExtension(string $mimeType): ?string
    {
        $this->parse();

        return $this->getExtensions($mimeType)[0] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function getMimeType(string $extension): ?string
    {
        $this->parse();

        return $this->extensions[$extension] ?? null;
    }

    private function parse(): void
    {
        if ($this->parsed) {
            return;
        }
        if (!is_file($this->filename) || !is_readable($this->filename)) {
            throw new \RuntimeException(sprintf('The file "%s" does not exist or is not readable', $this->filename));
        }
        $steam = fopen($this->filename, 'rb');
        while (!feof($steam)) {
            $line = fgets($steam);
            if (!is_string($line)) {
                continue;
            }
            $line = trim($line, "\r\n");
            if ('' === $line || 0 === strpos($line, '#')) {
                continue;
            }
            // Normalize tab characters
            $line = preg_replace('/\s+/', ' ', $line);
            $parts = explode(' ', $line);
            $mime = array_shift($parts);
            $this->register($mime, ...$parts);
        }
        $this->parsed = true;
    }
}
