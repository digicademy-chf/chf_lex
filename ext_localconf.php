<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use Digicademy\CHFLex\Controller\DictionaryEntryController;
use Digicademy\CHFLex\Controller\EncyclopediaEntryController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Rich-text editor customisations
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets'] += [
    'chf_lex_annotation' => 'EXT:chf_lex/Configuration/RTE/CHFLexAnnotation.yaml',
];

// Register 'LexDictionary' content element
ExtensionUtility::configurePlugin(
    'CHFLex',
    'LexDictionary',
    [
        DictionaryEntryController::class => 'index',
        DictionaryEntryController::class => 'show',
    ],
);

// Register 'LexEncyclopedia' content element
ExtensionUtility::configurePlugin(
    'CHFLex',
    'LexEncyclopedia',
    [
        EncyclopediaEntryController::class => 'index',
        EncyclopediaEntryController::class => 'show',
    ],
);

