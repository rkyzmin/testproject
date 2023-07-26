cd config
cp db.example.php db.php
cd ..
docker-compose exec -T mysqlapp mysql -uroot -proot kit < migrations/all.sql