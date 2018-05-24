dans /etc/apache2/apache2.conf changer :


<Directory /home/stagiaire/projets/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>


commande : sudo a2enmod rewrite

