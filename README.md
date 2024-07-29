# 续梦网
不是我开发的，这个仓库仅作为留档
Forked from 码农李白

采用了 Nginx + PHP + MySQL + vsftp + Certbot

网页根目录：`./html`

### 部署方法：
安装Docker和Docker Compose，克隆所有文件。编辑文件 `./docker-compose.yml`：
```yaml
# 省略其它部分...
  mysql:
    image: mysql:5.6
    container_name: mysql
    environment:
      MYSQL_ROOT_PASSWORD: <你希望的数据库管理员密码>
    ports:
      - 3306:3306
    volumes:
      - mysql-data:/var/lib/mysql
    networks:
      - webnet
# 省略其它部分...
  ftpd:
    image: garethflowers/ftp-server
    container_name: ftpd
    ports:
      - '20-21:20-21/tcp'
    volumes:
      - ./html:/home/wap
    environment:
      - FTP_USER=<FTP用户名>
      - FTP_PASS=<FTP密码>
      - PUBLICHOST=<服务器IP地址>
# 省略其它部分...
```
编辑脚本 `./nginx/scripts/start.sh`：
```bash
#!/bin/bash

SERVER_NAME=<网站域名>
EMAIL=<你的邮箱（用于获取SSL证书）>
# 省略其它部分...
```
编辑文件 `./nginx/conf.d/default.conf`：
```nginx
server {
        listen 80;
        listen 443 ssl;
        server_name <你的域名>;

        # ssl证书地址
        ssl_certificate /etc/nginx/conf.d/letsencrypt/live/<证书的具体位置，一般是域名>/fullchain.pem;
        ssl_certificate_key /etc/nginx/conf.d/letsencrypt/live/<证书的具体位置，一般是域名>/privkey.pem;

        proxy_set_header Host $host;
        proxy_set_header X-Forwarded-Proto $scheme;
        # 给PHP传递用户IP
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;

        location / {
                if ($host = <wap专用的服务器域名>) {
                        proxy_pass http://127.0.0.1:9092;
                        break;
                }
                if ($scheme = http) {
                        # 如果不需要强制https，可以把下面这行注释掉
                        return 301 https://$host$request_uri;
                }
                proxy_pass http://127.0.0.1:9091/;
        }
# 省略其它部分...
```
启动：
```bash
docker-compose up
```

### 其它
phpMyAdmin的地址：`https://<服务器域名>/pma/`

设置为Linux系统服务，新建文件`/etc/systemd/system/website.service`：
```ini
[Unit]
Description=Docker WebSite Service
Requires=docker.service
After=docker.service

[Service]
RemainAfterExit=yes
WorkingDirectory=<项目路径>
ExecStart=/usr/bin/docker-compose up -d
ExecStop=/usr/bin/docker-compose down

[Install]
WantedBy=multi-user.target
```
