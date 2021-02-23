

# ErrorDocument 404 http://localhost/
Argument Status Url


# <Files ~ "^\.(htaccess|htpasswd)$">
# deny from all
# </Files>
# order deny,allow

Hide The types from all


#  <FilesMatch "\.(jpg|jpeg|png|gif|swf)$">
#   	Header set Cache-Control "max-age: 604800, public"
#  </FilesMatch>
Cash memory te save rakhte


#  RewriteEngine On
#  RewriteCond %{REQUEST_FILENAME} !-f
#  RewriteRule ^([^\.]+)$ $1.php [NC,L]

Remove .php from file



Parameter Controll


RewriteRule ^user/([a-zA-Z0-9\-=&_@\.\,\)\(]*)/([a-zA-Z0-9\-=&_@\.\,\)\(]*)/([a-zA-Z0-9\-=&_@\.\,\)\(]*)$ /image_folder/image.php?param1=$1&param2=$2&param3=$3 [NC,L]


RewriteRule ^user/([a-zA-Z0-9\-=&_@\.\,\)\(]*)/([a-zA-Z0-9\-=&_@\.\,\)\(]*)$ /image_folder/image.php?param1=$1&param2=$2 [NC,L]


RewriteRule ^user/([a-zA-Z0-9\-=&_@\.\,\)\(]*)$ /image_folder/image.php?param1=$1 [NC,L]

RewriteRule ^user image_folder/image.php [NC,L]
