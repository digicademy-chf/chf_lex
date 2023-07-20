<?php

# This file is part of the extension DA Lex for TYPO3.
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
        'title'                    => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example',
        'label'                    => 'text',
        'label_alt'                => 'date,location',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'text ASC,date ASC,location ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:da_lex/Resources/Public/Icons/Example.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'text,date,location,sourceElaboration',
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
                'foreign_table'       => 'tx_dalex_domain_model_example',
                'foreign_table_where' =>
                    'AND {#tx_dalex_domain_model_example}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_dalex_domain_model_example}.{#sys_language_uid} IN (-1,0)',
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
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.text',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.text.description',
            'config'      => [
                'type'     => 'text',
                'cols'     => 40,
                'rows'     => 5,
                'max'      => 2000,
                'eval'     => 'trim',
                'required' => true,
            ],
        ],
        'date' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.date',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.date.description',
            'config'      => [
                'type'    => 'datetime',
                'format'  => 'date',
                'eval'    => 'int',
                'default' => 0,
            ],
        ],
        'location' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.location',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.location.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'soundFile' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.soundFile',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.soundFile.description',
            'config' => [
                'type'     => 'file',
                'maxitems' => 1,
                'allowed'  => 'common-media-types'
            ],
        ],
        'sourceIdentity' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.sourceIdentity',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.sourceIdentity.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_dalex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dalex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_dalex_domain_model_tag}.{#type}=\'sourceIdentity\''
                . ' ORDER BY tag',
            ],
        ],
        'sourceElaboration' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.sourceElaboration',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.sourceElaboration.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'source' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.source',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.source.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dabib_domain_model_reference',
                'foreign_table_where' => 'ORDER BY lastChecked',
                'MM'                  => 'tx_dalex_domain_model_example_reference_mm',
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
        'label' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.label',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.example.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dalex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dalex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_dalex_domain_model_tag}.{#type}=\'label\''
                . ' ORDER BY tag',
                'MM'                  => 'tx_dalex_domain_model_contributor_label_mm',
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
        'dateLocation' => [
            'showitem' => 'date,location,',
        ],
        'sourceIdentitySourceElaboration' => [
            'showitem' => 'sourceIdentity,sourceElaboration,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,text,dateLocation,soundFile,sourceIdentitySourceElaboration,source,label,',
        ],
    ],
];

?>
