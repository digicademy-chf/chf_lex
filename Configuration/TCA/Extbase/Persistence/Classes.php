<?php

declare(strict_types=1);

# This file is part of the extension DA Lex for TYPO3.
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
    Digicademy\DALex\Domain\Model\Content::class => [
        'tableName' => 'tt_content',
    ],
    Digicademy\DALex\Domain\Model\AbstractEntry::class => [
        'tableName'  => 'tx_damap_domain_model_entry',
        'recordType' => 'abstractEntry',
        'subclasses' => [
            'entry'             => Digicademy\DAMap\Domain\Model\Entry::class,
            'encyclopediaEntry' => Digicademy\DAMap\Domain\Model\EncyclopediaEntry::class,
            'glossaryEntry'     => Digicademy\DAMap\Domain\Model\GlossaryEntry::class,
        ]
    ],
    Digicademy\DALex\Domain\Model\AbstractTag::class => [
        'tableName'  => 'tx_damap_domain_model_tag',
        'recordType' => 'abstractTag',
        'subclasses' => [
            'language'            => Digicademy\DAMap\Domain\Model\LanguageTag::class,
            'country'             => Digicademy\DAMap\Domain\Model\CountryTag::class,
            'region'              => Digicademy\DAMap\Domain\Model\RegionTag::class,
            'label'               => Digicademy\DAMap\Domain\Model\LabelTag::class,
            'labelType'           => Digicademy\DAMap\Domain\Model\LabelTypeTag::class,
            'classificationEntry' => Digicademy\DAMap\Domain\Model\ClassificationEntryTag::class,
            'classificationSense' => Digicademy\DAMap\Domain\Model\ClassificationSenseTag::class,
            'relationType'        => Digicademy\DAMap\Domain\Model\RelationTypeTag::class,
            'memberRole'          => Digicademy\DAMap\Domain\Model\MemberRoleTag::class,
            'sourceIdentity'      => Digicademy\DAMap\Domain\Model\SourceIdentityTag::class,
            'partOfSpeech'        => Digicademy\DAMap\Domain\Model\PartOfSpeechTag::class,
            'transcriptionScheme' => Digicademy\DAMap\Domain\Model\TranscriptionSchemeTag::class,
            'inflectedForm'       => Digicademy\DAMap\Domain\Model\InflectedFormTag::class,
            'definitionType'      => Digicademy\DAMap\Domain\Model\DefinitionTypeTag::class,
            'frequencyType'       => Digicademy\DAMap\Domain\Model\FrequencyTypeTag::class,
        ]
    ],
];

?>