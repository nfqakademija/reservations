HomeToGo.com
===

## Quick start

1. Clone this repository
2. Navigate to cloned directory
3. Run VM, connect to it, navigate to www folder

        vagrant up
        vagrant ssh
        cd /var/www/reservations.dev/

4. Install dependencies

        composer install

5. Create database

        app/console doctrine:database:create

6. Open in browser 
