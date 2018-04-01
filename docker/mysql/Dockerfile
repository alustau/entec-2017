FROM mysql:5.7

# Environment variables

RUN /etc/init.d/mysql start && \
        mysql -u root -p${MYSQL_ROOT_PASSWORD} -e "CREATE DATABASE entec2017 CHARACTER SET utf8 COLLATE utf8_general_ci" && \
        mysql -u root -p${MYSQL_ROOT_PASSWORD} -e "SHOW DATABASES"

EXPOSE 3306