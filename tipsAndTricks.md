# Tips and Tricks

## Workflows

### Set up Corn Job

1. Open CLI of the `vtiger` container
2. run `crontab -e` and choose `nano` as editor
3. add the following line to the end of the opened file
```bash
*/5 * * * * /var/www/html/vtigercrm/cron/vtigercron.sh 
```
4. exit and save

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