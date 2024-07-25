# [续梦网](http://rmct.cn)
不是我开发的，这个仓库仅作为留档
Forked from 码农李白

### 部署方法：
安装Docker和Docker Compose，克隆所有文件。编辑文件 `./docker-compose.yml`：
```yaml
  mysql:
    image: mysql:5.6
    container_name: mysql
    environment:
      MYSQL_ROOT_PASSWORD: <你希望的数据库管理员密码>
      #MYSQL_DATABASE: mydatabase
      #MYSQL_USER: wap
      #MYSQL_PASSWORD: 5.cPfw_TUROTAxKW
    ports:
      - 3306:3306
    volumes:
      - mysql-data:/var/lib/mysql
    networks:
      - webnet
```
编辑脚本 `./nginx/scripts/start.sh`：
```bash
#!/bin/bash

SERVER_NAME=<网站域名>
EMAIL=<你的邮箱（用于获取SSL证书）>
```
