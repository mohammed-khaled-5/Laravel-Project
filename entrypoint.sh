#!/bin/bash

# 1. Clear the "memory" of the old 127.0.0.1 settings
php artisan config:clear
php artisan cache:clear

# Force create the link so logos are visible
php artisan storage:link --force

# 2. Fix the Apache MPM conflict
a2dismod mpm_event mpm_worker || true
a2enmod mpm_prefork || true

# 3. Run the migrations to create your tables in the Railway DB
php artisan migrate --force

# 4. Start the server
exec apache2-foreground
