<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractTag;
use TYPO3\CMS\Extbase\Annotation\Validate;

defined('TYPO3') or die();

/**
 * Model for InflectionTypeTag
 */
class InflectionTypeTag extends AbstractTag
{
    /**
     * Constraints and recommendations on where this inflection type may apply
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $for = '';

    /**
     * Construct object
     *
     * @param string $text
     * @return InflectionTypeTag
     */
    public function __construct(string $text)
    {
        parent::__construct($text);

        $this->setType('inflectionTypeTag');
    }

    /**
     * Get for
     *
     * @return string
     */
    public function getFor(): string
    {
        return $this->for;
    }

    /**
     * Set for
     *
     * @param string $for
     */
    public function setFor(string $for): void
    {
        $this->for = $for;
    }
}
