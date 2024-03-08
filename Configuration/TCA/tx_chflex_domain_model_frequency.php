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
        'title'                    => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency',
        'label'                    => 'tokens',
        'label_alt'                => 'tokensSecondary',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'tokens ASC,tokensSecondary ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_lex/Resources/Public/Icons/Frequency.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'tokens,tokensSecondary,dateCirca,dateStart,dateEnd,sourceElaboration',
        'enablecolumns'            => [
            'disabled' => 'hidden',
            'fe_group' => 'fe_group',
        ],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config'  => [
                'type'       => 'check',
                'renderType' => 'checkboxToggle',
                'items'      => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ]
                ],
            ]
        ],
        'fe_group' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_group',
            'config' => [
                'type'       => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size'       => 5,
                'maxitems'   => 20,
                'items'      => [
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
            ],
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config'  => [
                'type' => 'language',
            ],
        ],
        'l18n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label'       => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table'       => 'tx_chflex_domain_model_frequency',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_frequency}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_frequency}.{#sys_language_uid} IN (-1,0)',
                'default'             => 0,
            ],
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'l18n_diffsource' => [
            'config' => [
                'type'    => 'passthrough',
                'default' => '',
            ],
        ],
        'type' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.type',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.type.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'frequencyType\'',
                'MM'                  => 'tx_chflex_domain_model_frequency_tag_type_mm',
            ],
        ],
        'tokens' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.tokens',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.tokens.description',
            'config'      => [
                'type'     => 'number',
                'required' => true,
            ],
        ],
        'tokensSecondary' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.tokensSecondary',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.tokensSecondary.description',
            'config'      => [
                'type'     => 'number',
            ],
        ],
        'countryOrRegion' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.countryOrRegion',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.countryOrRegion.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND ({#tx_chflex_domain_model_tag}.{#type}=\'country\' OR {#tx_chflex_domain_model_tag}.{#type}=\'region\')',
                'MM'                  => 'tx_chflex_domain_model_frequency_tag_countryorregion_mm',
            ],
        ],
        'dateCirca' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.dateCirca',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.dateCirca.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'dateStart' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.dateStart',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.dateStart.description',
            'config'      => [
                'type'    => 'datetime',
                'format'  => 'date',
                'eval'    => 'int',
                'default' => 0,
            ],
        ],
        'dateEnd' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.dateEnd',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.dateEnd.description',
            'config'      => [
                'type'    => 'datetime',
                'format'  => 'date',
                'eval'    => 'int',
                'default' => 0,
            ],
        ],
        'sourceIdentity' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.sourceIdentity',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.sourceIdentity.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'sourceIdentity\'',
                'MM'                  => 'tx_chflex_domain_model_frequency_tag_sourceidentity_mm',
            ],
        ],
        'sourceElaboration' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.sourceElaboration',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.sourceElaboration.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'source' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.source',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.source.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbib_domain_model_reference',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'behaviour'           => [
                     'allowLanguageSynchronization' => true
                ],
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
        'geodata' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.geodata',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.geodata.description',
            'config'      => [
                'type'          => 'group',
                'allowed'       => 'tx_chfmap_domain_model_feature',
                'foreign_table' => 'tx_chfmap_domain_model_feature', // Needed by Extbase
                'MM'            => 'tx_chflex_domain_model_frequency_feature_geodata_mm',
                'maxitems'      => 1,
                'minitems'      => 0,
                'size'          => 1,
                'fieldControl'  => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
    ],
    'palettes' => [
        'tokensTokensSecondary' => [
            'showitem' => 'tokens,tokensSecondary,',
        ],
        'countryOrRegionDateCirca' => [
            'showitem' => 'countryOrRegion,dateCirca,',
        ],
        'dateStartDateEnd' => [
            'showitem' => 'dateStart,dateEnd,',
        ],
        'sourceIdentitySourceElaboration' => [
            'showitem' => 'sourceIdentity,sourceElaboration,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,type,tokensTokensSecondary,countryOrRegionDateCirca,dateStartDateEnd,sourceIdentitySourceElaboration,source,geodata,',
        ],
    ],
];
