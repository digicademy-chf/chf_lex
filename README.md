# DA Lex

- Description: Create and manage lexicographic data in TYPO3
- Author: Jonatan Jalle Steller ([jonatan.steller@adwmainz.de](mailto:jonatan.steller@adwmainz.de))
- Requirements: `typo3/cms-core` 12
- License: GPL 3
- Version: 0.0.2

This extension provides page types and content elements for lexicographic resources to be used in TYPO3. It implements and adapts the [DMLex data model](https://elex.is/wp-content/uploads/DMLex-a-data-model-for-lexicography-predraft.pdf) for the content management system and includes serialisations such as [TEI Lex-0](https://dariah-eric.github.io/lexicalresources/pages/TEILex0/TEILex0.html) (XML) and [OntoLex Lemon](https://www.w3.org/2019/09/lexicog/) (RDF). The component was originally developed as part of the long-term project Digital Dictionary of Surnames in Germany (DFD), but was built to be re-usable for adjacent data sets and other encyclopedic or dictionary-like content.

## Features

- Page types: dictionary entry, encyclopedia entry, glossary entry
- Languages: English, German

## Setup

## Usage

## Development

## Roadmap

Possible error in ext_localconf.php line 65

- Implement the basic tt_content regions
- Add the required content elements
- Add documentation for frontend template
- Add TEI Lex-0 and OntoLex Lemon
- Add testing
