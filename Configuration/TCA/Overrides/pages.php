<?php

# TCA Overrides for the Pages Table
# Copyright (c) 2023 Jonatan Jalle Steller <jonatan.steller@adwmainz.de>
#
# All rights reserved
#
# This script is part of the TYPO3 project. The TYPO3 project is
# free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 3 of the License, or
# (at your option) any later version.
#
# The GNU General Public License can be found at
# http://www.gnu.org/copyleft/gpl.html.
#
# This script is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# This copyright notice MUST APPEAR in all copies of the script!


// Add overrides for this extension and table
( function( $extKey='da_lex', $table='pages' ) {
    $lexDictionaryDoktype = 150;
    $lexEncyclopediaDoktype = 151;
    $lexGlossaryDoktype = 152;

    // Dictionary entry: add page type (doktype) as possible select item
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        $table,
        'doktype',
        [
            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang.xlf:doktypes.dictionaryEntry',
            $lexDictionaryDoktype,
            'EXT:' . $extKey . '/Resources/Public/Icons/doktype-dictionary-entry.svg'
        ],
        '1',
        'after'
    );

    // Encyclopedia entry: add page type (doktype) as possible select item
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        $table,
        'doktype',
        [
            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang.xlf:doktypes.encyclopediaEntry',
            $lexEncyclopediaDoktype,
            'EXT:' . $extKey . '/Resources/Public/Icons/doktype-encyclopedia-entry.svg'
        ],
        '1',
        'after'
    );

    // Glossary entry: add page type (doktype) as possible select item
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        $table,
        'doktype',
        [
            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang.xlf:doktypes.glossaryEntry',
            $lexGlossaryDoktype,
            'EXT:' . $extKey . '/Resources/Public/Icons/doktype-glossary-entry.svg'
        ],
        '1',
        'after'
    );

    // Add TCA config for the page types (doktypes)
    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA'][$table],
        [

            // Add icon for page types (doktypes), no extra variants for -contentFromPid, -root, and -hideinmenu
            'ctrl' => [
                'typeicon_classes' => [
                    $lexDictionaryDoktype => 'apps-pagetree-dictionaryEntry',
                    $lexEncyclopediaDoktype => 'apps-pagetree-encyclopediaEntry',
                    $lexGlossaryDoktype => 'apps-pagetree-glossaryEntry'
                ]
            ],

            // Add all page standard fields and tabs to the page types (doktypes)
            'types' => [
                $lexDictionaryDoktype => [
                    'showitem' => $GLOBALS['TCA'][$table]['types'][\TYPO3\CMS\Core\Domain\Repository\PageRepository::DOKTYPE_DEFAULT]['showitem']
                ],
                $lexEncyclopediaDoktype => [
                    'showitem' => $GLOBALS['TCA'][$table]['types'][\TYPO3\CMS\Core\Domain\Repository\PageRepository::DOKTYPE_DEFAULT]['showitem']
                ],
                $lexGlossaryDoktype => [
                    'showitem' => $GLOBALS['TCA'][$table]['types'][\TYPO3\CMS\Core\Domain\Repository\PageRepository::DOKTYPE_DEFAULT]['showitem']
                ]
            ]
        ]
    );
} )();

?>
