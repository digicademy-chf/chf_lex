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

# Remove when forge.typo3.org/issues/98322 is fixed to auto-generate these fields

CREATE TABLE tx_chflex_domain_model_any_member_ref_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_definition_tag_definitiontype_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_dictionary_entry_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_dictionary_entry_tag_partofspeech_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_encyclopedia_entry_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_example_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_frequency_feature_geodata_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_inflected_form_tag_inflectiontype_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_inflected_form_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_member_tag_role_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_pronunciation_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_sense_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_transcription_tag_scheme_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);
