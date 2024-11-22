<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Repository;

use Digicademy\CHFBase\Domain\Repository\Traits\StoragePageAgnosticTrait;
use Digicademy\CHFLex\Domain\Model\EncyclopediaEntry;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

defined('TYPO3') or die();

/**
 * Repository for EncyclopediaEntry
 * 
 * @extends Repository<EncyclopediaEntry>
 */
class EncyclopediaEntryRepository extends Repository
{
    use StoragePageAgnosticTrait;

    protected $defaultOrderings = [
        'sorting'     => QueryInterface::ORDER_ASCENDING,
        'isHighlight' => QueryInterface::ORDER_ASCENDING,
        'title'       => QueryInterface::ORDER_ASCENDING,
    ];
}
