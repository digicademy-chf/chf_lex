<?php

# This file is part of the extension DA Lex for TYPO3.
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
        'title'                    => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag',
        'label'                    => 'tag',
        'label_alt'                => 'type',
        'descriptionColumn'        => 'description',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'tag ASC,type ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:da_lex/Resources/Public/Icons/Tag.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
        'type'                     => 'type',
        'searchFields'             => 'tag,type,description,scopeConstraint,min,max,action',
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
                'foreign_table'       => 'tx_dalex_domain_model_tag',
                'foreign_table_where' =>
                    'AND {#tx_dalex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_dalex_domain_model_tag}.{#sys_language_uid} IN (-1,0)',
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
        'tag' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.tag',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.tag.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'type' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.type',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.type.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.language',
                        'value' => 'language',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.country',
                        'value' => 'country',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.region',
                        'value' => 'region',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.label',
                        'value' => 'label',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.relationType',
                        'value' => 'relationType',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.memberRole',
                        'value' => 'memberRole',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.sourceIdentity',
                        'value' => 'sourceIdentity',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.partOfSpeech',
                        'value' => 'partOfSpeech',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.transcriptionScheme',
                        'value' => 'transcriptionScheme',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.inflectionType',
                        'value' => 'inflectionType',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.definitionType',
                        'value' => 'definitionType',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.type.frequencyType',
                        'value' => 'frequencyType',
                    ],
                ],
                'required'   => true,
            ],
        ],
        'code' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.code',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.code.description',
            'config'      => [
                'type' => 'input',
                'size' => 40,
                'max'  => 255,
                'eval' => 'trim',
            ],
        ],
        'description' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.description',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.description.description',
            'config'      => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'max'  => 2000,
                'eval' => 'trim',
            ],
        ],
        'sameAs' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.sameAs',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.sameAs.description',
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
        'partOfSpeechConstraint' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.partOfSpeechConstraint',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.partOfSpeechConstraint.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dalex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dalex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_dalex_domain_model_tag}.{#type}=\'partOfSpeech\''
                . ' ORDER BY tag',
                'MM'                  => 'tx_dalex_domain_model_tag_tag_partofspeechconstraint_mm',
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
        'scopeConstraint' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.scopeConstraint',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.scopeConstraint.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.scopeConstraint.any',
                        'value' => 'any',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.scopeConstraint.sameResource',
                        'value' => 'sameResource',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.scopeConstraint.sameEntry',
                        'value' => 'sameEntry',
                    ],
                ],
            ],
        ],
        'memberRoleConstraint' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.memberRoleConstraint',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.memberRoleConstraint.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectMultipleSideBySide',
                'foreign_table'       => 'tx_dalex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dalex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                . ' AND {#tx_dalex_domain_model_tag}.{#type}=\'memberRole\''
                . ' ORDER BY tag',
                'MM'                  => 'tx_dalex_domain_model_tag_tag_memberroleconstraint_mm',
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
        'memberTypeConstraint' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.memberTypeConstraint',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.memberTypeConstraint.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.memberTypeConstraint.any',
                        'value' => 'any',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.memberTypeConstraint.entry',
                        'value' => 'entry',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.memberTypeConstraint.sense',
                        'value' => 'sense',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.memberTypeConstraint.encyclopediaEntry',
                        'value' => 'encyclopediaEntry',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.memberTypeConstraint.glossaryEntry',
                        'value' => 'glossaryEntry',
                    ],
                ],
            ],
        ],
        'min' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.min',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.min.description',
            'config'      => [
                'type'       => 'number',
            ],
        ],
        'max' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.max',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.max.description',
            'config'      => [
                'type'       => 'number',
            ],
        ],
        'action' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.action',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.tag.action.description',
            'config'      => [
                'type'       => 'select',
                'renderType' => 'selectSingle',
                'items'      => [
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.action.embed',
                        'value' => 'embed',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.action.navigate',
                        'value' => 'navigate',
                    ],
                    [
                        'label' => 'LLL:EXT:da_map/Resources/Private/Language/locallang.xlf:database.tag.action.none',
                        'value' => 'none',
                    ],
                ],
            ],
        ],
    ],
    'palettes' => [
        'tagType' => [
            'showitem' => 'tag,type,',
        ],
        'minMax' => [
            'showitem' => 'min,max,',
        ],
    ],
    'types' => [
        'language' => [
            'showitem' => 'hidden,tagType,code,description,sameAs,',
        ],
        'country' => [
            'showitem' => 'hidden,tagType,description,sameAs,',
        ],
        'region' => [
            'showitem' => 'hidden,tagType,description,sameAs,',
        ],
        'label' => [
            'showitem' => 'hidden,tagType,description,sameAs,
            --div--;LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.constraints,partOfSpeechConstraint,',
        ],
        'relationType' => [
            'showitem' => 'hidden,tagType,description,sameAs,
            --div--;LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.constraints,scopeConstraint,memberRoleConstraint,',
        ],
        'memberRole' => [
            'showitem' => 'hidden,tagType,description,sameAs,
            --div--;LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.constraints,memberTypeConstraint,minMax,action,',
        ],
        'sourceIdentity' => [
            'showitem' => 'hidden,tagType,description,sameAs,',
        ],
        'partOfSpeech' => [
            'showitem' => 'hidden,tagType,description,sameAs,',
        ],
        'transcriptionScheme' => [
            'showitem' => 'hidden,tagType,description,sameAs,',
        ],
        'inflectionType' => [
            'showitem' => 'hidden,tagType,description,sameAs,
            --div--;LLL:EXT:da_bib/Resources/Private/Language/locallang.xlf:database.tag.constraints,partOfSpeechConstraint,',
        ],
        'definitionType' => [
            'showitem' => 'hidden,tagType,description,sameAs,',
        ],
        'frequencyType' => [
            'showitem' => 'hidden,tagType,description,sameAs,',
        ],
    ],
];

?>
