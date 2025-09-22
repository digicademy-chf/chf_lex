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

// Add various colums
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_tag',
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
        'scope_restriction' => [
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
        'member_role' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.memberRole',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.relationTypeTag.memberRole.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_field' => 'parent_relation_type_tag',
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
                                'default' => 'memberRoleTag',
                                'readOnly' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'member_type' => [
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
                'default' => 'entry',
                'sortItems' => [
                    'label' => 'asc',
                ],
                'required' => true,
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
        'min' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.min',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.min.description',
            'config' => [
                'type' => 'number',
                'size' => 13,
                'nullable' => true,
                'default' => null,
                'range' => [
                    'lower' => 1,
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
                'nullable' => true,
                'default' => null,
                'range' => [
                    'lower' => 1,
                ],
            ],
        ],
        'parent_relation_type_tag' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.parentRelationTypeTag',
            'description' => 'LLL:EXT:chf_lex/Resources/Private/Language/locallang.xlf:object.memberRoleTag.parentRelationTypeTag.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_chfbase_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_tag}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#pid} IN (###CURRENT_PID###, ###SITE:settings.chf.data.page###)'
                    . ' AND {#tx_chfbase_domain_model_tag}.{#type}=\'relationTypeTag\'',
                'treeConfig' => [
                    'parentField' => 'parent_relation_type_tag',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                    ],
                ],
                'maxitems' => 1,
                'size' => 8,
            ],
        ],
    ]
);

// Create palette 'memberTypeHint'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_chfbase_domain_model_tag',
    'memberTypeHint',
    'member_type,hint,'
);

// Create palette 'minMax'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_chfbase_domain_model_tag',
    'minMax',
    'min,max,'
);

// Create palette 'parentResourceParentRelationTypeTag'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_chfbase_domain_model_tag',
    'parentRelationTypeTagParentResource',
    'parent_relation_type_tag,parent_resource,'
);

// Add type 'partOfSpeechTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['partOfSpeechTag' => [
    'showitem' => 'type,--palette--;;textCode,description,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,same_as,',
]];

// Add type 'inflectionTypeTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['inflectionTypeTag' => [
    'showitem' => 'type,--palette--;;textCode,description,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.restrictions,for,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,same_as,',
]];

// Add type 'definitionTypeTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['definitionTypeTag' => [
    'showitem' => 'type,--palette--;;textCode,description,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,same_as,',
]];

// Add type 'transcriptionSchemeTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['transcriptionSchemeTag' => [
    'showitem' => 'type,--palette--;;textCode,description,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,same_as,',
]];

// Add type 'relationTypeTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['relationTypeTag' => [
    'showitem' => 'type,--palette--;;textCode,description,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.restrictions,scope_restriction,member_role,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,parent_resource,--palette--;;iriUuid,same_as,',
]];

// Add type 'memberRoleTag' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['types'] += ['memberRoleTag' => [
    'showitem' => 'type,--palette--;;textCode,description,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.restrictions,--palette--;;memberTypeHint,--palette--;;minMax,
    --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;parentRelationTypeTagParentResource,--palette--;;iriUuid,same_as,',
]];

// Add opposite usage info to 'items' column
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['columns']['items']['config']['allowed'] .= ',tx_chflex_domain_model_definition,tx_chflex_domain_model_dictionaryentry,tx_chflex_domain_model_example,tx_chflex_domain_model_inflectedform,tx_chflex_domain_model_member,tx_chflex_domain_model_pronunciation,tx_chflex_domain_model_sense,tx_chflex_domain_model_transcription';
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_definition'] = ['definition_type'];
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_dictionaryentry'] = ['part_of_speech', 'label'];
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_example'] = ['label'];
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_inflectedform'] = ['inflection_type', 'label'];
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_member'] = ['role'];
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_pronunciation'] = ['label'];
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_sense'] = ['label'];
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['columns']['items']['config']['MM_oppositeUsage']['tx_chflex_domain_model_transcription'] = ['scheme'];
$GLOBALS['TCA']['tx_chfbase_domain_model_tag']['columns']['items']['config']['MM_oppositeUsage']['tx_chfbase_domain_model_relation'][] = 'lexicographic_relation_type';
