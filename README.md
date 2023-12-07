# TYPO3 Extension `advertising`
[![TYPO3 11](https://img.shields.io/badge/TYPO3-11-orange.svg)](https://get.typo3.org/version/11) [![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/slavlee/5)

Advertising is a native TYPO3 extension without any dependencies. Create advertising campaigns for you or your customers and post them on your TYPO3 page. It is as easy as to publish an image element.

## 1 Features

* Native TYPO3 Extension, no external service required
* 100% GDPR compliance (no cookies, no profiling, no personal data is tracked or processed)
* View statistic metrics as a backend module (Delivered, Clicked, Click-Through-Rate)
* Embed individual banner
* Embed a zone which shows the assigned banner in a random way
* Set start- and end date and time of your campaigns

## 2 Usage

### 2.1 Installation

#### Installation as extension from TYPO3 Extension Repository (TER)
Download and install the [extension][1] with the extension manager module.

### 2.2 Minimal setup

1) Create a new folder and name it as you want
2) Edit this sysfolder and go to **Behaviour** and choose the Advertising plugin
3) Go to the **Resources** tab and choose **Page TSConfig**: EXT:advertising and save the folder
4) Edit your root page template and go to the **Includes tab** and choose the EXT:advertising static file.
5) Go to the Admin Tools: **settings** and click on **Configure extensions**. Edit there the **Storage Page** for the extension: **advertising**
6) Now you are ready to create customers, campaign, zones and banners inside the new folder you have created in step 1 

## 3 How do you should use this extension
Before you create your first banner, go to the created sysfolder and create there at least one customer and campaign. Every banner needs to be assigned to a customer and a campaign. 
If you don't have a customer, then create an customer entity for yourself.

The zones are optional, because you also can create individual banners on your TYPO3 page. You will find the banner and zone in the content element browser.

### 3.1 Campaign
A campaign holds the information to decide if an advertising material shall be displayed in the frontent. For the moment you can set start- und endtime. You can also let them empty, then your campaign is always active.

### 3.2 Customer
A customer is just a name and groups the campaigns and banners to a person or organization. It is used to give you the opportunity to sell advertising spots on your website for your customers.

### 3.3 Zone
A zone is a content element which shows only one banner at a time. If multiple banners are assigned to this zone and have active campaigns, then it will take randomly one banner from the list. 
At the moment there are no priorizations, but they will come in future releases.

### 3.4 Banner
A banner is the only advertising material you can take at the moment, but they will come more in future releases. 
A Banner is just a image with a link behind it. Every appearance on the website and click will be tracked with asynchronous JavaScript.

## 4 Display statistics
There is a new backend module for admins: Advertising. This module shows a dashboard with all available statistic data for campaigns and their banners.
At the moment the extension only shows the following data:
- delivered (increment when banner is display in the frontend)
- clicked (increment when user clicked on the banner)
- Click-Through-Rate (CTR). Factor of clicked/delivered.

## 5 Tracking
The tracking is done with a asynchronous JavaScript. It is not perfect but the best solution. It can happen in different circumstances, that advertising misses a delivered or clicked event. This usually can happen, when:

- User left the page quicker than the script loads
- User clicked on an advertising material quicker than the script loads

That's why the data is not 100% accurate, but it is a very good guess.

## 6 Changelog
The changelogs can be found inside the CHANGES.md file.

### 6.1 Release Management

Advertising uses [**semantic versioning**][2], which means, that
* **bugfix updates** (e.g. 1.0.0 => 1.0.1) just includes small bugfixes or security relevant stuff without breaking changes,
* **minor updates** (e.g. 1.0.0 => 1.1.0) includes new features and smaller tasks without breaking changes,
* and **major updates** (e.g. 1.0.0 => 2.0.0) breaking changes wich can be refactorings, features or bugfixes.

Having this said, I **highly recommend** to make a update from your whole webpage before upgrading advertising to any version.

## Thanks to my contributors
- Dmitry Dulepov

## 7 Final words
I give my best to make this extension as accurate and as reliable as I can. Unfortunately I can't promise or guarantee that the tracking will always be working. 
Also, there are a lot of external potentials that this extension can't work. For example JavaScript tend to stop working and certain error types. 

That's why I can not take any responsibilities of problems you may walk into, when this extension does not perform at all or creating false data.

All I can is to give my very best to make this extension as best as I can.

[1]: https://extensions.typo3.org/extension/advertising
[2]: https://semver.org/