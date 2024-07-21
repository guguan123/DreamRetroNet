FROM nginx

RUN sed -i 's/deb.debian.org/mirrors.cloud.aliyuncs.com/g' /etc/apt/sources.list.d/debian.sources
RUN apt-get update && apt-get install -y certbot \
	&& apt-get clean \
	&& rm -rf /var/lib/apt/lists/*
