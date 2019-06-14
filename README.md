DEV:
    windows storage link work around
    https://laracasts.com/discuss/channels/servers/creating-symbolic-link-on-homestead
    ln -sr storage/app/public public/storage

PROD:
    git clone https://github.com/abeatrice/lizmasters.com.git
    cd lizmasters.com
    //update permissions storage, bootstrap
    composer install
    npm install
    npm run production
    php artisan storage:link
    cp .env.example .env

    //update env, include mailgun domain & key

    //create user
    lizmasters.com/register

    //set first user as admin
    php artisan tinker
    $user = App\User::first();
    $user->admin = true;
    $user->save();