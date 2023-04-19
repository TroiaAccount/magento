bin/magento setup:install --base-url=http://magento246.loc/ \
--db-host=localhost --db-name=magento246 --db-user=magento246 --db-password=magento246 \
--admin-firstname=Magento --admin-lastname=User --admin-email=user@example.com \
--admin-user=monteshot --admin-password=M0nteshot --language=en_US \
--currency=USD --timezone=America/Chicago --cleanup-database \
--session-save=redis --use-rewrites=1 \
--search-engine=elasticsearch7 --elasticsearch-host=localhost \
--elasticsearch-port=9200
