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
2. Open `layouts/v7/modules/Google/resources/Map.js`
3. Add your API Key in `Map.js` *line 43f.*:

```javascript
loadMapScript : function() {
    var API_KEY = 'YOUR_MAP_API_KEY'; // CONFIGURE THIS 
```

## Restore Volumes

If restoring volumes from one installation in another place the `$site_URL` has to be changed accordingly.

1. open `volumes/vtiger-docker_www/_data/html/vtigercrm/`
2. edit `$site_URL` in `config.inc.php`

Also permissions have to be renewed.

1. open vtiger container CLI
2. run `chmod -R 777 /var/www/html && chmod 644 /etc/cron.d/vtiger-cron && chmod 744 /var/www/html/vtigercrm/cron/vtigercron.sh`
