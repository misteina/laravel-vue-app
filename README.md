### Setup Steps

1. Download the repository and `cd` into the downloaded folder.

2. From the downloaded folder run `composer install` to download the required Laravel dependencies.

3. The Nginx and MySQL container services will recieve traffic from the host system using ports: `8080` for the Nginx Service and `3307` for the MySQL Service. If these ports are not free on your host system then you should change the ports under the Nginx and MySQL service configurations in the docker-compose.yml file located inside the downloaded folder.

4. Run `docker-compose up` to build and run the application containers.

5. Visit `localhost:8080` or `localhost:<port>` from your browser to open the application with `<port>` representing the configured port if you changed the port in step 3 under the Nginx service in the docker-compose.yml file.


### Additional note

* This application was tested on Firefox 81.0 and uses the `<input type="date">` HTML tag which is not supported on Safari web browser.

* Running the tests using `docker-compose exec app php artisan test` clears the database.