groupadd www \
&& usermod -a -G www  \
&& /usr/local/openresty/luajit/bin/luarocks install lua-resty-auto-ssl \
&& mkdir /etc/resty-auto-ssl \
&& chown -R root:www /etc/resty-auto-ssl/ \
&& chmod -R 775 /etc/resty-auto-ssl/ \
# && openssl req -new -newkey rsa:2048 -days 3650 -nodes -x509 \
#         -subj '/CN=sni-support-required-for-valid-ssl' \
#         -keyout /etc/ssl/resty-auto-ssl-fallback.key \
#         -out /etc/ssl/resty-auto-ssl-fallback.crt >/dev/null