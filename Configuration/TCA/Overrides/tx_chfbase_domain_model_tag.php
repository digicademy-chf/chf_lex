<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * AbstractTag and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add select item group 'chfLex'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup('tx_chfbase_domain_model_tag', 'type',
    'chfLex',
    'LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.chfLex'
);

// Add select item 'partOfSpeechTag'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_tag', 'type',
    [
        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.partOfSpeechTag.type.partOfSpeechTag',
        'value' => 'partOfSpeechTag',
        'group' => 'chfLex',
    ]
);

// Add select item 'inflectionTypeTag'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_tag', 'type',
    [
        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.inflectionTypeTag.type.inflectionTypeTag',
        'value' => 'inflectionTypeTag',
        'group' => 'chfLex',
    ]
);

// Add select item 'definitionTypeTag'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_tag', 'type',
    [
        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.definitionTypeTag.type.definitionTypeTag',
        'value' => 'definitionTypeTag',
        'group' => 'chfLex',
    ]
);

// Add select item 'transcriptionSchemeTag'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_tag', 'type',
    [
        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.transcriptionSchemeTag.type.transcriptionSchemeTag',
        'value' => 'transcriptionSchemeTag',
        'group' => 'chfLex',
    ]
);

// Add select item 'relationTypeTag'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_tag', 'type',
    [
        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.type.relationTypeTag',
        'value' => 'relationTypeTag',
        'group' => 'chfLex',
    ]
);

// Add select item 'memberRoleTag'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_tag', 'type',
    [
        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.type.memberRoleTag',
        'value' => 'memberRoleTag',
        'group' => 'chfLex',
    ]
);

// Add columns 'parentRelationTypeTag', 'for', 'scopeRestriction', 'memberRole',
// 'memberType', 'min', 'max', 'hint', 'asLabelOfDictionaryEntry',
// 'asLabelOfEncyclopediaEntry', 'asLabelOfInflectedForm', 'asLabelOfSense',
// 'asLabelOfPronunciation', 'asLabelOfExample',
// 'asPartOfSpeechOfDictionaryEntry', 'asInflectionTypeOfInflectedForm',
// 'asDefinitionTypeOfDefinition', 'asSchemeOfTranscription',
// 'asLexicographicRelationTypeOfLexicographicRelation', 'asRoleOfMember', and
// 'asLabelOfFileGroup'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_tag',
    [
        'parentRelationTypeTag' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.parentRelationTypeTag',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.parentRelationTypeTag.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'relationTypeTag\'',
                'treeConfig' => [
                    'parentField' => 'parentRelationTypeTag',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                    ],
                ],
                'maxitems' => 1,
                'size' => 8,
            ],
        ],
        'for' => [
            'exclude' => true,
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.inflectionTypeTag.for',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.inflectionTypeTag.for.description',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'scopeRestriction' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.scopeRestriction',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.scopeRestriction.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => '0',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.scopeRestriction.any',
                        'value' => 'any',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.scopeRestriction.sameResource',
                        'value' => 'sameResource',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.scopeRestriction.sameEntry',
                        'value' => 'sameEntry',
                    ],
                ],
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
        'memberRole' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.memberRole',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.memberRole.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_field' => 'parentRelationTypeTag',
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
                                'items' => [
                                    [
                                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.type.memberRoleTag',
                                        'value' => 'memberRoleTag',
                                        'group' => 'chfLex',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'memberType' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.memberType',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.memberType.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.memberType.entry',
                        'value' => 'entry',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.memberType.encyclopediaEntry',
                        'value' => 'encyclopediaEntry',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.memberType.sense',
                        'value' => 'sense',
                    ],
                ],
                'sortItems' => [
                    'label' => 'asc',
                ],
                'required' => true,
            ],
        ],
        'min' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.min',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.min.description',
            'config' => [
                'type' => 'number',
                'size' => 13,
                'range' => [
                    'lower' => 0,
                ],
            ],
        ],
        'max' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.max',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.max.description',
            'config' => [
                'type' => 'number',
                'size' => 13,
                'range' => [
                    'lower' => 0,
                ],
            ],
        ],
        'hint' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.hint',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.hint.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => '0',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.hint.embed',
                        'value' => 'embed',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.hint.navigate',
                        'value' => 'navigate',
                    ],
                    [
                        'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.hint.none',
                        'value' => 'none',
                    ],
                ],
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
        'asLabelOfDictionaryEntry' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfDictionaryEntry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfDictionaryEntry.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chflex_domain_model_dictionary_entry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_dictionary_entry}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chflex_domain_model_dictionary_entry_tag_label_mm',
                'MM_opposite_field' => 'label',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asLabelOfEncyclopediaEntry' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfEncyclopediaEntry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfEncyclopediaEntry.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chflex_domain_model_encyclopedia_entry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_encyclopedia_entry}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chflex_domain_model_encyclopedia_entry_tag_label_mm',
                'MM_opposite_field' => 'label',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asLabelOfInflectedForm' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfInflectedForm',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfInflectedForm.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chflex_domain_model_inflected_form',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_inflected_form}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chflex_domain_model_inflected_form_tag_label_mm',
                'MM_opposite_field' => 'label',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asLabelOfSense' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfSense',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfSense.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chflex_domain_model_sense',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_sense}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chflex_domain_model_sense_tag_label_mm',
                'MM_opposite_field' => 'label',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asLabelOfPronunciation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfPronunciation',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfPronunciation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chflex_domain_model_pronunciation',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_pronunciation}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chflex_domain_model_pronunciation_tag_label_mm',
                'MM_opposite_field' => 'label',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asLabelOfExample' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfExample',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.labelTag.asLabelOfExample.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chflex_domain_model_example',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_example}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chflex_domain_model_example_tag_label_mm',
                'MM_opposite_field' => 'label',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asPartOfSpeechOfDictionaryEntry' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.partOfSpeechTag.asPartOfSpeechOfDictionaryEntry',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.partOfSpeechTag.asPartOfSpeechOfDictionaryEntry.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chflex_domain_model_dictionary_entry',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_dictionary_entry}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chflex_domain_model_dictionary_entry_tag_partofspeech_mm',
                'MM_opposite_field' => 'partOfSpeech',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asInflectionTypeOfInflectedForm' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.inflectionTypeTag.asInflectionTypeOfInflectedForm',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.inflectionTypeTag.asInflectionTypeOfInflectedForm.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chflex_domain_model_inflected_form',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_inflected_form}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chflex_domain_model_inflected_form_tag_inflectiontype_mm',
                'MM_opposite_field' => 'inflectionType',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asDefinitionTypeOfDefinition' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.definitionTypeTag.asDefinitionTypeOfDefinition',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.definitionTypeTag.asDefinitionTypeOfDefinition.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chflex_domain_model_definition',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_definition}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chflex_domain_model_definition_tag_definitiontype_mm',
                'MM_opposite_field' => 'definitionType',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asSchemeOfTranscription' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.transcriptionSchemeTag.asSchemeOfTranscription',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.transcriptionSchemeTag.asSchemeOfTranscription.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chflex_domain_model_transcription',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_transcription}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chflex_domain_model_transcription_tag_scheme_mm',
                'MM_opposite_field' => 'scheme',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asLexicographicRelationTypeOfLexicographicRelation' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.asLexicographicRelationTypeOfLexicographicRelation',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.asLexicographicRelationTypeOfLexicographicRelation.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_relation',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_relation}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_relation}.{#type}=\'lexicographicRelation\'',
                'MM' => 'tx_chfbase_domain_model_relation_tag_lexrelationtype_mm',
                'MM_opposite_field' => 'lexicographicRelationType',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
        'asRoleOfMember' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.asRoleOfMember',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.asRoleOfMember.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chflex_domain_model_member',
                'foreign_table_where' => 'AND {#tx_chflex_domain_model_member}.{#pid}=###CURRENT_PID###',
                'MM' => 'tx_chflex_domain_model_member_tag_role_mm',
                'MM_opposite_field' => 'role',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
    ]
);

// Create palette 'memberTypeHint'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tx_chfbase_domain_model_tag',
    'memberTypeHint',
    'memberType,hint,'
);

// Create palette 'minMax'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tx_chfbase_domain_model_tag',
    'minMax',
    'min,max,'
);

// Create palette 'parentResourceParentRelationTypeTag'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tx_chfbase_domain_model_tag',
    'parentResourceParentRelationTypeTag',
    'parentResource,parentRelationTypeTag,'
);

// Add type 'partOfSpeechTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['partOfSpeechTag' => [
    'showitem' => '--palette--;;typeUuid,--palette--;;textCodeDescription,parentResource,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asPartOfSpeechOfDictionaryEntry,',
]];

// Add type 'inflectionTypeTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['inflectionTypeTag' => [
    'showitem' => '--palette--;;typeUuid,--palette--;;textCodeDescription,parentResource,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.restrictions,for,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asInflectionTypeOfInflectedForm,',
]];

// Add type 'definitionTypeTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['definitionTypeTag' => [
    'showitem' => '--palette--;;typeUuid,--palette--;;textCodeDescription,parentResource,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asDefinitionTypeOfDefinition,',
]];

// Add type 'transcriptionSchemeTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['transcriptionSchemeTag' => [
    'showitem' => '--palette--;;typeUuid,--palette--;;textCodeDescription,parentResource,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asSchemeOfTranscription,',
]];

// Add type 'relationTypeTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['relationTypeTag' => [
    'showitem' => '--palette--;;typeUuid,--palette--;;textCodeDescription,parentResource,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.restrictions,scopeRestriction,memberRole,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asLexicographicRelationTypeOfLexicographicRelation,',
]];

// Add type 'memberRoleTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['memberRoleTag' => [
    'showitem' => '--palette--;;typeUuid,--palette--;;textCodeDescription,--palette--;;parentResourceParentRelationTypeTag,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.restrictions,--palette--;;memberTypeHint,--palette--;;minMax,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asRoleOfMember,',
]];
