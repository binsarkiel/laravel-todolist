Laravel Todolist<a name="TOP"></a>
================

- - - -

### I. Membuat Project Laravel ###

* *composer create-project laravel/laravel=9.1.5 laravel-todolist*


### II. Membuat User Service ###

1. Membuat folder baru *Services* di ***app***.

2. Menambahkan file interface *UserService.php* pada folder *Services* untuk kontrak implementatation.

3. Membuat folder baru ***Impl*** di *Services* untuk wadah file class implementation.

4. Menambahkan file class "UserServiceImpl.php" di dalam folder ***Impl*** untuk menulis implementation details beserta tahap-tahapan function.


5. Dependency Injection di dalam ***Providers*** menggunakan syntax di terminal.

    * **php artisan make:provider UserServiceProvider.php**

6. Meregistrasikan *UserServiceProvider.php* di ***config\app.php***.

    * **App\Providers\UserServiceProvider::class**