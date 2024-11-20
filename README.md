git pull
cp .env.example .env (db: test-elastic, user: root, password: test-elastic, host: db , port: 3306)
docker compose up -d --build
docker exec -it test-app bash
composer install
sudo chmod 777 -R storage/