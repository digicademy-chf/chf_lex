<?php
defined('TYPO3') or die();

# This file is part of the extension CHF Lex for TYPO3.
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
        'title'                    => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense',
        'label'                    => 'id',
        'label_alt'                => 'indicator',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'id ASC,indicator ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_lex/Resources/Public/Icons/Sense.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'id,uuid,indicator,classification',
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
                'foreign_table'       => 'tx_chflex_domain_model_sense',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_sense}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_sense}.{#sys_language_uid} IN (-1,0)',
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
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.id',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.id.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim,uniqueInPid',
                'required' => true,
            ],
        ],
        'uuid' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.uuid',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.uuid.description',
            'config'      => [
                'type'     => 'uuid',
                'size'     => 40,
                'required' => true,
            ],
        ],
        'definition' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.definition',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.definition.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_definition',
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
        'indicator' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.indicator',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.indicator.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'classification' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.classification',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.classification.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectTree',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'classificationSense\'',
                'MM'                  => 'tx_chflex_domain_model_sense_tag_classification_mm',
                'size'                => 20,
                'treeConfig'          => [
                    'parentField' => 'parent_id',
                    'appearance'  => [
                        'showHeader' => true,
                        'expandAll'  => true,
                    ],
                ],
            ],
        ],
        'example' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.example',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.example.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_example',
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
        'frequency' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.frequency',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.frequency.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_frequency',
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
        'label' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.label',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'label\'',
                'MM'                  => 'tx_chflex_domain_model_sense_tag_label_mm',
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
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.sameAs',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.sameAs.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_same_as',
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
        'asMember' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.asMember',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.asMember.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_member',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_member}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_member_entryorsense_entryorsense_mm',
                'MM_opposite_field'   => 'entryOrSense',
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
        'idUuid' => [
            'showitem' => 'id,uuid,',
        ],
        'indicatorClassification' => [
            'showitem' => 'indicator,classification,',
        ],
        'exampleFrequency' => [
            'showitem' => 'example,frequency,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,idUuid,definition,indicatorClassification,exampleFrequency,label,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.sense.relations,asMember,',
        ],
    ],
];
