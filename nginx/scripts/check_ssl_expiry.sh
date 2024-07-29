#!/bin/bash

SERVER_NAME=$1
EMAIL=$2

# 证书文件路径
CERT_FILE="/etc/letsencrypt/live/${SERVER_NAME}/fullchain.pem"

while true; do
	# 休眠 5 天（5 天 * 24 小时 * 60 分钟 * 60 秒）
	sleep $((5*24*60*60))

	# 续订证书
	certbot renew
	# 如果证书续订成功，重新加载Nginx配置
	if [ $? -eq 0 ]; then
		nginx -s reload
	fi
done

