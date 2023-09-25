<?php

declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFLex\Domain\Repository;

use Digicademy\CHFLex\Domain\Model\Contributor;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for contributors
 * 
 * @extends Repository<Contributor>
 */
class ContributorRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting'       => QueryInterface::ORDER_ASCENDING,
        'surname'       => QueryInterface::ORDER_ASCENDING,
        'forename'      => QueryInterface::ORDER_ASCENDING,
        'corporateName' => QueryInterface::ORDER_ASCENDING,
    ];
}

?>