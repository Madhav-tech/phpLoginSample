FROM php:8.0.10-cli 
COPY . C:/xampp/htdocs/mycode;
WORKDIR C:/xampp/htdocs/mycode;
CMD [ "php", "./index.php" ]