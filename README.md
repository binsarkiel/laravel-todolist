Laravel Todolist<a name="TOP"></a>
================

- - - -

### 1. Membuat Project Laravel ###

    composer create-project laravel/laravel=9.1.5 laravel-todolist


### 2. Membuat User Service ###

1. Membuat folder baru **Services** di folder ***app***.

2. Menambahkan file interface **UserService.php** pada folder **Services** untuk kontrak implementation.

```php
interface UserService
{
    function login (string $user, string $password): bool;
}
```

3. Membuat folder baru **Impl** di **Services** sebagai wadah file class implementation.

4. Menambahkan file class **UserServiceImpl.php** di dalam folder **Impl** untuk menulis implementation details beserta tahap-tahapan function.




5. Dependency Injection di dalam **Providers** menggunakan syntax di terminal.

       php artisan make:provider UserServiceProvider.php

6. Meregistrasikan **UserServiceProvider.php** di ***config\app.php*** pada baris Application Service Providers.

    ```php
    App\Providers\UserServiceProvider::class
    ```

### 3. Membuat Logic Login ###

1. Membuat kontrak function login di ***app\Services\UserService.php*** dengan *boolean*.

2. Mengimplementasikan function tersebut di ***app\Services\Impl\UserServiceImpl.php*** serta menambahkan data user menggunakan method memory.

3. Membuat logic login di file implementation tersebut.
```php
private array $users = [
    "binsarkiel" => "rahasia"
];

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

1. Membuat file bernama ***template.blade.php*** pada folder **resources/views**, kode template bisa lihat [disini](https://github.com/binsarkiel/laravel-todolist/blob/master/resources/views/template.blade.php).

2. Preview template dengan membuat *routing* baru pada file **web.php**.
    ```php
    Route::view('/template', 'template');
    ```

3. Jalankan server dan buka http://localhost:8000/template untuk melihat hasilnya.


### 5. Membuat User Controller ###

1. Untuk membuatnya, gunakan perintah berikut :

   ```
   php artisan make:controller UserController
   ```

2. Membuat public function untuk menampilkan halaman login, beserta aksi untuk melakukan login dan logout.
   
   ```php
   public function login()
   {
    // ..
   }
   public function doLogin()
   {
    // ...
   }
   public function doLogout()
   {
    // ...
   }
   ```

3. Setelah itu, tambahkan *routes* untuk **UserController.php** di dalam file **web.php** sebagai berikut : 

   ```php
   Route::controller(UserController::class)->group(function () {
        Route::get('/login', 'login');
        Route::post('/login', 'doLogin');
        Route::post('/logout', 'doLogout');
   });
   ```