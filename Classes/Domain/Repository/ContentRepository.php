<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Repository;

use Digicademy\DALex\Domain\Model\Content;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for content
 * 
 * @extends Repository<Content>
 */
class ContentRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting'  => QueryInterface::ORDER_ASCENDING,
        'header'   => QueryInterface::ORDER_ASCENDING,
        'bodytext' => QueryInterface::ORDER_ASCENDING,
    ];
}

?>