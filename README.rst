..  image:: https://img.shields.io/badge/PHP-8.2/8.4-blue.svg
    :alt: PHP 8.2/8.4
    :target: https://www.php.net/downloads

..  image:: https://img.shields.io/badge/TYPO3-13-orange.svg
    :alt: TYPO3 13
    :target: https://get.typo3.org/version/13

..  image:: https://img.shields.io/badge/License-GPLv3-blue.svg
    :alt: License: GPL v3
    :target: https://www.gnu.org/licenses/gpl-3.0

=======
CHF Lex
=======

This TYPO3 extension for lexicographic resources implements the
`DMLex data model <https://www.oasis-open.org/committees/lexidma>`__, version
1.0 CSD01, as part of the Cultural Heritage Framework (CHF). It includes the
two official modules Controlled Vocabulary and Linking, as well as a custom
Editorial module and in-line annotations. Other additions are intended to make
it work better for dictionaries with a historical component. In addition to the
data model itself, the extension also provides
`TEI Lex-0 <https://dariah-eric.github.io/lexicalresources/pages/TEILex0/TEILex0.html>`__
and `OntoLex Lemon <https://www.w3.org/2019/09/lexicog>`__ serialisations
designed so they can be provided through REST endpoints. In addition to
dictionary entries, the extension also allows for encyclopedic entries and
works well with CHF Gloss to further integrate glossary entries.

:Repository:  https://github.com/digicademy-chf/chf_lex
:Read online: https://digicademy-chf.github.io/chf_lex
:TER:         https://extensions.typo3.org/extension/chf_lex

Roadmap
=======

This is a pre-release version. The following steps are required for the software to move out of beta:

- Frontend plugin and templates
- Import of *Namenforschung* data
- Embedded metadata
- First set of serialisations
- Search configuration
- Add API documentation

**Beyond 2.0.0**

- Add testing
- Generic import
- Additional serialisations

**Known issues**

- Data model conformity: in ``Pronunciation``, either ``soundFile`` or ``transcription`` are required
- Data model conformity: the ``min`` and ``max`` values of ``MemberRoleTag`` should limit the number of members
- Needs checking: the config for custom TEI annotations may not work properly and still needs `toolbar buttons <https://ckeditor.com/docs/ckeditor5/latest/api/module_core_editor_editorconfig-EditorConfig.html#member-toolbar>`__
- To do: to use TEI annotations in the frontend, RTE transformations are needed
