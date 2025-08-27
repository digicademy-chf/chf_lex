<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractTag;

defined('TYPO3') or die();

/**
 * Model for TranscriptionSchemeTag
 */
class TranscriptionSchemeTag extends AbstractTag
{
    /**
     * Construct object
     *
     * @param string $text
     * @return TranscriptionSchemeTag
     */
    public function __construct(string $text)
    {
        parent::__construct($text);

        $this->setType('transcriptionSchemeTag');
    }
}
