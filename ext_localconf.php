<?php
defined('TYPO3') or die();

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


// Prevent script from being called directly
defined( 'TYPO3' ) or die();

// Register content for this extension
( function( $extKey='chf_lex' ) {

    // Backend customisation
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets'] = [
        'chf_lex_text'       => 'EXT:' . $extKey . '/Configuration/RTE/CHFLexText.yaml',
        'chf_lex_annotation' => 'EXT:' . $extKey . '/Configuration/RTE/CHFLexAnnotation.yaml',
    ];

} )();
