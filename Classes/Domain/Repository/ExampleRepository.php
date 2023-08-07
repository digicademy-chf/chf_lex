<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DALex\Domain\Repository;

use Digicademy\DALex\Domain\Model\Example;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for examples
 * 
 * @extends Repository<Example>
 */
class ExampleRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting'       => QueryInterface::ORDER_ASCENDING,
        'text'          => QueryInterface::ORDER_ASCENDING,
        'dateCirca'     => QueryInterface::ORDER_ASCENDING,
        'locationLabel' => QueryInterface::ORDER_ASCENDING,
    ];
}

?>