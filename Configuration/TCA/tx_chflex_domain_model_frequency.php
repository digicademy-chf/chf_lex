<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * Frequency and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency',
        'label'                    => 'tokens',
        'label_alt'                => 'tokens_secondary,token_type',
        'label_alt_force'          => true,
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'tokens ASC,tokens_secondary ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_lex/Resources/Public/Icons/TableFrequency.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'tokens,tokens_secondary,token_type',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'tokens' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.tokens',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.tokens.description',
            'config' => [
                'type' => 'number',
                'size' => 13,
                'default' => 0,
                'range' => [
                    'lower' => 0,
                ],
                'required' => true,
            ],
        ],
        'tokens_secondary' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.tokensSecondary',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.tokensSecondary.description',
            'config' => [
                'type' => 'number',
                'size' => 13,
                'nullable' => true,
                'default' => null,
                'range' => [
                    'lower' => 0,
                ],
            ],
        ],
        'token_type' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.tokenType',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.tokenType.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.tokenType.unknown',
                        'value' => 'unknown',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.tokenType.population',
                        'value' => 'population',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.tokenType.families',
                        'value' => 'families',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.tokenType.births',
                        'value' => 'births',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.tokenType.landlines',
                        'value' => 'landlines',
                    ],
                ],
                'default' => 'unknown',
                'required' => true,
            ],
        ],
        'date' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.date',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.date.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'default' => 0,
            ],
        ],
        'date_text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.dateText',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.dateText.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'location_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.locationRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.locationRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_field' => 'record',
                'foreign_match_fields' => [
                    'type' => 'locationRelation'
                ],
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'readOnly' => true,
                            ],
                        ],
                        'role' => [
                            'config' => [
                                'default' => 'genericLocation',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'parent_sense' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.parentSense',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.parentSense.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chflex_domain_model_sense',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_sense}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chflex_domain_model_sense}.{#pid} IN (###CURRENT_PID###, ###SITE:settings.chf.data.page###)',
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
        'parent_entry' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.parentEntry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.frequency.parentEntry.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chflex_domain_model_dictionaryentry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_dictionaryentry}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chflex_domain_model_dictionaryentry}.{#pid} IN (###CURRENT_PID###, ###SITE:settings.chf.data.page###)',
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
        'parent_resource' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.parentResource.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'lexicographicResource\'',
                'MM' => 'tx_chfbase_domain_model_resource_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'parent_resource',
                    'tablenames' => 'tx_chflex_domain_model_frequency',
                ],
                'MM_opposite_field' => 'items',
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
    ],
    'palettes' => [
        'tokensTokensSecondaryTokenType' => [
            'showitem' => 'tokens,tokens_secondary,--linebreak--,token_type,',
        ],
        'dateDateText' => [
            'showitem' => 'date,date_text,',
        ],
        'parentSenseParentEntryParentResource' => [
            'showitem' => 'parent_sense,parent_entry,--linebreak--,parent_resource,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;tokensTokensSecondaryTokenType,--palette--;;dateDateText,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,distribution,location_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;parentSenseParentEntryParentResource,',
        ],
    ],
];
