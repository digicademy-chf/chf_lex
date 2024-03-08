<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

// Backend customisation
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets'] = [
    'chf_lex_text'       => 'EXT:chf_lex/Configuration/RTE/CHFLexText.yaml',
    'chf_lex_annotation' => 'EXT:chf_lex/Configuration/RTE/CHFLexAnnotation.yaml',
];
