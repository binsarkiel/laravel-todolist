Laravel Todolist<a name="TOP"></a>
================

- - - -

## 1. Membuat Project Laravel ##

    composer create-project laravel/laravel=9.1.5 laravel-todolist


## 2. Membuat User Service ##

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

## 3. Membuat Logic Login ##

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
        
## 4. Template ##

1. Membuat file bernama ***template.blade.php*** pada folder **resources/views**, kode template bisa lihat [disini](https://github.com/binsarkiel/laravel-todolist/blob/master/resources/views/template.blade.php).

2. Preview template dengan membuat *routing* baru pada file **web.php**.
    ```php
    Route::view('/template', 'template');
    ```

3. Jalankan server dan buka http://localhost:8000/template untuk melihat hasilnya.


## 5. Membuat User Controller ##

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

## 6. Membuat Login Page ##

1. Buat folder baru bernama "*user*"" di dalam folder **resources\views**.

2. Setelah itu, buat file ***login.blade.php*** di dalamnya. 

3. Gunakan template yang sudah kita buat sebelumnya dari ***resources\views\template.blade.php*** dengan *copy-paste*.

5. Mengatur title HTML dengan Laravel Blade Template.
   ```php
   <title>{{$title}}</title>
   ```

6. Mendefinisikan variable tersebut di ***UserController.php*** sebagai berikut :
   ```php
   public function login(): Response
   {
    return response()
        ->view('user.login', [
            'title' => 'Login'
        ]);
   }
   ```

7. Mengatur error handling di ***login.blade.php*** :
   ```php
   @if(isset($error))
     <div class="row">
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
     </div>
   @endif
   ```

8. Tambahkan `@csrf` setelah container form login untuk input data tokennya.
    ```php
    <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/login">
        
        @csrf
        
        // ... user input
        // ... password input
        // ... sign in button
    
    </form>
    ```
 
## 7. Membuat Login Action ##

1. Dependency Injection untuk **UserService.php** di file ***UserController.php*** lalu kita buat sebagai constructor.
    ```php
    use App\Services\UserService;

    class UserController extends Controller
    {
        private UserService $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        ...
    }
    ```


1. Atur kembali `public function doLogin()` yang kita buat sebelumnya menjadi: 

    ```php
    public function doLogin(Request $request): Response | RedirectResponse
    {
        ...
    }
    ```

2. Setelah itu, tambahkan kode di dalamnya untuk mengambil data input user & password dari halaman login.

    ```php
    $user = $request->input('user');
    $password = $request->input('password');
    ```

3. Memvalidasi input jika user atau password kosong :
    ```php
    if (empty($user) || empty($password)) {
        return response()->view('user.login', [
            'title' => 'Login',
            'error' => 'User or password is required!'
        ]);
    }
    ```

4. Lalu, tambahkan validasi input jika data login sesuai dan langsung redirect masuk ke halaman.
    ```php
    if($this->userService->login($user, $password)) {
        $request->session()->put('user', $user);
        return redirect('/');
    }
    ```

5. Tambahkan juga validasi input jika user atau password salah sebagai berikut :
    ```php
    return response()->view('user.login', [
        'title' => 'Login',
        'error' => "User or password is incorrect!"
    ]);
    ```

## 8. Membuat Logout Action
    to be continued ...