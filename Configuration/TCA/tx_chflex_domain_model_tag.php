<?php

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Tag and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag',
        'label'                    => 'text',
        'label_alt'                => 'type',
        'descriptionColumn'        => 'description',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'text ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:chf_lex/Resources/Public/Icons/Tag.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'type'                     => 'type',
        'searchFields'             => 'id,uuid,text,type,description,scopeConstraint,min,max,action',
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
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#sys_language_uid} IN (-1,0)',
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
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.parent_id',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.parent_id.description',
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
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.id',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.id.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim,uniqueInPid',
                'required' => true,
            ],
        ],
        'uuid' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.uuid',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.uuid.description',
            'config'      => [
                'type'     => 'uuid',
                'size'     => 40,
                'required' => true,
            ],
        ],
        'text' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.text',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.text.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'type' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.language',
                        'value' => 'language',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.country',
                        'value' => 'country',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.region',
                        'value' => 'region',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.label',
                        'value' => 'label',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.labelType',
                        'value' => 'labelType',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.classificationEntry',
                        'value' => 'classificationEntry',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.classificationSense',
                        'value' => 'classificationSense',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.relationType',
                        'value' => 'relationType',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.memberRole',
                        'value' => 'memberRole',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.sourceIdentity',
                        'value' => 'sourceIdentity',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.partOfSpeech',
                        'value' => 'partOfSpeech',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.transcriptionScheme',
                        'value' => 'transcriptionScheme',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.inflectedForm',
                        'value' => 'inflectedForm',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.definitionType',
                        'value' => 'definitionType',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.frequencyType',
                        'value' => 'frequencyType',
                    ],
                ],
                'required'   => true,
            ],
        ],
        'description' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.description',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.description.description',
            'config'      => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max'  => 2000,
                'eval' => 'trim',
            ],
        ],
        'child' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.child',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.child.description',
            'config'      => [
                'type'                => 'inline',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
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
                'overrideChildTca' => [
                    'columns' => [
                        'type' => [
                            'config' => [
                                'items' => [
                                    [
                                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.classificationEntry',
                                        'value' => 'classificationEntry',
                                    ],
                                    [
                                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.type.classificationSense',
                                        'value' => 'classificationSense',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'sameAs' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.sameAs',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.sameAs.description',
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
        'forPartOfSpeech' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.forPartOfSpeech',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.forPartOfSpeech.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'partOfSpeech\'',
                'MM'                  => 'tx_chflex_domain_model_tag_tag_forpartofspeech_mm',
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
        'scope' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.scope',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.scope.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.scope.any',
                        'value' => 'any',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.scope.sameResource',
                        'value' => 'sameResource',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.scope.sameEntry',
                        'value' => 'sameEntry',
                    ],
                ],
            ],
        ],
        'memberRole' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.memberRole',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.memberRole.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'memberRole\'',
                'MM'                  => 'tx_chflex_domain_model_tag_tag_memberrole_mm',
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
        'memberType' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.memberType',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.memberType.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.memberType.any',
                        'value' => 'any',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.memberType.entry',
                        'value' => 'entry',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.memberType.sense',
                        'value' => 'sense',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.memberType.encyclopediaEntry',
                        'value' => 'encyclopediaEntry',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.memberType.glossaryEntry',
                        'value' => 'glossaryEntry',
                    ],
                ],
            ],
        ],
        'labelType' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.labelType',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.labelType.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'labelType\'',
                'MM'                  => 'tx_chflex_domain_model_tag_tag_labeltype_mm',
            ],
        ],
        'min' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.min',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.min.description',
            'config'      => [
                'type'       => 'number',
            ],
        ],
        'max' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.max',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.max.description',
            'config'      => [
                'type'       => 'number',
            ],
        ],
        'action' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.action',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.action.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.action.embed',
                        'value' => 'embed',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.action.navigate',
                        'value' => 'navigate',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.action.none',
                        'value' => 'none',
                    ],
                ],
            ],
        ],
        'asForPartOfSpeechOfTag' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asForPartOfSpeechOfTag',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asForPartOfSpeechOfTag.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'label\'',
                'MM'                  => 'tx_chflex_domain_model_tag_tag_forpartofspeech_mm',
                'MM_opposite_field'   => 'forPartOfSpeech',
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
        'asMemberRoleOfTag' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asMemberRoleOfTag',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asMemberRoleOfTag.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'relationType\'',
                'MM'                  => 'tx_chflex_domain_model_tag_tag_memberrole_mm',
                'MM_opposite_field'   => 'memberRole',
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
        'asLabelOfEntry' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfEntry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfEntry.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_entry}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
        'asLabelOfContributor' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfContributor',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfContributor.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_contributor',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_contributor}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_contributor_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
        'asLabelOfSense' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfSense',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfSense.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_sense',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_sense}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_sense_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
        'asLabelOfExample' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfExample',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfExample.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_example',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_example}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_example_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
        'asLabelOfInflectedForm' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfInflectedForm',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfInflectedForm.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_inflected_form',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_inflected_form}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_inflected_form_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
        'asLabelOfPronunciation' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfPronunciation',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelOfPronunciation.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_pronunciation',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_pronunciation}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_pronunciation_tag_label_mm',
                'MM_opposite_field'   => 'label',
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
        'asCountryOrRegionOfFrequency' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asCountryOrRegionOfFrequency',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asCountryOrRegionOfFrequency.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_frequency',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_frequency}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_frequency_tag_countryorregion_mm',
                'MM_opposite_field'   => 'countryOrRegion',
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
        'asDistributionLanguageOfEntry' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asDistributionLanguageOfEntry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asDistributionLanguageOfEntry.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_entry}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_distributionlanguage_mm',
                'MM_opposite_field'   => 'distributionLanguage',
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
        'asDistributionCountryOfEntry' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asDistributionCountryOfEntry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asDistributionCountryOfEntry.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_entry}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_distributioncountry_mm',
                'MM_opposite_field'   => 'distributionCountry',
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
        'asDistributionRegionOfEntry' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asDistributionRegionOfEntry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asDistributionRegionOfEntry.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_entry}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_distributionregion_mm',
                'MM_opposite_field'   => 'distributionRegion',
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
        'asLabelTypeOfTag' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelTypeOfTag',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asLabelTypeOfTag.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chflex_domain_model_tag}.{#type}=\'label\'',
                'MM'                  => 'tx_chflex_domain_model_tag_tag_labeltype_mm',
                'MM_opposite_field'   => 'labelType',
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
        'asTypeOfDefinition' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asTypeOfDefinition',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asTypeOfDefinition.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_definition',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_definition}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_definition_tag_definitiontype_mm',
                'MM_opposite_field'   => 'definitionType',
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
        'asTypeOfInflectedForm' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asTypeOfInflectedForm',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asTypeOfInflectedForm.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_inflected_form',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_inflected_form}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_inflected_form_tag_inflectiontype_mm',
                'MM_opposite_field'   => 'inflectionType',
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
        'asTypeOfFrequency' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asTypeOfFrequency',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asTypeOfFrequency.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_frequency',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_frequency}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_frequency_tag_type_mm',
                'MM_opposite_field'   => 'type',
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
        'asTypeOfRelation' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asTypeOfRelation',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asTypeOfRelation.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_relation}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_relation_tag_type_mm',
                'MM_opposite_field'   => 'type',
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
        'asSchemeOfTranscription' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asSchemeOfTranscription',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asSchemeOfTranscription.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_transcription',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_transcription}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_transcription_tag_scheme_mm',
                'MM_opposite_field'   => 'scheme',
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
        'asSourceIdentityOfFrequency' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asSourceIdentityOfFrequency',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asSourceIdentityOfFrequency.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_frequency',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_frequency}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_frequency_tag_sourceidentity_mm',
                'MM_opposite_field'   => 'sourceIdentity',
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
        'asSourceIdentityOfExample' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asSourceIdentityOfExample',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asSourceIdentityOfExample.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_example',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_example}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_example_tag_sourceidentity_mm',
                'MM_opposite_field'   => 'sourceIdentity',
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
        'asPartOfSpeechOfEntry' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asPartOfSpeechOfEntry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asPartOfSpeechOfEntry.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_entry}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_partofspeech_mm',
                'MM_opposite_field'   => 'partOfSpeech',
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
        'asRoleOfMember' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asRoleOfMember',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asRoleOfMember.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_member',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_member}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_member_tag_role_mm',
                'MM_opposite_field'   => 'role',
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
        'asClassificationOfEntry' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asClassificationOfEntry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asClassificationOfEntry.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_entry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_entry}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_entry_tag_classification_mm',
                'MM_opposite_field'   => 'classification',
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
        'asClassificationOfSense' => [
            'label'       => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asClassificationOfSense',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.asClassificationOfSense.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_chflex_domain_model_sense',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_sense}.{#pid}=###CURRENT_PID###',
                'MM'                  => 'tx_chflex_domain_model_sense_tag_classification_mm',
                'MM_opposite_field'   => 'classification',
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
        'textType' => [
            'showitem' => 'text,type,',
        ],
        'minMax' => [
            'showitem' => 'min,max,',
        ],
    ],
    'types' => [
        'abstractTag' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,',
        ],
        'language' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asDistributionLanguageOfEntry,',
        ],
        'country' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asCountryOrRegionOfFrequency,asDistributionCountryOfEntry,',
        ],
        'region' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asCountryOrRegionOfFrequency,asDistributionRegionOfEntry,',
        ],
        'label' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.constraints,forPartOfSpeech,labelType,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asLabelOfEntry,asLabelOfContributor,asLabelOfSense,asLabelOfExample,asLabelOfInflectedForm,asLabelOfPronunciation,',
        ],
        'labelType' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asLabelTypeOfTag,',
        ],
        'classificationEntry' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,child,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asClassificationOfEntry,',
        ],
        'classificationSense' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,child,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asClassificationOfSense,',
        ],
        'relationType' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.constraints,scope,memberRole,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asTypeOfRelation,',
        ],
        'memberRole' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.constraints,memberType,minMax,action,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asMemberRoleOfTag,asRoleOfMember,',
        ],
        'sourceIdentity' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asSourceIdentityOfFrequency,asSourceIdentityOfExample,',
        ],
        'partOfSpeech' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asPartOfSpeechOfEntry,asForPartOfSpeechOfTag,',
        ],
        'transcriptionScheme' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asSchemeOfTranscription,',
        ],
        'inflectedForm' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.constraints,forPartOfSpeech,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asTypeOfInflectedForm,',
        ],
        'definitionType' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asTypeOfDefinition,',
        ],
        'frequencyType' => [
            'showitem' => 'hiddenParentId,idUuid,textType,description,sameAs,
            --div--;LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:database.tag.usage,asTypeOfFrequency,',
        ],
    ],
];

?>
