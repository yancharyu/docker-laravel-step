FROM nginx:1.19-alpine
SHELL ["/bin/ash", "-oeux", "pipefail", "-c"]

ENV TZ='Asia/Tokyo'

RUN apk update && \
  apk add --update --no-cache --virtual=.build-dependencies g++

# nginx config file
COPY ./default.conf /etc/nginx/conf.d/default.conf

WORKDIR /work