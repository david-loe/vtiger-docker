# Tips and Tricks

## Campagne

### Change Default Campagne Status

1. Open CLI of the `mysql` container
2. run `mysql -p` and enter `pw` as password (or whatever your password is)
3. change `'successful'` and the other strings to your preferred and run the following code
```SQL
USE vtiger_db;

SELECT * FROM vtiger_campaignrelstatus;

UPDATE vtiger_campaignrelstatus
SET campaignrelstatus = 'successful'
WHERE sortorderid = 1;

UPDATE vtiger_campaignrelstatus
SET campaignrelstatus = 'unsuccessful'
WHERE sortorderid = 2;

UPDATE vtiger_campaignrelstatus
SET campaignrelstatus = 'never contact again'
WHERE sortorderid = 3;
```

## Google Maps

### Add API key
1. Get Google Maps Javascript API Key - https://code.google.com/apis/console
2. Open to `layouts/v7/modules/Google/resources/Map.js`
3. Add your API Key in `Map.js` *line 43f.*:

```javascript
loadMapScript : function() {
    var API_KEY = 'YOUR_MAP_API_KEY'; // CONFIGURE THIS 
```
