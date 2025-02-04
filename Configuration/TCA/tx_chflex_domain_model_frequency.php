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
        'fe_group' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_group',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'maxitems' => 20,
                'items' => [
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hide_at_login',
                        'value' => -1,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.any_login',
                        'value' => -2,
                    ],
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.usergroups',
                        'value' => '--div--',
                    ],
                ],
                'exclusiveKeys' => '-1,-2',
                'foreign_table' => 'fe_groups',
                'foreign_table_where' => 'ORDER BY fe_groups.title',
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l10n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chflex_domain_model_frequency',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_frequency}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_frequency}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => '',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.hidden.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ]
                ],
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.starttime.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.endtime.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'eval' => 'int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2106),
                ],
            ],
        ],
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
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_chflex_domain_model_frequency',
                    'fieldname' => 'location_relation',
                ],
                'MM_opposite_field' => 'record',
                'multiple' => 1,
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
                                'default' => 'locationRelation',
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
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_sense}.{#pid}=###CURRENT_PID###',
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
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_dictionaryentry}.{#pid}=###CURRENT_PID###',
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
        'parentSenseParentEntry' => [
            'showitem' => 'parent_sense,parent_entry,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;tokensTokensSecondaryTokenType,--palette--;;dateDateText,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,distribution,location_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,source_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,--palette--;;parentSenseParentEntry,',
        ],
    ],
];
