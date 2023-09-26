..  image:: https://img.shields.io/badge/PHP-8.1/8.2-blue.svg
    :alt: PHP 8.1/8.2
    :target: https://www.php.net/downloads

..  image:: https://img.shields.io/badge/TYPO3-12-orange.svg
    :alt: TYPO3 12
    :target: https://get.typo3.org/version/12

..  image:: https://img.shields.io/badge/License-GPLv3-blue.svg
    :alt: License: GPL v3
    :target: https://www.gnu.org/licenses/gpl-3.0

=======
CHF Lex
=======

This TYPO3 extension for lexicographic resources implements the `DMLex data
model <https://www.oasis-open.org/committees/lexidma>`__, version 1.0 WD1, as
part of the Cultural Heritage Framework (CHF). It includes the two official
modules Controlled Vocabulary and Linking, as well as a custom Editorial
module and in-line annotations. Other additions are intended to make it work
better for dictionaries with a historical component. In addition to the data
model itself, the extension also provides `TEI Lex-0
<https://dariah-eric.github.io/lexicalresources/pages/TEILex0/TEILex0.html>`__
and `OntoLex Lemon <https://www.w3.org/2019/09/lexicog>`__ serialisations
designed so they can be provided through REST endpoints like the one
specified by the EU-funded Elexis project. In addition to dictionary entries,
the extension also allows for encyclopedic entries and works well with
``chf_glossary`` to further integrate glossary entries.

:Repository:  https://github.com/digicademy-chf/chf_lex
:Read online: https://digicademy-chf.github.io/chf_lex
:TER:         https://extensions.typo3.org/extension/chf_lex

Roadmap
=======

This is a pre-release version. The following steps are required for the software to move out of beta:

**Version 0.6.0**

- Move some classes/tables to CHF Base
- Revise data model based on DMLex 1.0 WD1

**Version 0.7.0**

- TCA and model work as expected
- Frontend plugin and templates

**Version 0.8.0**

- Import of *Namenforschung* data
- Embedded metadata

**Version 0.9.0**

- First set of serialisations
- Search configuration

**Version 2.0.0**

- Add API documentation

**Version 2.1.0**

- Add testing
- Generic import
- Additional serialisations

**Known issues**

- Data model conformity: in ``Pronunciation``, either ``soundFile`` or ``transcription`` are required
- Data model conformity: the ``min`` and ``max`` values of ``Tag``s of the type ``memberRole`` should limit the number of members
- Data model conformity: the ``type`` tag of a relation should limit the types of members that may be selected, and ``role`` too
- Needs checking: the config for custom TEI annotations may not work properly and still needs `toolbar buttons <https://ckeditor.com/docs/ckeditor5/latest/api/module_core_editor_editorconfig-EditorConfig.html#member-toolbar>`__
- To do: to use TEI annotations in the frontend, RTE transformations are needed
