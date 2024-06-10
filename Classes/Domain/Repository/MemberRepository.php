<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Repository;

use Digicademy\CHFLex\Domain\Model\Member;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

defined('TYPO3') or die();

/**
 * Repository for Member
 * 
 * @extends Repository<Member>
 */
class MemberRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting' => QueryInterface::ORDER_ASCENDING,
        'ref'     => QueryInterface::ORDER_ASCENDING,
    ];
}
