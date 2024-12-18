<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Repository;

use Digicademy\CHFBase\Domain\Repository\Traits\StoragePageAgnosticTrait;
use Digicademy\CHFLex\Domain\Model\Sense;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

defined('TYPO3') or die();

/**
 * Repository for Sense
 * 
 * @extends Repository<Sense>
 */
class SenseRepository extends Repository
{
    use StoragePageAgnosticTrait;

    protected $defaultOrderings = [
        'sorting'   => QueryInterface::ORDER_ASCENDING,
        'indicator' => QueryInterface::ORDER_ASCENDING,
    ];
}
