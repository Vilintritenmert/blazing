#Currency list 

##Installation

1. Clone project 
2. In Project directory run command composer install
3. Add to crontab text "15 * * * * php /path-to-your-project/artisan update_currency >> /dev/null 2>&1"
4. Install Docker + Docker-Compose 
5. Run docker-compose up - d
6. Enjoy 