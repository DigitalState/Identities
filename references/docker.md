# Docker

The DigitalState Identities microservice docker information.

## Table of Contents

- [Environment Variables](#environment-variables)

## Environment Variables

| Name | Description | Default |
| :--- | :---------- | :------ |
| `COMPOSE_PROJECT_NAME` | The docker-compose project name. This is used to properly namespace docker containers in the event where you are running multiple instances of the platform on the same machine. | `dsidentities` |
| `NETWORK` | The docker network name containers uses for microservices communication. | `dsproxy_default` |
| `DIRECTORY` | The base directory the docker-compose files are located. This is used to properly configure the base directory for DockerForWindows and DockerForMac based machines. | `.` |
| `IMAGE_TAG` | The dockerhub image tag to pull for dev, stag and prod environments. | `0.12.0` |
| `API_HOST` | The virtual host for the api container. This value gets registered with the [proxy](https://github.com/DigitalState/Proxy). | `api.identities.ds` |
| `DATABASE_HOST` | The database host. The database variables create a database when the container first runs. | `identities_database` |
| `DATABASE_PORT` | The database port. | `5432` |
| `DATABASE_NAME` | the database name. | `identities` |
| `DATABASE_USERNAME` | The database username. | `identities` |
| `DATABASE_PASSWORD` | The database password. | `identities` |
| `DATABASE_UI_HOST` | The virtual host for the database ui container. This value gets registered with the [proxy](https://github.com/DigitalState/Proxy). | `ui.database.identities.ds` |
| `CACHE_UI_HOST` | The vritual host for the cache ui container. This value gets registered with the [proxy](https://github.com/DigitalState/Proxy). | `ui.cache.identities.ds` |
