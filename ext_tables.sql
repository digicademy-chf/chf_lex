# Remove when forge.typo3.org/issues/98322 is fixed to auto-generate these fields

CREATE TABLE tx_chfbase_domain_model_relation_any_relatedrecord_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation_tag_lexrelationtype_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_any_member_ref_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_definition_tag_definitiontype_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_dictionaryentry_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_dictionaryentry_tag_partofspeech_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_encyclopediaentry_tag_label_mm (
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

CREATE TABLE tx_chflex_domain_model_inflectedform_tag_inflectiontype_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chflex_domain_model_inflectedform_tag_label_mm (
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
