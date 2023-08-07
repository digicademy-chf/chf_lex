<?php

# This file is part of the extension DA Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


/**
 * Member and its properties
 * 
 * Configuration of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */
return [
    'ctrl' => [
        'title'                    => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.member',
        'label'                    => 'entryOrSense',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'delete'                   => 'deleted',
        'sortby'                   => 'sorting',
        'default_sortby'           => 'entryOrSense ASC',
        'versioningWS'             => true,
        'iconfile'                 => 'EXT:da_lex/Resources/Public/Icons/Member.svg',
        'origUid'                  => 't3_origuid',
        'hideAtCopy'               => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'translationSource'        => 'l10n_source',
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
                'foreign_table'       => 'tx_dalex_domain_model_member',
                'foreign_table_where' => 'AND {#tx_dalex_domain_model_member}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_dalex_domain_model_member}.{#sys_language_uid} IN (-1,0)',
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
        'role' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.member.role',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.member.role.description',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_dalex_domain_model_tag',
                'foreign_table_where' => 'AND {#tx_dalex_domain_model_tag}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_dalex_domain_model_tag}.{#type}=\'memberRole\'',
                'MM'                  => 'tx_dalex_domain_model_member_tag_role_mm',
            ],
        ],
        'entryOrSense' => [
            'label'       => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.member.entryOrSense',
            'description' => 'LLL:EXT:da_lex/Resources/Private/Language/locallang.xlf:database.member.entryOrSense.description',
            'config'      => [
                'type'     => 'group',
                'minitems' => 1,
                'allowed'  => 'tx_dalex_domain_model_entry,tx_dalex_domain_model_sense',
                'MM'       => 'tx_dalex_domain_model_member_entryorsense_entryorsense_mm',
                'required' => true,
            ], # TODO enforce min/max values from role and type restrictions from parent relation
        ],
    ],
    'palettes' => [],
    'types' => [
        '0' => [
            'showitem' => 'hidden,role,entryOrSense,',
        ],
    ],
];

?>
