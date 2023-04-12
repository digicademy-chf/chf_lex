<?php

# Basic Configuration of Globals
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


// Register content for this extension
( function( $extKey='da_lex' ) {
    $lexDictionaryDoktype = 150;
    $lexEncyclopediaDoktype = 151;
    $lexGlossaryDoktype = 152;

    // Add a doktype (page type) for dictionary entries
    $GLOBALS['PAGES_TYPES'][$lexDictionaryDoktype] = [
        'type'          => 'web',
        'allowedTables' => '*'
    ];

    // Add a doktype (page type) for encyclopedia entries
    $GLOBALS['PAGES_TYPES'][$lexEncyclopediaDoktype] = [
        'type'          => 'web',
        'allowedTables' => '*'
    ];

    // Add a doktype (page type) for glossary entries
    $GLOBALS['PAGES_TYPES'][$lexGlossaryDoktype] = [
        'type'          => 'web',
        'allowedTables' => '*'
    ];
} )();

?>
