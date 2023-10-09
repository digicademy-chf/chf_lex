<?php

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Entry and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry',
        'label'                    => 'headword',
        'label_alt'                => 'title',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'headword ASC,title ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_lex/Resources/Public/Icons/Entry.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'type'                     => 'type',
        'searchFields'             => 'id,uuid,type,headword,homographNumber,title,annotateStrings,revisionNumber,revisionDate,databaseQuery,publicationDate,editingNotes',
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
                'foreign_table'       => 'tx_chflex_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_entry}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_entry}.{#sys_language_uid} IN (-1,0)',
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
        'parent_id' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.parent_id',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.parent_id.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_chflex_domain_model_lexicographic_resource',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_lexicographic_resource}.{#pid}=###CURRENT_PID###',
                'maxitems'            => 1,
                'required'            => true,
            ],
        ],
        'id' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.id',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.id.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim,uniqueInPid',
                'required' => true,
            ],
        ],
        'uuid' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.uuid',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.uuid.description',
            'config'      => [
                'type'     => 'uuid',
                'size'     => 40,
                'required' => true,
            ],
        ],
        'type' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.type',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.type.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.language',
                        'value' => 'entry',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.country',
                        'value' => 'encyclopediaEntry',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.region',
                        'value' => 'glossaryEntry',
                    ],
                ],
                'required'   => true,
            ],
        ],
        'headword' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.headword',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.headword.description',
            'config'      => [
                'type'     => 'input',
                'size'     => 40,
                'max'      => 255,
                'eval'     => 'trim',
                'required' => true,
            ],
        ],
        'homographNumber' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.homographNumber',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.homographNumber.description',
            'config'      => [
                'type'     => 'number',
            ],
        ],
        'title' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.title',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.title.description',
            'config'      => [
                'type'     => 'input',
                'size'     => 40,
                'max'      => 255,
                'eval'     => 'trim',
                'required' => true,
            ],
        ],
        'annotateStrings' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.annotateStrings',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.annotateStrings.description',
            'config'      => [
                'type'     => 'input',
                'size'     => 40,
                'max'      => 255,
                'eval'     => 'trim',
                'required' => true,
            ],
        ],
        'label' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.label',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.label.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'label\'',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_label_mm',
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
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.sameAs',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.sameAs.description',
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
        'author' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.author',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.author.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_contributor}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_entry_contributor_author_mm',
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
        'editor' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editor',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_contributor}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_entry_contributor_editor_mm',
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
        'revisionNumber' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.revisionNumber',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.revisionNumber.description',
            'config'      => [
                'type' => 'number',
            ],
        ],
        'revisionDate' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.revisionDate',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.revisionDate.description',
            'config'      => [
                'type'    => 'datetime',
                'format'  => 'date',
                'eval'    => 'int',
                'default' => 0,
            ],
        ],
        'databaseQuery' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.databaseQuery',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.databaseQuery.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'publicationDate' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.publicationDate',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.publicationDate.description',
            'config'      => [
                'type'    => 'datetime',
                'format'  => 'date',
                'eval'    => 'int',
                'default' => 0,
            ],
        ],
        'publicationSteps' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.publicationSteps',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.publicationSteps.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectCheckBox',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.publicationSteps.editing',
                        'value' => 'editing',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.publicationSteps.deferred',
                        'value' => 'deferred',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.publicationSteps.checking',
                        'value' => 'checking',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.publicationSteps.revising',
                        'value' => 'revising',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.publicationSteps.publishing',
                        'value' => 'publishing',
                    ],
                ],
            ],
        ],
        'editingSteps' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editingSteps',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editingSteps.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectCheckBox',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editingSteps.checkDatabase',
                        'value' => 'checkDatabase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editingSteps.checkForeignLanguage',
                        'value' => 'checkForeignLanguage',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editingSteps.checkRegional',
                        'value' => 'checkRegional',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editingSteps.checkPrevious',
                        'value' => 'checkPrevious',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editingSteps.checkFurther',
                        'value' => 'checkFurther',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editingSteps.checkMaps',
                        'value' => 'checkMaps',
                    ],
                ],
            ],
        ],
        'editingNotes' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editingNotes',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editingNotes.description',
            'config'      => [
                'type'     => 'text',
                'cols'     => 40,
                'rows'     => 5,
                'max'      => 2000,
                'eval'     => 'trim',
            ],
        ],
        'classification' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.classification',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.classification.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectTree',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'classificationEntry\'',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_classification_mm',
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
        'partOfSpeech' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.partOfSpeech',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.partOfSpeech.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'partOfSpeech\'',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_partofspeech_mm',
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
        'inflectedForm' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.inflectedForm',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.inflectedForm.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_inflected_form',
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
        'pronunciation' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.pronunciation',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.pronunciation.description',
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
        'sense' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.sense',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.sense.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_sense',
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
        'example' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.example',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.example.description',
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
        'contentElements' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.contentElements',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.contentElements.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tt_content',
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
        'image' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.image',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.image.description',
            'config' => [
                'type'     => 'file',
                'allowed'  => 'common-image-types'
            ],
        ],
        'file' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.file',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.file.description',
            'config' => [
                'type'     => 'file',
                'allowed'  => 'common-text-types'
            ],
        ],
        'distributionLanguage' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.distributionLanguage',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.distributionLanguage.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'language\'',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_distributionlanguage_mm',
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
        'distributionCountry' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.distributionCountry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.distributionCountry.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'country\'',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_distributioncountry_mm',
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
        'distributionRegion' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.distributionRegion',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.distributionRegion.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'region\'',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_distributionregion_mm',
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
        'frequency' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.frequency',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.frequency.description',
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
        'source' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.source',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.source.description',
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
        'import' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.import',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.import.description',
            'config'      => [
                'type'     => 'text',
                'cols'     => 40,
                'rows'     => 15,
                'max'      => 100000,
                'eval'     => 'trim',
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
        'hiddenParentId' => [
            'showitem' => 'hidden,parent_id,',
        ],
        'idUuid' => [
            'showitem' => 'id,uuid,',
        ],
        'headwordHomographNumber' => [
            'showitem' => 'headword,homographNumber,',
        ],
        'titleAnnotateStrings' => [
            'showitem' => 'title,annotateStrings,',
        ],
        'revisionNumberRevisionDate' => [
            'showitem' => 'revisionNumber,revisionDate,',
        ],
        'databaseQuery,publicationDate' => [
            'showitem' => 'databaseQueryPublicationDate,',
        ],
        'publicationStepsEditingSteps' => [
            'showitem' => 'publicationSteps,editingSteps,',
        ],
    ],
    'types' => [
        'abstractEntry' => [
            'showitem' => 'hiddenParentId,idUuid,type,label,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editorial,author,editor,revisionNumberRevisionDate,publicationDate,publicationStepsEditingSteps,editingNotes,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.content,image,file,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.bibliography,source,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.original,import,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.relations,asMember,',
        ],
        'entry' => [
            'showitem' => 'hiddenParentId,idUuid,type,headwordHomographNumber,label,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editorial,author,editor,revisionNumberRevisionDate,databaseQueryPublicationDate,publicationStepsEditingSteps,editingNotes,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.characteristics,classification,partOfSpeech,inflectedForm,pronunciation,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.content,sense,example,image,file,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.distribution,distributionLanguage,distributionCountry,distributionRegion,frequency,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.bibliography,source,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.original,import,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.relations,asMember,',
        ],
        'encyclopediaEntry' => [
            'showitem' => 'hiddenParentId,idUuid,type,title,label,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editorial,author,editor,revisionNumberRevisionDate,publicationDate,publicationStepsEditingSteps,editingNotes,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.content,contentElements,image,file,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.bibliography,source,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.original,import,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.relations,asMember,',
        ],
        'glossaryEntry' => [
            'showitem' => 'hiddenParentId,idUuid,type,titleAnnotateStrings,label,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.editorial,author,editor,revisionNumberRevisionDate,publicationDate,publicationStepsEditingSteps,editingNotes,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.content,contentElements,image,file,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.bibliography,source,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.original,import,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.entry.relations,asMember,',
        ],
    ],
];

?>
