--------------------
Analytics
--------------------
Version 1.2.0-pl
Author: Jérôme Perrin <hello@jeromeperrin.com>
--------------------

Analytics is a utility tool for MODX Revolution to embed Google Universal Analytics (analytics.js) and/or Google Analytics (ga.js)
on your website's pages while ignoring traffic from set contexts and logged-in users.
By default it will ignore traffic from users logged into the manager.

You can also overwrite the tracking code templates.

Basic example calls:
[[!Analytics? &webPropertyID=`UA-XXXXX-Y`]]
[[!Analytics? &webPropertyID=`UA-XXXXX-Y` &setAccount=`UA-XXXXX-Y`]]

Documentation:
http://rtfm.modx.com/extras/revo/analytics
https://developers.google.com/analytics/devguides/collection/upgrade/
https://developers.google.com/analytics/devguides/collection/analyticsjs/
https://developers.google.com/analytics/devguides/collection/gajs/

Bugs & Features on Github:
https://github.com/yogoo/Analytics/issues

Install via MODX Package Management or download from http://modx.com/extras/package/analytics
