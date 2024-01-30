<?php
defined('TYPO3') or die();

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * LexicographicResource and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource',
        'label'                    => 'title',
        'label_alt'                => 'language,uri',
        'descriptionColumn'        => 'description',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'title ASC,language ASC,uri ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_lex/Resources/Public/Icons/LexicographicResource.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'title,language,description,uri',
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
                'foreign_table'       => 'tx_chflex_domain_model_lexicographic_resource',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_lexicographic_resource}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_lexicographic_resource}.{#sys_language_uid} IN (-1,0)',
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
        'title' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.title',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.title.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'language' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.language',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.language.description',
            'config'      => [
                'type'     => 'language',
                'required' => true,
            ],
        ],
        'description' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.description',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.description.description',
            'config'      => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max'  => 2000,
                'eval' => 'trim',
            ],
        ],
        'uri' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.uri',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.uri.description',
            'config' => [
                'type'           => 'link',
                'allowedTypes'   => ['page', 'url', 'record'],
                'allowedOptions' => [],
                'mode'           => 'prepend',
                'valuePicker'    => [
                   'items' => [
                      ['HTTPS', 'https://'],
                      ['HTTP', 'http://'],
                   ],
                ],
            ],
        ],
        'sameAs' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.sameAs',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.sameAs.description',
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
        'entry' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.entry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.entry.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_entry',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'foreign_sortby'      => 'sorting',
                'behaviour'           => [
                     'allowLanguageSynchronization' => true
                ],
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
        'contributor' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.contributor',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.contributor.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_contributor',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'foreign_sortby'      => 'sorting',
                'behaviour'           => [
                     'allowLanguageSynchronization' => true
                ],
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
        'tag' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.tag',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.tag.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'foreign_sortby'      => 'sorting',
                'behaviour'           => [
                     'allowLanguageSynchronization' => true
                ],
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
        'relation' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.relation',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.relation.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_relation',
                'foreign_field'       => 'parent_id',
                'foreign_table_field' => 'parent_table',
                'foreign_sortby'      => 'sorting',
                'behaviour'           => [
                     'allowLanguageSynchronization' => true
                ],
                'appearance'          => [
                    'collapseAll'                     => true,
                    'expandSingle'                    => true,
                    'newRecordLinkAddTitle'           => true,
                    'levelLinksPosition'              => 'top',
                    'useSortable'                     => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink'         => true,
                    'showSynchronizationLink'         => true,
                ],
            ],
        ],
    ],
    'palettes' => [
        'titleLanguage' => [
            'showitem' => 'title,language,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'hidden,titleLanguage,description,uri,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.lexicographicResource.content,entry,contributor,tag,relation,',
        ],
    ],
];
