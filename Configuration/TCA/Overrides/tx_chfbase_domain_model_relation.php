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

// Add columns 'related_record', 'lexicographic_relation_type', and 'member'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_relation',
    [
        'related_record' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.similarityRelation.relatedRecord',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.similarityRelation.relatedRecord.description',
            'config' => [
                'type' => 'group',
                'allowed' => 'tx_chflex_domain_model_dictionaryentry,tx_chflex_domain_model_encyclopediaentry,',
                'elementBrowserEntryPoints' => [
                    '_default' => '###CURRENT_PID###',
                ],
                'required' => true,
            ],
        ],
        'lexicographic_relation_type' => [
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
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#pid} IN (###CURRENT_PID###, ###SITE:settings.chf.data.page###)'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'relationType\'',
                'MM' => 'tx_chfbase_domain_model_tag_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'lexicographic_relation_type',
                    'tablenames' => 'tx_chfbase_domain_model_relation',
                ],
                'MM_opposite_field' => 'items',
                'sortItems' => [
                    'label' => 'asc',
                ],
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
                'foreign_field' => 'parent_relation',
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

// Add tables to allow list of 'record' column
$GLOBALS['TCA']['tx_chfbase_domain_model_relation']['columns']['record']['config']['allowed'] .= ',tx_chflex_domain_model_dictionaryentry,tx_chflex_domain_model_encyclopediaentry,tx_chflex_domain_model_frequency,tx_chflex_domain_model_example';

// Create palette 'volumeEssayPosition'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_chfbase_domain_model_relation',
    'lexicographicRelationTypeMember',
    'lexicographic_relation_type,--linebreak--,member,'
);

// Add type 'similarityRelation' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_relation']['types'] += ['similarityRelation' => [
    'showitem' => 'type,record,related_record,description,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,',
]];

// Add type 'lexicographicRelation' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_relation']['types'] += ['lexicographicRelation' => [
    'showitem' => 'type,--palette--;;lexicographicRelationTypeMember,description,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,',
]];
