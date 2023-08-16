..  include:: /Includes.rst.txt

..  _data-model:

==========
Data model
==========

All records of a resource are held together by a single
``LexicographicResource`` which holds the main classes ``Entry``,
``Contributor``, ``Tag``, and ``Relation``. The core class ``Entry`` may have
the types "Dictionary entry," "Encyclopedia entry," or "Glossary entry." This
choice restricts which fields are exposed for editing. The ``Entry`` has a
number of dependent classes that provide information that may be needed
multiple times per entry: ``Sense``, ``Definition``, ``InflectedForm``,
``Pronunciation``, and ``Transcription``. Defenition and sense are separate to
allow for multiple tiers of definitions according to, for example, their
difficulty.

An additional ``Contributor`` class is employed to name authors and editors of
entries. A ``Frequency`` class may be attached to either an entry or a sense
in order to provide the number of tokens from a specified dataset, and can be
connected to a ``Feature`` class from the `DA Map
<https://github.com/digicademy/da-map>`__ extension. Across the data model, a
``Reference`` from the `DA Bib <https://github.com/digicademy/da-bib>`__
extension may be used to identify sources.

The model does not have a separate class for headwords, which are simply
organised using an entry's ``headword`` property. To provide information about
how entries of all types interconnect, including lemmatisation, the class
``Relation`` lets you choose a type of relation you want to model and add as
many ``Member``s as you like.

In addition, the model knows flexible ``Tag``s and ``SameAs`` classes, which
can be used to group entries and/or contributors via labels, to add various
types across the previous classes, and to connect entities to Linked Open Data.

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

This overview simplifies several object variants into a single item since they
populate the same database table. The following image shows the actual objects.

..  figure:: /DataModel/DataModelVariants.png
    :alt: Variants implied in the data model overview
    :target: /DataModel/DataModelVariants.png
    :class: with-shadow

    Variants of ``Entry`` and ``Tag`` in the data model. Check the
    :ref:`api-reference` for further details.
