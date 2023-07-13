
## Laravel Sanctum Setup
    1. composer require laravel/sanctum
    2. php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    3. php artisan migrate
    4. Modify User Model

    use Laravel\Sanctum\HasApiTokens;
 
    class User extends Authenticatable
    {
        use HasApiTokens, HasFactory;
    }


    5. Manipulate the redirect function in the app\Middleware\Authenticate.php

    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('unauthorized');
    }

    6. Add the route for the unauthenticated requests in api.php
    Route::get('/unauthorized', function(){
        return [
            "message"=>"unauthorized"
        ];

    })->name('unauthorized');

## Cors Setup
    1. Add the folllowing to the app\Http\Kernel.php

    protected $middleware = [
        ... Other classes
        \Illuminate\Http\Middleware\HandleCors::class,
    ];




    