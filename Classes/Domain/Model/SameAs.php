<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Model for same as
 */
class SameAs extends AbstractEntity
{
    /**
     * External web address to identify an entity across the web
     * 
     * @var string
     */
    protected string $uri = '';

    /**
     * Get URI
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Set URI
     *
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }
}

?>