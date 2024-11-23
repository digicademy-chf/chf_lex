<?php
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * Rules to map object inheritance to TCA tables
 * 
 * List of inherited object models and how they relate to TCA tables and
 * values of the property specified as 'type' in the TCA config. Simpler
 * objects based on tables of the same name and without multiple types
 * do not need to be listed here since Extbase maps them automatically.
 * For more information on the persistence of Extbase models see
 * https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ExtensionArchitecture/Extbase/Reference/Domain/Persistence.html.
 */
return [
    Digicademy\CHFBase\Domain\Model\AbstractResource::class => [
        'subclasses' => [
            'lexicographicResource' => Digicademy\CHFLex\Domain\Model\LexicographicResource::class,
        ],
    ],
    Digicademy\CHFLex\Domain\Model\LexicographicResource::class => [
        'tableName' => 'tx_chfbase_domain_model_resource',
        'recordType' => 'lexicographicResource',
    ],
    Digicademy\CHFBase\Domain\Model\AbstractTag::class => [
        'subclasses' => [
            'partOfSpeechTag' => Digicademy\CHFLex\Domain\Model\PartOfSpeechTag::class,
            'inflectionTypeTag' => Digicademy\CHFLex\Domain\Model\InflectionTypeTag::class,
            'definitionTypeTag' => Digicademy\CHFLex\Domain\Model\DefinitionTypeTag::class,
            'transcriptionSchemeTag' => Digicademy\CHFLex\Domain\Model\TranscriptionSchemeTag::class,
            'relationTypeTag' => Digicademy\CHFLex\Domain\Model\RelationTypeTag::class,
            'memberRoleTag' => Digicademy\CHFLex\Domain\Model\MemberRoleTag::class,
        ],
    ],
    Digicademy\CHFLex\Domain\Model\PartOfSpeechTag::class => [
        'tableName' => 'tx_chfbase_domain_model_tag',
        'recordType' => 'partOfSpeechTag',
    ],
    Digicademy\CHFLex\Domain\Model\InflectionTypeTag::class => [
        'tableName' => 'tx_chfbase_domain_model_tag',
        'recordType' => 'inflectionTypeTag',
    ],
    Digicademy\CHFLex\Domain\Model\DefinitionTypeTag::class => [
        'tableName' => 'tx_chfbase_domain_model_tag',
        'recordType' => 'definitionTypeTag',
    ],
    Digicademy\CHFLex\Domain\Model\TranscriptionSchemeTag::class => [
        'tableName' => 'tx_chfbase_domain_model_tag',
        'recordType' => 'transcriptionSchemeTag',
    ],
    Digicademy\CHFLex\Domain\Model\RelationTypeTag::class => [
        'tableName' => 'tx_chfbase_domain_model_tag',
        'recordType' => 'relationTypeTag',
    ],
    Digicademy\CHFLex\Domain\Model\MemberRoleTag::class => [
        'tableName' => 'tx_chfbase_domain_model_tag',
        'recordType' => 'memberRoleTag',
    ],
    Digicademy\CHFBase\Domain\Model\AbstractRelation::class => [
        'subclasses' => [
            'similarityRelation' => Digicademy\CHFLex\Domain\Model\SimilarityRelation::class,
            'lexicographicRelation' => Digicademy\CHFLex\Domain\Model\LexicographicRelation::class,
        ],
    ],
    Digicademy\CHFLex\Domain\Model\SimilarityRelation::class => [
        'tableName' => 'tx_chfbase_domain_model_relation',
        'recordType' => 'similarityRelation',
    ],
    Digicademy\CHFLex\Domain\Model\LexicographicRelation::class => [
        'tableName' => 'tx_chfbase_domain_model_relation',
        'recordType' => 'lexicographicRelation',
    ],
];
