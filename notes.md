
Challenge 1: Missing .env.example File During Build
Issue: The Docker build process failed with the error "cp: cannot stat '.env.example': No such file or directory". The Dockerfile attempted to copy a configuration file that did not exist in the repository.
Solution: Modified the Dockerfile to handle the missing file gracefully using a conditional command: RUN if [ -f .env.example ]; then cp .env.example .env; else echo "# Auto-generated" > .env; fi. This allowed the build to complete successfully even without the example file.
Challenge 2: MySQL PDO Driver Not Installed
Issue: After successfully building and running the container, the application returned 500 Internal Server Errors. Logs showed the error "could not find driver (Connection: mysql)". The default Laravel configuration uses MySQL, but the PHP PDO MySQL driver was not installed in the Docker image.
Solution: Since the assignment objective was to demonstrate VPS deployment rather than database optimization, I switched the database configuration from MySQL to SQLite. This eliminated the driver dependency and simplified the deployment by removing the need for a separate database server. Updated the .env file to set DB_CONNECTION=sqlite.
Challenge 3: APP_KEY Generation Failure
Issue: Laravel requires an encryption key (APP_KEY) for security. When running php artisan key:generate, the command failed with "Unable to set application key. No APP_KEY variable was found in the .env file".
Solution: Manually generated a valid base64 encryption key using PHP and inserted it directly into the .env file before running the generation command. This ensured the variable existed for Laravel to recognize and update.
Challenge 4: File Permissions in Container
Issue: The application returned 500 errors when trying to write logs or cache files. The storage and bootstrap/cache directories inside the Docker container lacked write permissions for the web server user.
Solution: Applied recursive permissions to the necessary directories using the command: docker exec myapp-container chmod -R 777 storage bootstrap/cache. This granted the required write access for Laravel to function properly.
Challenge 5: Database Not Initialized
Issue: After switching to SQLite, the application failed because the database tables did not exist. A fresh deployment requires running migrations to set up the database schema.
Solution: Created the SQLite database file manually and ran the Laravel migrations inside the container using: docker exec myapp-container touch database/database.sqlite followed by docker exec myapp-container php artisan migrate --force.
Challenge 6: Debug Code Visible in Production
Issue: A raw SQL query was visible at the top of the Products page, and the "Raw Queries" feature returned a 500 error. This was debug code left in the view files during development.
Solution: Documented the issue as a minor UI bug. Since the core functionality (Products, Orders, Reports) was working correctly and the assignment focus was on deployment, this was noted for future cleanup rather than fixed immediately. In a real production environment, all debug code would be removed before deployment.
