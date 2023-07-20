<?php

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Sense and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense',
        'label'                    => 'id',
        'label_alt'                => 'uuid,indicator',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'id ASC,uuid ASC,indicator ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:da_lex/Resources/Public/Icons/Sense.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'id,uuid,indicator,structuredIndicator',
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
                'foreign_table'       => 'tx_dalex_domain_model_sense',
                'foreign_table_where' =>
                    'AND {#tx_dalex_domain_model_sense}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_dalex_domain_model_sense}.{#sys_language_uid} IN (-1,0)',
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
        'id' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.id',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.id.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'uuid' => [
            'label'       => 'LLL:EXT:da_ex/Resources/Private/Language/locallang.xlf:database.sense.uuid',
            'description' => 'LLL:EXT:da_ex/Resources/Private/Language/locallang.xlf:database.sense.uuid.description',
            'config'      => [
                'type'     => 'uuid',
                'size'     => 40,
                'required' => true,
            ],
        ],
        'definition' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.definition',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.definition.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_dalex_domain_model_definition',
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
        'indicator' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.indicator',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.indicator.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'structuredIndicator' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.structuredIndicator',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.structuredIndicator.description',
            'config'      => [
                'type' => 'category',
            ],
        ],
        'example' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.example',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.example.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_dalex_domain_model_example',
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
        'frequency' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.frequency',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.frequency.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_dalex_domain_model_frequency',
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
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.label',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dalex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dalex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_dalex_domain_model_tag}.{#type}=\'label\''
                . ' ORDER BY tag',
                'MM'                  => 'tx_dalex_domain_model_sense_label_mm',
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
        'sameAs' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.sameAs',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.sense.sameAs.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_dalex_domain_model_same_as',
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
    ],
    'palettes' => [
        'idUuid' => [
            'showitem' => 'id,uuid,',
        ],
        'indicatorStructuredIndicator' => [
            'showitem' => 'indicator,structuredIndicator,',
        ],
        'exampleFrequency' => [
            'showitem' => 'example,frequency,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,idUuid,definition,indicatorStructuredIndicator,exampleFrequency,label,sameAs,',
        ],
    ],
];

?>
