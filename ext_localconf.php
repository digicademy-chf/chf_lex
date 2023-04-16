<?php

# Extended Configuration of Globals
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


// Use statements
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Prevent Script from being called directly
defined( 'TYPO3' ) or die();

// Register content for this extension
( function( $extKey='da_lex' ) {
    $lexDictionaryDoktype = 150;
    $lexEncyclopediaDoktype = 151;
    $lexGlossaryDoktype = 152;

    // Register doktype icon for dictionary entry to be used in the page tree
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance( \TYPO3\CMS\Core\Imaging\IconRegistry::class );
    $iconRegistry
        ->registerIcon(
            'apps-pagetree-dictionaryEntry',
            TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            [
                'source' => 'EXT:' . $extKey . '/Resources/Public/Icons/doktype-dictionary-entry.svg',
            ]
        );

    // Register doktype icon for encyclopedia entry to be used in the page tree
    $iconRegistry
        ->registerIcon(
            'apps-pagetree-encyclopediaEntry',
            TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            [
                'source' => 'EXT:' . $extKey . '/Resources/Public/Icons/doktype-encyclopedia-entry.svg',
            ]
        );

    // Register doktype icon for glossary entry to be used in the page tree
    $iconRegistry
        ->registerIcon(
            'apps-pagetree-glossaryEntry',
            TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            [
                'source' => 'EXT:' . $extKey . '/Resources/Public/Icons/doktype-glossary-entry.svg',
            ]
        );

    // Allow backend users to drag and drop the new doktypes (page types)
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
        'options.pageTree.doktypesToShowInNewPageDragArea := addToList(' . $lexDictionaryDoktype . ',' . $lexEncyclopediaDoktype . ',' . $lexGlossaryDoktype . ')'
    );
 } )();

 ?>
