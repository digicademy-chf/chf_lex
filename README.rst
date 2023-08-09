..  image:: https://img.shields.io/badge/PHP-8.1/8.2-blue.svg
    :alt: PHP 8.1/8.2
    :target: https://www.php.net/downloads

..  image:: https://img.shields.io/badge/TYPO3-12-orange.svg
    :alt: TYPO3 12
    :target: https://get.typo3.org/version/12

..  image:: https://img.shields.io/badge/License-GPLv3-blue.svg
    :alt: License: GPL v3
    :target: https://www.gnu.org/licenses/gpl-3.0

======
DA Lex
======

This TYPO3 extension for lexicographic resources implements the `DMLex data
model <https://www.oasis-open.org/committees/lexidma>`__, version 1.0 WD1. It
includes the two official modules Controlled Vocabulary and Linking, as well
as a custom Editorial module and in-line annotations. In addition to the data
model, the extension also provides extensible `TEI Lex-0
<https://dariah-eric.github.io/lexicalresources/pages/TEILex0/TEILex0.html>`__
and `OntoLex Lemon <https://www.w3.org/2019/09/lexicog>`__ serialisations
provided through a REST endpoint based on a specification from the EU-funded
Elexis project. In addition to the focus on dictionary entries, the extension
also provides encyclopedic articles and glossary entries as additional data
types.

:Repository:  https://github.com/digicademy/da-lex
:Read online: https://docs.typo3.org/p/da-lex/main/en-us
:TER:         https://extensions.typo3.org/extension/da-lex

Roadmap
=======

This is a pre-release version. The following steps are required for the software to move out of beta:

**Version 0.7.0**

- TCA and model work as expected
- Working frontend plugin

**Version 0.8.0**

- Import of DFD data
- Serialisation(s) of DFD data
- Consider adding a generic search config

**Version 0.9.0**

- Make import generic
- Make serialisation(s) generic

**Version 1.0.0**

- Add testing
- Finish documentation

**Data model conformity**

- In ``Pronunciation``, either ``soundFile`` or ``transcription`` are required
- The ``min`` and ``max`` values of ``Tag``s of the type ``memberRole`` should limit the number of members
- The ``type`` tag of a relation should limit the types of members that may be selected
