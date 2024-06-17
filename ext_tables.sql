# Remove after TYPO3 13.2 when all fields are being auto-created

CREATE TABLE tx_chflex_domain_model_dictionary_entry (
    headword varchar(255) DEFAULT '' NOT NULL,
    editorialQuery varchar(255) DEFAULT '' NOT NULL,
    importOrigin varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_encyclopedia_entry (
    title varchar(255) DEFAULT '' NOT NULL,
    importOrigin varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_example (
    text varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_inflected_form (
    text varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_sense (
    indicator varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_transcription (
    text varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_tag (
    for varchar(255) DEFAULT '' NOT NULL
);
