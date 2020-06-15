1) php bin/console doctrine:migrations:migrate
2) php bin/console doctrine:fixtures:load
3) POST /roulette json { "users": ["ivan", "alex"] }
4) GET /statistic
