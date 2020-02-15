# Online Exam System for visually blind

Following is the procedure to setup the system. Please follow step by step and don't miss even a single step.

1) Follow the video in the link to setup for laravel.
   https://laracasts.com/series/laravel-from-scratch-2018/episodes/2
2) Run the following command from the terminal/cmd standing in the root directory of the Projet:
   ``` composer install ```
3) Launch the xampp or wamp and run the mysql services. (install xampp or wamp if not already installed)
4) Open 'localhost/phpmyadmin' in the browser.
5) Create a database named online_exam_blind_non_blind (it is assumed that the user is 'root' with no password in phpmyadmin)
6) Open the terminal/cmd and go to the root directory of the project from the terminal/cmd.
7) Run the following command from terminal
   ``` php artisan migrate ```
8) Now go to phpmyadmin again, select the database you just created.
9) Go to the SQL tab from top bar of phpmyadmin.
10) Paste the following query and click the Go button to execute it.
   ```INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$DErbVMryaybozvj93yE6Yeb15/xBkEVf991g87mi/tjvM3UkuvjD2', 'Administrator', '9hDA6tfSQ3y33YHmS8c3XLpHv4173IzIAh6dTCa6M813l36tC8vurTj4OdyK', '2020-01-25 11:49:41', '2020-01-25 11:49:41');```
11) Run the following command from terminal
   ```php artisan serv```
12) Enter the following url in the browser:
   [http://http://127.0.0.1:8000/](localhost:8000)
   You should see a login form by hitting the url.
13) Login as an admin with the following credentials 
   ```email: admin@gmail.com
   password: imse1122```

Explore the system now :)

