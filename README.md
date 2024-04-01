Laravel Todolist<a name="TOP"></a>
================

- - - -

### 1. Membuat Project Laravel ###

* **composer create-project laravel/laravel=9.1.5 laravel-todolist**


### 2. Membuat User Service ###

1. Membuat folder baru **Services** di folder ***app***.

2. Menambahkan file interface **UserService.php** pada folder **Services** untuk kontrak implementation.

3. Membuat folder baru **Impl** di **Services** sebagai wadah file class implementation.

4. Menambahkan file class **UserServiceImpl.php** di dalam folder **Impl** untuk menulis implementation details beserta tahap-tahapan function.


5. Dependency Injection di dalam **Providers** menggunakan syntax di terminal.

    * **php artisan make:provider UserServiceProvider.php**

6. Meregistrasikan **UserServiceProvider.php** di ***config\app.php*** pada baris Application Service Providers.

    * **App\Providers\UserServiceProvider::class**

### 3. Membuat Logic Login ###

1. Membuat kontrak function login di ***app\Services\UserService.php*** dengan *boolean*

2. Mengimplementasikan function tersebut di ***app\Services\Impl\UserServiceImpl.php*** serta menambahkan data user menggunakan method memory.

3. Membuat logic login di file implementation tersebut.
```php
function login(string $user, string $password): bool
    {
        if (!isset($this->users[$user])) {
        return false;
    }

    $correctPassword = $this->users[$user];
    return $password == $correctPassword;
    }
```
        
### 4. Template ###


