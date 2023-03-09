# Transactions Manager

## Install the Application

### Server

```bash
cd server
composer install  --ignore-platform-reqs
docker-compose up
```

### Client

```bash
cd client
npm install
npm run dev

```

- After that, open `http://localhost:8080/api/v1/install` in your browser to create database tables. (I attached the db
  file but no need to import it install route will do it for you)

- After that, open `http://localhost:8080/api/v1/transactions` in your browser to list transactions,

### API Documentation

- https://documenter.getpostman.com/view/9983821/2s93Jru3tF
