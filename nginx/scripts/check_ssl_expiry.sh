#!/bin/bash

SERVER_NAME=$1
EMAIL=$2

# 证书文件路径
CERT_FILE="/etc/letsencrypt/live/${SERVER_NAME}/fullchain.pem"

while true; do

	# 检测证书文件是否存在
	if [ ! -e "$CERT_FILE" ]; then
		echo "Error: File ${CERT_FILE} does not exist." >&2
		exit 1
	fi

	# 获取当前日期和证书过期日期
	CURRENT_DATE=$(date +%s)
	EXPIRY_DATE=$(date -d "$(openssl x509 -enddate -noout -in "$CERT_FILE" | cut -d= -f2)" +%s)

	# 计算有效期剩余天数
	DAYS_LEFT=$(( (EXPIRY_DATE - CURRENT_DATE) / 86400 ))

	# 检查有效期是否低于1个月（30天）
	if [ "$DAYS_LEFT" -lt 30 ]; then
		echo "Warning: SSL certificate for $CERT_FILE is valid for less than 30 days."
		echo "Days left: $DAYS_LEFT"
		certbot certonly --webroot -w /var/www/html -d ${SERVER_NAME} --email ${EMAIL} --agree-tos --no-eff-email --non-interactive
	else
		echo "SSL certificate for $CERT_FILE is valid for more than 30 days."
		echo "Days left: $DAYS_LEFT"
	fi

	# 休眠 30 天（30 天 * 24 小时 * 60 分钟 * 60 秒）
	sleep $((24*60*60))
done

