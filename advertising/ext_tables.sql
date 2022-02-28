CREATE TABLE tt_content (
	name varchar(255) NOT NULL DEFAULT '',
	description varchar(255) NOT NULL DEFAULT '',
	customer int(11) unsigned DEFAULT '0',
	zones int(11) unsigned NOT NULL DEFAULT '0',
	campaigns int(11) unsigned NOT NULL DEFAULT '0',
	ad_type varchar(45) NOT NULL DEFAULT 'image'
);

CREATE TABLE tx_advertising_domain_model_campaign (
	name varchar(255) NOT NULL DEFAULT '',
	description text,
	banners int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_advertising_domain_model_customer (
	name varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_advertising_domain_model_zone (
	name varchar(255) NOT NULL DEFAULT '',
	height varchar(255) NOT NULL DEFAULT '',
	width varchar(255) NOT NULL DEFAULT '',
	banners int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_advertising_domain_model_bannerstatistic (
	delivered varchar(255) NOT NULL DEFAULT '',
	been_visible int(11) NOT NULL DEFAULT '0',
	clicked int(11) NOT NULL DEFAULT '0',
	banner int(11) unsigned DEFAULT '0',
	campaign int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_advertising_domain_model_campaignstatistic (
	priority int(11) NOT NULL DEFAULT '0',
	delivered int(11) NOT NULL DEFAULT '0',
	been_visible int(11) NOT NULL DEFAULT '0',
	clicked int(11) NOT NULL DEFAULT '0',
	banner_persisted text NOT NULL DEFAULT '',
	campaign_persisted text NOT NULL DEFAULT '',
	campaign int(11) unsigned DEFAULT '0',
	banner int(11) unsigned DEFAULT '0'
);
