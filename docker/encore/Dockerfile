FROM node:16-alpine

COPY docker-entrypoint.sh /docker-entrypoint.sh

RUN chmod +x /docker-entrypoint.sh

WORKDIR /app

ENTRYPOINT /docker-entrypoint.sh