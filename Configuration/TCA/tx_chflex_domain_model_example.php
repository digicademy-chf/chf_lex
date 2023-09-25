<?php

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Example and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example',
        'label'                    => 'text',
        'label_alt'                => 'dateCirca,locationLabel',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'text ASC,dateCirca ASC,locationLabel ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_lex/Resources/Public/Icons/Example.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'text,dateCirca,dateStart,dateEnd,locationLabel,sourceElaboration',
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
                'foreign_table'       => 'tx_chflex_domain_model_example',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_example}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_example}.{#sys_language_uid} IN (-1,0)',
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
        'text' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.text',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.text.description',
            'config'      => [
                'type'                  => 'text',
                'enableRichtext'        => true,
                'richtextConfiguration' => 'chf_lex_text',
                'required'              => true,
            ],
        ],
        'dateCirca' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.dateCirca',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.dateCirca.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'dateStart' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.dateStart',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.dateStart.description',
            'config'      => [
                'type'    => 'datetime',
                'format'  => 'date',
                'eval'    => 'int',
                'default' => 0,
            ],
        ],
        'dateEnd' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.dateEnd',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.dateEnd.description',
            'config'      => [
                'type'    => 'datetime',
                'format'  => 'date',
                'eval'    => 'int',
                'default' => 0,
            ],
        ],
        'locationLabel' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.locationLabel',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.locationLab.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'locationGeodata' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.locationGeodata',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.frequency.locationGeodata.description',
            'config'      => [
                'type'          => 'group',
                'allowed'       => 'tx_chfmap_domain_model_feature',
                'foreign_table' => 'tx_chfmap_domain_model_feature', // Needed by Extbase
                'MM'            => 'tx_chflex_domain_model_example_feature_locationgeodata_mm',
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
        'soundFile' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.soundFile',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.soundFile.description',
            'config' => [
                'type'     => 'file',
                'maxitems' => 1,
                'allowed'  => 'common-media-types'
            ],
        ],
        'sourceIdentity' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.sourceIdentity',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.sourceIdentity.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'sourceIdentity\'',
                'MM'                  => 'tx_chflex_domain_model_example_tag_sourceidentity_mm',
            ],
        ],
        'sourceElaboration' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.sourceElaboration',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.sourceElaboration.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'source' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.source',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.source.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chfbib_domain_model_reference',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
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
        'label' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.label',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.example.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'label\'',
                'MM'                  => 'tx_chflex_domain_model_example_tag_label_mm',
                'size'                => 5,
                'autoSizeMax'         => 10,
                'fieldControl'        => [
                    'editPopup'  => [
                        'disabled' => false,
                    ],
                    'addRecord'  => [
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
        'textDateCirca' => [
            'showitem' => 'text,dateCirca,',
        ],
        'dateStartDateEnd' => [
            'showitem' => 'textdateStart,dateEnd,',
        ],
        'locationLabelLocationGeodata' => [
            'showitem' => 'locationLabel,locationGeodata,',
        ],
        'sourceIdentitySourceElaboration' => [
            'showitem' => 'sourceIdentity,sourceElaboration,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,textDateCirca,dateStartDateEnd,locationLabelLocationGeodata,soundFile,sourceIdentitySourceElaboration,source,label,',
        ],
    ],
];

?>
