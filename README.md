# DA Lex

- Description: Create and manage lexicographic data in TYPO3
- Author: Jonatan Jalle Steller ([jonatan.steller@adwmainz.de](mailto:jonatan.steller@adwmainz.de))
- Requirements: `typo3/cms-core` 12
- License: GPL 3
- Version: 0.0.2

This TYPO3 extension for lexicographic resources implements the [DMLex data model](https://www.oasis-open.org/committees/lexidma), version 1.0 WD1. It includes the two official modules Controlled Vocabulary and Linking, as well as a custom Editorial module and in-line annotations. In addition to the data model, the extension also provides extensible [TEI Lex-0](https://dariah-eric.github.io/lexicalresources/pages/TEILex0/TEILex0.html) and [OntoLex Lemon](https://www.w3.org/2019/09/lexicog/) serialisations provided through a REST endpoint based on a specification from the EU-funded Elexis project. In addition to the focus on dictionary entries, the extension also provides encyclopedic articles and glossary entries as additional data types.

## Features

## Setup

## Usage

## Development

## Roadmap

- Remove page code, possible error in ext_localconf.php line 65
- Add the data model
- Add documentation for frontend template
- Add TEI Lex-0 and OntoLex Lemon
- Add testing
