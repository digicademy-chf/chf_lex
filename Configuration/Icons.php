<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

defined('TYPO3') or die();

// Extension-provided icons
return [
    'tx-chflex' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/Extension.svg',
    ],
    'tx-chflex-table-definition' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/TableDefinition.svg',
    ],
    'tx-chflex-table-dictionary-entry' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/TableDictionaryEntry.svg',
    ],
    'tx-chflex-table-encyclopedia-entry' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/TableEncyclopediaEntry.svg',
    ],
    'tx-chflex-table-example' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/TableExample.svg',
    ],
    'tx-chflex-table-frequency' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/TableFrequency.svg',
    ],
    'tx-chflex-table-inflected-form' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/TableInflectedForm.svg',
    ],
    'tx-chflex-table-member' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/TableMember.svg',
    ],
    'tx-chflex-table-pronunciation' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/TablePronunciation.svg',
    ],
    'tx-chflex-table-sense' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/TableSense.svg',
    ],
    'tx-chflex-table-transcription' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/TableTranscription.svg',
    ],
    'tx-chflex-plugin-dictionary' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/PluginDictionary.svg',
    ],
    'tx-chflex-plugin-encyclopedia' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_lex/Resources/Public/Icons/PluginEncyclopedia.svg',
    ],
];
