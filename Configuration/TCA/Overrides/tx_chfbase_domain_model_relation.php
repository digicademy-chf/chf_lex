<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * SimilarityRelation, LexicographicRelation, and their properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add select item group 'chfLex'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup('tx_chfbase_domain_model_relation', 'type',
    'chfLex',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.chfLex'
);

// Add select item 'similarityRelation'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_relation', 'type',
    [
        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.similarityRelation.type.similarityRelation',
        'value' => 'similarityRelation',
        'group' => 'chfLex',
    ]
);

// Add select item 'lexicographicRelation'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_relation', 'type',
    [
        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.lexicographicRelation.type.lexicographicRelation',
        'value' => 'lexicographicRelation',
        'group' => 'chfLex',
    ]
);

// Add columns 'relatedRecord', 'lexicographicRelationType', and 'member'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_relation',
    [
        'relatedRecord' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.similarityRelation.relatedRecord',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.similarityRelation.relatedRecord.description',
            'config' => [
                'type' => 'group',
                'allowed' => 'tx_chflex_domain_model_dictionary_entry,tx_chflex_domain_model_encyclopedia_entry,',
                'foreign_table' => 'tx_chflex_domain_model_dictionary_entry', // Needed by Extbase as of TYPO3 12, remove when possible
                'MM' => 'tx_chfbase_domain_model_relation_any_relatedrecord_mm',
                'multiple' => 1,
                'elementBrowserEntryPoints' => [
                    '_default' => '###CURRENT_PID###',
                ],
                'required' => true,
            ],
        ],
        'lexicographicRelationType' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.lexicographicRelation.lexicographicRelationType',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.lexicographicRelation.lexicographicRelationType.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'relationType\'',
                'MM' => 'tx_chfbase_domain_model_relation_tag_lexrelationtype_mm',
                'multiple' => 1,
            ],
        ],
        'member' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.lexicographicRelation.member',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.lexicographicRelation.member.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chflex_domain_model_member',
                'foreign_field' => 'parentRelation',
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'required' => true,
            ],
        ],
    ]
);

// Create palette 'volumeEssayPosition'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tx_chfbase_domain_model_relation',
    'lexicographicRelationTypeMember',
    'lexicographicRelationType,--linebreak--,member,'
);

// Add type 'similarityRelation' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_relation']['types'] += ['similarityRelation' => [
    'showitem' => '--palette--;;typeUuid,record,relatedRecord,--palette--;;parentResourceDescription,',
]];

// Add type 'lexicographicRelation' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_relation']['types'] += ['lexicographicRelation' => [
    'showitem' => '--palette--;;typeUuid,--palette--;;lexicographicRelationTypeMember,--palette--;;parentResourceDescription,',
]];
