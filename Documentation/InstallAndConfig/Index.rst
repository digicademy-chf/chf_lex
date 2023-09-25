..  include:: /Includes.rst.txt

..  _install-and-config:

==================
Install and config
==================

..  rst-class:: bignums

1.  Install the extension

    Add the package name to your ``composer.json`` or install the package
    manually.

2.  Set up a data folder

    In a blank folder in your page tree, add a ``LexicographicResource``.
    Further data, such as entries, needs to be located in the same data folder.
    Each resource of this type ideally lives in its own data folder to keep
    its records separate from other records of the same type.

3.  Optionally add an import task

    To import data once or periodically, go to the :guilabel:`Task` module
    in the backend, add a new task, and select :guilabel:`Import lexicographic
    resource`. Enter the values required to perform the task and either
    start the task manually or set an interval to run the task automatically.

..  _display-the-resource:

====================
Display the resource
====================

To show the lexicographic resource on a specific page of your website, simply
add the :guilabel:`Lexicography` plugin and set it up to use the resource in
question.

If you want to be able to only show select entries from your resource, use
the label function built into the extension. You can add a ``Tag`` of type
:guilabel:`Label` to your data folder and then select it in the entries,
contributors, or relations you want it to apply to. You can then select the
label in the plugin to display only those entries, contributors, or relations.
