<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Model for content
 */
class Content extends AbstractEntity
{
    /**
     * Name of the content element
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $header = '';

    /**
     * Body text of the content element
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $bodytext = '';

    /**
     * Construct object
     *
     * @param string $header
     * @param string $bodytext
     * @return Content
     */
    public function __construct(string $header, string $bodytext)
    {
        $this->setHeader($header);
        $this->setBodytext($bodytext);
    }

    /**
     * Get header
     *
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }

    /**
     * Set header
     *
     * @param string $header
     */
    public function setHeader(string $header): void
    {
        $this->header = $header;
    }

    /**
     * Get bodytext
     *
     * @return string
     */
    public function getbodytext(): string
    {
        return $this->bodytext;
    }

    /**
     * Set bodytext
     *
     * @param string $bodytext
     */
    public function setBodytext(string $bodytext): void
    {
        $this->bodytext = $bodytext;
    }
}

?>