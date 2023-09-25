<?php

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


// Map all *.js files in a specific folder to an @ module key
return [
    'dependencies' => ['backend'],
    'imports' => [
        '@digicademy/chf_lex/' => 'EXT:chf_lex/Resources/Public/JavaScript/',
    ],
];

?>