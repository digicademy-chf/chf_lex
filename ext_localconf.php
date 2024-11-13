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

// Register 'Dictionary' content element
ExtensionUtility::configurePlugin(
    'CHFLex',
    'Dictionary',
    [
        DictionaryEntryController::class => 'index, show',
    ],
    [], // None of the actions are non-cacheable
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

// Register 'Encyclopedia' content element
ExtensionUtility::configurePlugin(
    'CHFLex',
    'Encyclopedia',
    [
        EncyclopediaEntryController::class => 'index, show',
    ],
    [], // None of the actions are non-cacheable
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
