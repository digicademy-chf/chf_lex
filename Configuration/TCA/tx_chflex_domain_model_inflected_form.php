<?php

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * InflectedForm and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.inflectedForm',
        'label'                    => 'text',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'text ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_lex/Resources/Public/Icons/InflectedForm.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'text',
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
                'foreign_table'       => 'tx_chflex_domain_model_inflected_form',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_inflected_form}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_inflected_form}.{#sys_language_uid} IN (-1,0)',
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
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.inflectedForm.text',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.inflectedForm.text.description',
            'config'      => [
                'type'     => 'input',
                'size'     => 40,
                'max'      => 255,
                'eval'     => 'trim',
                'required' => true,
            ],
        ],
        'inflectionType' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.inflectedForm.inflectionType',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.inflectedForm.inflectionType.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'inflectedForm\'',
                'MM'                  => 'tx_chflex_domain_model_inflected_form_tag_inflectiontype_mm',
            ],
        ],
        'pronunciation' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.inflectedForm.pronunciation',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.inflectedForm.pronunciation.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_pronunciation',
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
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.inflectedForm.label',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.inflectedForm.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'label\'',
                'MM'                  => 'tx_chflex_domain_model_inflected_form_tag_label_mm',
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
        'textInflectionType' => [
            'showitem' => 'text,inflectionType,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,textInflectionType,pronunciation,label,',
        ],
    ],
];

?>
