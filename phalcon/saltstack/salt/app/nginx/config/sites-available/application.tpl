server {
  listen 80;
  listen 8080 default_server;
  server_name {{ host }};

  root {{ root }}/web;
  index index.php;
  try_files $uri $uri/ @rewrite;

  location @rewrite {
    rewrite ^(.*)$ /index.php?_url=$1;
  }

  location ~ \.php {
    fastcgi_pass php-fpm;
    fastcgi_index /index.php;

    include /etc/nginx/fastcgi_params;

    fastcgi_split_path_info       ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO       $fastcgi_path_info;
    fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_param ENVIRONMENT     {{ app_env }};
  }
}
