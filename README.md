# PollVot

How to run app

1. Import database dump located at /database directory.
2. Create .env file with MySQL credentials
3. Install Python and Python packages: sklearn, keras, tensorflow, pandas
4. Make sure Python is globally accessible by setting environment variable
5. Update absolute location of script inside predict_script.py (e.g. G:\Programs\xampp\htdocs\pollvot\cgi-bin) and AjaxController.php (e.g `$str = 'python G:\Programs\xampp\htdocs\pollvot\cgi-bin\predict_script.py '`)
6. Run `composer install` 
7. Run `php artisan serve`
8. Administrator user credentials are email: administrator@pollvot.app and password: 12345678

## Screenshots 
- Home page
![](https://i.ibb.co/KrzLhTz/Screenshot-2022-12-25-at-11-37-05-Poll-Vot.png)

- Register form
![](https://i.ibb.co/LgJBPVq/Screenshot-2022-12-25-at-11-37-23-Poll-Vot.png)

- Waiting for the prediction script computation
![](https://i.ibb.co/txTgPWX/Screenshot-2022-12-25-at-12-04-56-Poll-Vot.png)

- Applying prediction script answer
![](https://i.ibb.co/QPddC9z/Screenshot-2022-12-25-at-12-05-04-Poll-Vot.png)

- Administrator dashboard
![](https://i.ibb.co/g4mr1yT/Screenshot-2022-12-25-at-12-07-46-Poll-Vot.png)

- Administrator generating stats and graphs
![](https://i.ibb.co/hX58sMF/Screenshot-2022-12-25-at-12-07-21-Poll-Vot.png)

- Administrator dashboard showing last votes
![](https://i.ibb.co/HtQw1Yz/Screenshot-2022-12-25-at-12-06-42-Poll-Vot.png)




