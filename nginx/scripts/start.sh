#!/bin/bash

SERVER_NAME=rmct.cn
EMAIL=3475272270@qq.com

# 获取或更新证书
certbot certonly --standalone -d ${SERVER_NAME} --email ${EMAIL} --agree-tos --no-eff-email --non-interactive

# 在检测后台检测脚本是否过期
/scripts/check_ssl_expiry.sh "${SERVER_NAME}" "${EMAIL}" &

# 启动 Nginx
#nginx -g 'daemon off;'
/docker-entrypoint.sh nginx -g 'daemon off;'
