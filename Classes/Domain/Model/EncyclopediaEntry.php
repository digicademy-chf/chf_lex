<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\Validate;

defined('TYPO3') or die();

/**
 * Model for EncyclopediaEntry
 */
class EncyclopediaEntry extends AbstractEntry
{
    /**
     * Heading of the encyclopedia entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $title = '';

    /**
     * Construct object
     *
     * @param string $title
     * @param LexicographicResource $parentResource
     * @param string $uuid
     * @return EncyclopediaEntry
     */
    public function __construct(string $title, LexicographicResource $parentResource, string $uuid)
    {
        parent::__construct($parentResource, $uuid);

        $this->setTitle($title);
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
