<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Model for content
 */
class Content extends AbstractEntity
{
    /**
     * Whether the record should be visisible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = false;

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
     * Get hidden
     *
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Set hidden
     *
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
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
