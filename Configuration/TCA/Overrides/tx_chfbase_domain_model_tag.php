<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * PartOfSpeechTag, InflectionTypeTag, DefinitionTypeTag,
 * TranscriptionSchemeTag, RelationTypeTag, MemberRoleTag,
 * and their properties
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

// Add columns 'for', 'scopeRestriction', 'memberRole', 'memberType', 'min',
// 'max', 'hint', 'asPartOfSpeechOfDictionaryEntry', 'asInflectionTypeOfInflectedForm',
// 'asDefinitionTypeOfDefinition', 'asSchemeOfTranscription',
// 'asLexicographicRelationTypeOfLexicographicRelation', and 'asMemberRoleOfRelationTypeTag
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_relation',
    [
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
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'memberRoleTag\'',
                'MM' => 'tx_chfbase_domain_model_tag_tag_memberrole_mm',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
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
            ],
        ],
        'max' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.min',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.min.description',
            'config' => [
                'type' => 'number',
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
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'readOnly' => true,
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
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'readOnly' => true,
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
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'readOnly' => true,
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
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'readOnly' => true,
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
                'MM' => 'tx_chfbase_domain_model_relation_tag_lexicographicrelationtype_mm',
                'MM_opposite_field' => 'lexicographicRelationType',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'readOnly' => true,
            ],
        ],
        'asMemberRoleOfRelationTypeTag' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.asMemberRoleOfRelationTypeTag',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.asMemberRoleOfRelationTypeTag.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'relationTypeTag\'',
                'MM' => 'tx_chfbase_domain_model_tag_tag_memberrole_mm',
                'MM_opposite_field' => 'memberRole',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'readOnly' => true,
            ],
        ],
    ]
);

// Create palette 'minMax'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tx_chfbase_domain_model_tag',
    'minMax',
    'min,max,'
);

// Add type 'partOfSpeechTag' and its 'showitem' list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_chfbase_domain_model_tag',
    'hiddenParentResource,uuidType,codeText,description,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asPartOfSpeechOfDictionaryEntry,',
    'partOfSpeechTag'
);

// Add type 'inflectionTypeTag' and its 'showitem' list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_chfbase_domain_model_tag',
    'hiddenParentResource,uuidType,codeText,description,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.restrictions,for,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asInflectionTypeOfInflectedForm,',
    'inflectionTypeTag'
);

// Add type 'definitionTypeTag' and its 'showitem' list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_chfbase_domain_model_tag',
    'hiddenParentResource,uuidType,codeText,description,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asDefinitionTypeOfDefinition,',
    'definitionTypeTag'
);

// Add type 'transcriptionSchemeTag' and its 'showitem' list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_chfbase_domain_model_tag',
    'hiddenParentResource,uuidType,codeText,description,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asSchemeOfTranscription,',
    'transcriptionSchemeTag'
);

// Add type 'relationTypeTag' and its 'showitem' list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_chfbase_domain_model_tag',
    'hiddenParentResource,uuidType,codeText,description,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.restrictions,scopeRestriction,memberRole,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asLexicographicRelationTypeOfLexicographicRelation,',
    'relationTypeTag'
);

// Add type 'memberRoleTag' and its 'showitem' list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_chfbase_domain_model_tag',
    'hiddenParentResource,uuidType,codeText,description,sameAs,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.restrictions,memberType,minMax,hint,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asMemberRoleOfRelationTypeTag,',
    'memberRoleTag'
);