#!/bin/bash

SERVER_NAME=<网站域名>
EMAIL=<邮箱地址>

# 证书文件路径
CERT_FILE="/etc/letsencrypt/live/${SERVER_NAME}/fullchain.pem"
# 检测证书文件是否存在
if [ -e "$CERT_FILE" ]; then
		# 更新证书
		certbot renew
else
	echo "Error: File ${CERT_FILE} does not exist." >&2
	# 获取证书
	certbot certonly --standalone -d ${SERVER_NAME} --email ${EMAIL} --agree-tos --no-eff-email --non-interactive
fi

# 在检测后台检测脚本是否过期
/scripts/check_ssl_expiry.sh &

# 启动 Nginx
#nginx -g 'daemon off;'
/docker-entrypoint.sh nginx -g 'daemon off;'
