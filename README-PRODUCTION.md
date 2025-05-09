# Production Deployment Instructions

## Initial Setup

1. Upload both the `production-docker-compose.yml` and `nginx-app.conf` files to the server:

```bash
scp production-docker-compose.yml root@88.198.107.196:/var/www/logosorthos/
scp nginx-app.conf root@88.198.107.196:/var/www/logosorthos/
```

2. SSH into the server:

```bash
ssh root@88.198.107.196
```

3. Stop and remove existing containers:

```bash
cd /var/www/logosorthos
docker-compose down
```

4. Replace the existing docker-compose.yml file:

```bash
mv production-docker-compose.yml docker-compose.yml
```

5. Update the Nginx configuration:

```bash
mv nginx-app.conf magellan/docker/nginx/conf.d/app.conf
```

6. Start the containers with the new configuration:

```bash
docker-compose up -d
```

## Troubleshooting

If you encounter "502 Bad Gateway" errors:

1. Check the Nginx logs:

```bash
docker logs logosorthos-nginx
```

2. Verify the containers are running and connected:

```bash
docker ps
```

3. Check if the app container is reachable from the Nginx container:

```bash
docker exec logosorthos-nginx ping app
```

4. If needed, restart the containers:

```bash
docker-compose restart
```

The key fix in this setup is:
1. Using a network alias "app" for the PHP application container
2. Configuring Nginx to use "app" instead of "logosorthos-app" in the fastcgi_pass directive
3. This makes the setup resilient to container ID changes
