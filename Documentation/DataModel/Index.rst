..  include:: /Includes.rst.txt

..  _data-model:

==========
Data model
==========

All records of a resource are held together by a single
``LexicographicResource`` which holds the main classes ``DictionaryEntry``,
``EncyclopediaEntry``, ``Agent``, ``Tag``, ``Example``, and
``LexicographicRelation``. A ``DoctionaryEntry`` has a number of dependent
classes that provide information that may be needed multiple times per entry:
``Sense``, ``Definition``, ``InflectedForm``, ``Pronunciation``, and
``Transcription``. Defenition and sense are separate to allow for multiple
tiers of definitions according to, for example, their difficulty.

An additional ``Agent`` class is employed to name authors and editors of
entries. An ``Example`` class may be used to provide historical or contemporary
evidence of an entry or sense. A ``Frequency`` class may similarly be attached
to either an entry or a sense in order to provide the number of tokens from a
specified dataset, and can be connected to a ``Feature`` class from the
`CHF Map <https://github.com/digicademy-chf/chf_map>`__ extension. Across the
data model, a ``SourceRelation`` from the `CHF Bib
<https://github.com/digicademy-chf/chf_bib>`__ extension may be used to
identify sources.

The model does not have a separate class for headwords, which are simply
organised using an entry's ``headword`` property. To provide information about
how entries of all types interconnect, including lemmatisation, the class
``LexicographicRelation`` lets you choose a type of relation you want to model
and add as many ``Member``s as you like.

In addition, the model knows flexible ``LabelTag``s and ``SameAs`` classes,
which can be used to group entries, agents, and examples via labels, to add various
types across other classes, and to connect entities to authority files.

For further information on the data model (without the additions specific to
this implementation), see the official specification of DMLex published by the
`OASIS committee LEXIDMA <https://www.oasis-open.org/committees/lexidma>`__.

..  _graphical-overview:

Graphical overview
==================

..  figure:: /DataModel/DataModel.png
    :alt: Data model of the extension
    :target: /DataModel/DataModel.png
    :class: with-shadow

    Overview of the extension's data model. Check the :ref:`api-reference`
    for further details.
