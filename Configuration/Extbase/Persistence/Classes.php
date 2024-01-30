<?php
defined('TYPO3') or die();
declare(strict_types=1);

# This file is part of the extension CHF Lex for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


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
    Digicademy\CHFLex\Domain\Model\Content::class => [
        'tableName' => 'tt_content',
    ],
    Digicademy\CHFLex\Domain\Model\AbstractEntry::class => [
        'tableName'  => 'tx_chflex_domain_model_entry',
        'recordType' => 'abstractEntry',
        'subclasses' => [
            'entry'             => Digicademy\CHFLex\Domain\Model\Entry::class,
            'encyclopediaEntry' => Digicademy\CHFLex\Domain\Model\EncyclopediaEntry::class,
            'glossaryEntry'     => Digicademy\CHFLex\Domain\Model\GlossaryEntry::class,
        ]
    ],
    Digicademy\CHFLex\Domain\Model\AbstractTag::class => [
        'tableName'  => 'tx_chflex_domain_model_tag',
        'recordType' => 'abstractTag',
        'subclasses' => [
            'language'            => Digicademy\CHFLex\Domain\Model\LanguageTag::class,
            'country'             => Digicademy\CHFLex\Domain\Model\CountryTag::class,
            'region'              => Digicademy\CHFLex\Domain\Model\RegionTag::class,
            'label'               => Digicademy\CHFLex\Domain\Model\LabelTag::class,
            'labelType'           => Digicademy\CHFLex\Domain\Model\LabelTypeTag::class,
            'classificationEntry' => Digicademy\CHFLex\Domain\Model\ClassificationEntryTag::class,
            'classificationSense' => Digicademy\CHFLex\Domain\Model\ClassificationSenseTag::class,
            'relationType'        => Digicademy\CHFLex\Domain\Model\RelationTypeTag::class,
            'memberRole'          => Digicademy\CHFLex\Domain\Model\MemberRoleTag::class,
            'sourceIdentity'      => Digicademy\CHFLex\Domain\Model\SourceIdentityTag::class,
            'partOfSpeech'        => Digicademy\CHFLex\Domain\Model\PartOfSpeechTag::class,
            'transcriptionScheme' => Digicademy\CHFLex\Domain\Model\TranscriptionSchemeTag::class,
            'inflectedForm'       => Digicademy\CHFLex\Domain\Model\InflectedFormTag::class,
            'definitionType'      => Digicademy\CHFLex\Domain\Model\DefinitionTypeTag::class,
            'frequencyType'       => Digicademy\CHFLex\Domain\Model\FrequencyTypeTag::class,
        ]
    ],
];
