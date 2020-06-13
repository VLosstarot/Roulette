1) php bin/console doctrine:migrations:migrate
2) php bin/console doctrine:fixtures:load
3) POST /roulette json { "Users": ["ivan", "alex"] }
4) GET /statistic
