<VirtualHost *:80>
    DocumentRoot "D:\code\webroot\web"
    ServerName yii2webroot.com 
    ServerAlias www.yii2webroot.com admin.yii2webroot.com static.yii2webroot.com
    ErrorLog "logs/dummy-host.example.com-error.log"
    CustomLog "logs/dummy-host.example.com-access.log" common
    <Directory "D:\code\webroot\web">
	    Options -Indexes +FollowSymLinks +ExecCGI
	    AllowOverride All
	    Order allow,deny
	    Allow from all
	    Require all granted
	</Directory>
</VirtualHost>