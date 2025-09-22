<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * LexicographicResource and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add select item 'lexicographicResource'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_resource', 'type',
    [
        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.lexicographicResource.type.lexicographicResource',
        'value' => 'lexicographicResource',
    ]
);

// Add type 'lexicographicResource' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['types'] += ['lexicographicResource' => [
   'showitem' => 'type,--palette--;;titleLangCode,description,glossary,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;iriUuid,same_as,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,editorial_note,authorship_relation,licence_relation,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,import_state,',
]];

// Add opposite usage info to 'items' column
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['allowed'] .= ',tx_chflex_domain_model_definition,tx_chflex_domain_model_dictionaryentry,tx_chflex_domain_model_encyclopediaentry,tx_chflex_domain_model_example,tx_chflex_domain_model_frequency,tx_chflex_domain_model_inflectedform,tx_chflex_domain_model_pronunciation,tx_chflex_domain_model_sense,tx_chflex_domain_model_transcription';
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_definition'] = ['parent_resource'];
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_dictionaryentry'] = ['parent_resource'];
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_encyclopediaentry'] = ['parent_resource'];
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_example'] = ['parent_resource'];
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_frequency'] = ['parent_resource'];
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_inflectedform'] = ['parent_resource'];
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_pronunciation'] = ['parent_resource'];
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_sense'] = ['parent_resource'];
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_transcription'] = ['parent_resource'];
