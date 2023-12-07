### Version 0.19.0
- [IMPORTANT] Changed file structure for composer, thanks to @dmitryd
- [NOTICE] Changed tags in CHANGES.md. [BREAK] to !!![IMPORTANT], [NEW] to [FEATURE]. So we have now: [IMPORTANT], [FEATURE], [CHANGE], [NOTICE]
- [NOTICE] Rename changelog.txt to CHANGES.md
- [BUGFIX] exception when inserting the Zone plugin in BE, thanks to @dmitryd

### Version 0.18.24
- [CHANGE] Icons for Campaign and BannerStatistic changed to SVG File
- !!![IMPORTANT] Add ad_type to Banner. Execute Compare Database Tool.
- !!![IMPORTANT] New Banner type: Text. Changed Template part. We have new Partials: Image and Text. Image is the old Banner.html Template. Inside the Banner.html is a now switch expression based on ad_type.

### Version 0.17.23
- [BUGFIX] SQL error: 'Unknown column 'campaigns' in 'field list', Re-execute Analyze DB in Install Tool and let the field create inside the tt_content table

### Version 0.17.22
- [FEATURE] Rename extension from advertisement to advertising

### Version 0.16.21
- [FEATURE] Added LICENSE and README.MD

### Version 0.16.20
- [IMPORTANT] First Beta ### Version Release
- [FEATURE] Alle Icons ausgetauscht

### Version 0.15.19
- [FEATURE] Avoid Rendering Banner manually set via content element, if assigned campaigns are not active
- [FEATURE] Hide Campaign and Banner Statistics models from Backend

### Version 0.14.18
- [CHANGE] Zone: Delivered now only banners that are assigned to the zone and at least one active campaign

### Version 0.13.17
- [FEATURE] Translate Click-Through-Rate into german
- [CHANGE] Rename Click Through Rate to Click-Through-Rate
- [BUGFIX] CampaignStatisticRepository->findByCampaignAndBanner Banner wird bei Query nicht berücksichtigt
- [BUGFIX] Campaign: getTotalStatistics: Cache identifier muss Campaign Uid mit einschließen
- [FEATURE] Recalculate Button für Campaign Statistic implementiert

### Version 0.12.16
- [CHANGE] Campaign: There are no Table Filter for Banners yet
- [FEATURE] Deutsche Übersetzung erstellt
- [CHANGE] Campaign: Ausgabe Uhr, nur wenn es auch eine Start- und Endzeit gibt.
- [FEATURE] Campaign and Banner: CTR Calculation

### Version 0.12.15
- [FEATURE] Dashboard: Overview Campaign: Implement Pagination

### Version 0.11.14
- [FEATURE] Show Overview Campaign with real data

### Version 0.10.13
- [CHANGE] BannerStatistic: Extend to relation with campaign
- [CHANGE] BannerStatistic Queries changed to Banner, Campaign and Date as identifier
- [CHANGE] Anzeige Campaign ignoriert Enable Fields
- [FEATURE] Campaign: Anzeige Core Data und Advertising Materials als Overview
- [CHANGE] Campaign: Banner Tabelle ohne Datum
- [FEATURE] TableFilter mit State Selectfeld und Filterung DB Query via Demand Object
- [FEATURE] Campaign State optisch dargestellt in Tabelle

### Version 0.9.12
- [FEATURE] Dashboard: Anzeige aller Banner einer Campaign

### Version 0.8.11
- [CHANGE] StatisticService->findOrCreateBannerStatistic: today normalisiert auf 0 Uhr.
- [WIP] Dashboard: Anzeige Total Campaigns und Banners als Skeletton
- [FEATURE] Dashboard: Anzeige aller Campaigns mit Total Metrics

### Version 0.8.10
- [FEATURE] New Model: BannerStatistic
- [FEATURE] Campaign: Neue Felder startDate und endDate
- [Change] CampaignStatistic ohne Start-und Endtime und Hidden Feld
- [FEATURE] Delivered and Click Tracking on BannerStatistic

### Version 0.7.9
- [FEATURE] Registrierung Backend Modul für Dashboard

### Version 0.7.8
- [FEATURE] Delivered Tracking via AJAX in Frontend 

### Version 0.6.7
- [FEATURE] Clicktracking for banner

### Version 0.5.6
- [FEATURE] New Model CampaignStatistics to savely store the statistics of a active banner ad.
- [FEATURE] CampaignStatistic delivered Tracking based on DataProcessor implemented

### Version 0.4.5
- [CHANGE] Zone: Ausgabe von immer einem zufälligen Banner

### Version 0.3.4
- [FEATURE] Zuweisung Campaign bei Banner
- [FEATURE] Ausgabe Banner (unter- bzw. nacheinander) im Plugin Zone

### Version 0.2.3
- [FEATURE] Banner: Konfiguration CType und allen wichtigen Feldern mit Ausgabe in eigenem Template

### Version 0.1.2
- [FEATURE] Neue CType: Banner
- [FEATURE] Neue Wizard Group: Advertising mit Banner CType und Zone Plugin

### Version 0.0.1
- [FEATURE] Kickstart with Extension Builder