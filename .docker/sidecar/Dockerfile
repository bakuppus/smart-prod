FROM nginx:latest

# Install prerequisite OS packages [ Install prerequisite OS packages] 
RUN  DEBIAN_FRONTEND=noninteractive apt-get update \
    && apt-get install -y \
    curl \
    iputils-ping \
    libfcgi0ldbl \
    nano \
    wget \
    mysql-client

COPY ./app/ /app
RUN chown -R www-data:www-data /app/ 

CMD ["nginx", "-g", "daemon off;"]