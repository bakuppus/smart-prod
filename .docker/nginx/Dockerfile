FROM nginx:latest

# Set consistent timezone
ENV CONTAINER_TIMEZONE="UTC"
RUN rm -f /etc/localtime \
 && ln -s /usr/share/zoneinfo/${CONTAINER_TIMEZONE} /etc/localtime

# Install prerequisite OS packages [ Install prerequisite OS packages] 
RUN  DEBIAN_FRONTEND=noninteractive apt-get update \
    && apt-get install -y \
    curl \
    iputils-ping \
    libfcgi0ldbl \
    nano \
    mysql-client


RUN mv /etc/nginx/conf.d/default.conf /etc/nginx/conf.d/default.bak

# Copy Nginx configs.
COPY ./.docker/nginx/default.conf /etc/nginx/conf.d/default.conf

COPY ./app/ /app
RUN chown -R www-data:www-data /app/ 

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]