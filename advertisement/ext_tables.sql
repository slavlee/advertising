CREATE TABLE tt_content (
	name varchar(255) NOT NULL DEFAULT '',
	description varchar(255) NOT NULL DEFAULT '',
	customer int(11) unsigned DEFAULT '0',
	zones int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_advertisement_domain_model_campaign (
	name varchar(255) NOT NULL DEFAULT '',
	description text,
	banners int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_advertisement_domain_model_customer (
	name varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_advertisement_domain_model_zone (
	name varchar(255) NOT NULL DEFAULT '',
	height varchar(255) NOT NULL DEFAULT '',
	width varchar(255) NOT NULL DEFAULT ''
);
