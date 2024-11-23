<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * EncyclopediaEntry and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.encyclopediaEntry',
        'label'                    => 'title',
        'descriptionColumn'        => 'editorial_note',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'is_highlight ASC,title ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_lex/Resources/Public/Icons/TableEncyclopediaEntry.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'translationSource'        => 'l10n_source',
        'searchFields'             => 'title,uuid,publication_date,revision_date,revision_number,editorial_note,editorial_steps,publication_steps,import_origin,import',
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
                'foreign_table' => 'tx_chflex_domain_model_encyclopediaentry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_encyclopediaentry}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_encyclopediaentry}.{#sys_language_uid} IN (-1,0)',
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
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.encyclopediaEntry.title',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.encyclopediaEntry.title.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'required' => true,
            ],
        ],
        'label' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.label.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'labelTag\'',
                'MM' => 'tx_chflex_domain_model_encyclopediaentry_tag_label_mm',
                'multiple' => 1,
                'treeConfig' => [
                    'parentField' => 'parent_label_tag',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                    ],
                ],
                'size' => 8,
            ],
        ],
        'similarity_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.similarityRelation',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.similarityRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_chflex_domain_model_encyclopediaentry',
                    'fieldname' => 'similarity_relation',
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
                                'default' => 'similarityRelation',
                                'readOnly' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'content_element' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.contentElement',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.contentElement.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tt_content',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
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
            ],
        ],
        'footnote' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.footnote',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.footnote.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_footnote',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
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
            ],
        ],
        'media' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.media',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.media.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-media-types',
            ],
        ],
        'file' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.file',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.file.description',
            'config' => [
                'type' => 'file',
            ],
        ],
        'link_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.linkRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_chflex_domain_model_encyclopediaentry',
                    'fieldname' => 'link_relation',
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
                                'default' => 'linkRelation',
                                'readOnly' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'is_teaser' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isTeaser',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isTeaser.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                    ]
                ],
            ]
        ],
        'is_highlight' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isHighlight',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractHeritage.isHighlight.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => ''
                    ]
                ],
            ]
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
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'lexicographicResource\'',
                'sortItems' => [
                    'label' => 'asc',
                ],
                'required' => true,
            ],
        ],
        'uuid' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.uuid.description',
            'config' => [
                'type' => 'uuid',
                'size' => 40,
                'required' => true,
            ],
        ],
        'same_as' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.sameAs.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_sameas',
                'foreign_field' => 'parent',
                'foreign_table_field' => 'parent_table',
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
            ],
        ],
        'publication_date' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.publicationDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'default' => 0,
            ],
        ],
        'revision_date' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionDate.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'default' => 0,
            ],
        ],
        'revision_number' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.revisionNumber.description',
            'config' => [
                'type' => 'number',
                'size' => 13,
                'default' => 1,
                'range' => [
                    'lower' => 1,
                ],
                'required' => true,
            ],
        ],
        'editorial_note' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.abstractBase.editorialNote.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max' => 2000,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'authorship_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.authorshipRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_chflex_domain_model_dictionaryentry',
                    'fieldname' => 'authorship_relation',
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
                                'default' => 'authorshipRelation',
                                'readOnly' => true,
                            ],
                        ],
                        'role' => [
                            'config' => [
                                'default' => 'author',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'licence_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.licenceRelation.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'MM' => 'tx_chfbase_domain_model_relation_any_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_chflex_domain_model_encyclopediaentry',
                    'fieldname' => 'licence_relation',
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
                                'default' => 'licenceRelation',
                                'readOnly' => true,
                            ],
                        ],
                        'role' => [
                            'config' => [
                                'default' => 'allContent',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'editorial_steps' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.editorialSteps',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.editorialSteps.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectCheckBox',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.editorialSteps.checkDatabase',
                        'value' => 'checkDatabase',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.editorialSteps.checkForeignLanguage',
                        'value' => 'checkForeignLanguage',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.editorialSteps.checkRegional',
                        'value' => 'checkRegional',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.editorialSteps.checkPrevious',
                        'value' => 'checkPrevious',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.editorialSteps.checkFurther',
                        'value' => 'checkFurther',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.editorialSteps.checkMaps',
                        'value' => 'checkMaps',
                    ],
                ],
            ],
        ],
        'publication_steps' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.publicationSteps',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.publicationSteps.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectCheckBox',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.publicationSteps.started',
                        'value' => 'started',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.publicationSteps.edited',
                        'value' => 'edited',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.publicationSteps.checked',
                        'value' => 'checked',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.publicationSteps.deferred',
                        'value' => 'deferred',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.publicationSteps.revised',
                        'value' => 'revised',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.publicationSteps.publicationReady',
                        'value' => 'publicationReady',
                    ],
                ],
            ],
        ],
        'import_origin' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.importOrigin.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'import' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import',
            'description' => 'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'max' => 100000,
                'eval' => 'trim',
            ],
        ],
        'as_related_record_of_similarity_relation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.asRelatedRecordOfSimilarityRelation',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.abstractEntry.asRelatedRecordOfSimilarityRelation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'similarityRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_any_relatedrecord_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_chflex_domain_model_encyclopediaentry',
                    'fieldname' => 'as_related_record_of_similarity_relation',
                ],
                'MM_opposite_field' => 'related_record',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
    ],
    'palettes' => [
        'contentElementFootnote' => [
            'showitem' => 'content_element,--linebreak--,footnote,',
        ],
        'mediaFile' => [
            'showitem' => 'media,--linebreak--,file,',
        ],
        'sourceRelationLinkRelation' => [
            'showitem' => 'source_relation,--linebreak--,link_relation,',
        ],
        'isTeaserIsHighlight' => [
            'showitem' => 'is_teaser,is_highlight,',
        ],
        'iriUuidSameAs' => [
            'showitem' => 'iri,uuid,--linebreak--,same_as,',
        ],
        'publicationDateRevisionDateRevisionNumberEditorialNote' => [
            'showitem' => 'publication_date,revision_date,revision_number,--linebreak--,editorial_note,',
        ],
        'authorshipRelationLicenceRelation' => [
            'showitem' => 'authorship_relation,--linebreak--,licence_relation,',
        ],
        'editorialStepsPublicationSteps' => [
            'showitem' => 'editorial_steps,publication_steps,',
        ],
        'importOriginImport' => [
            'showitem' => 'import_origin,--linebreak--,import,',
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'title,label,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,similarity_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.unstructured,--palette--;;contentElementFootnote,--palette--;;mediaFile,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.bibliography,--palette--;;sourceRelationLinkRelation,publication_relation,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,--palette--;;isTeaserIsHighlight,parent_resource,--palette--;;iriUuidSameAs,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumberEditorialNote,--palette--;;authorshipRelationLicenceRelation,--palette--;;editorialStepsPublicationSteps,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,--palette--;;importOriginImport,
            --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,as_related_record_of_similarity_relation,',
        ],
    ],
];
