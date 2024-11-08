# Проект на Laravel

Это проект, разработанный на Laravel, который предоставляет API для работы с гостями.

## Требования

- PHP >= 8.3
- Composer
- Docker
- Docker Compose

## Установка и развертывание

Для развертывания проекта с использованием Laravel Sail выполните следующие шаги:

1. **Клонируйте репозиторий:**

   ```bash
   git clone https://github.com/deamonlal/bnovo-test
   cd bnovo-test
   ```

2. **Установите зависимости:**

   ```bash
   composer install
   ```

3. **Запустите скрипт настройки .env файла:**

   ```bash
   ./setupEnv.sh
   ```


4. **Запустите Sail:**

   ```bash
   ./vendor/bin/sail up
   ```

   Это будет запускать контейнеры Docker, необходимые для работы приложения.

5. **Запустите миграции:**

   ```bash
   ./vendor/bin/sail artisan migrate
   ```

## Маршрутизация

Общий путь для каждого запроса в API содержит в себе /api/v1

Общий вид запроса: http://localhost:80/api/v1/guest


## Доступные методы API

### 1. Получить список гостей

- **Метод:** `GET`
- **URL:** `/guests`
- **Параметры:**
    - `limit` (необязательный) - Количество записей для вывода (по умолчанию 100).
    - `offset` (необязательный) - Смещение для пагинации (по умолчанию 0).

**Пример запроса:**
```http
GET /guests?limit=1&offset=0
```

**Пример ответа:**
```http
Connection	close
Content-Type	application/json
X-Debug-Memory	2048
X-Debug-Time	5

{
    "status":true,
    "data":{
        "id":3,
        "name":"Citlalli Lowe",
        "surname":"Schinner",
        "phone":"+15632361127",
        "email":"carlos73@example.com",
        "country":"Ecuador"
    }
}
```

### 2. Создать нового гостя

- **Метод:** `POST`
- **URL:** `/guests`
- **Тело запроса:**
    - `name` - Имя гостя (обязательный).
    - `surname` - Фамилия гостя (обязательный).
    - `phone` - Телефонный номер гостя (обязательный).
    - `email` - Электронная почта гостя (необязательный).
    - `country` - Страна гостя (необязательный).

**Пример запроса:**
```http
POST /guests
Content-Type: application/json

{
  "name": "John",
  "surname": "Doe"
  "phone": "+16078849014"
}
```
**Пример ответа:**
```http
Connection	close
Content-Type	application/json
X-Debug-Memory	2048
X-Debug-Time	5

{
    "status":true,
    "data":{
        "id":1,
        "name":"John",
        "surname":"Doe",
        "phone":"+16078849014",
        "country":"US"
    }
}
```

### 3. Получить информацию о конкретном госте

- **Метод:** `GET`
- **URL:** `/guests/{guest}`
- **Параметры:**
    - `guest` - ID гостя.

**Пример запроса:**
```http
GET /guests/1
```
**Пример ответа:**
```http
Connection	close
Content-Type	application/json
X-Debug-Memory	2048
X-Debug-Time	5

{
    "status":true,
    "data":{
        "id":1,
        "name":"John",
        "surname":"Doe",
        "phone":"+16078849014",
        "country":"US"
    }
}
```

### 4. Обновить информацию о госте

- **Метод:** `PUT` или `PATCH`
- **URL:** `/guests/{guest}`
- **Параметры:**
    - `guest` - ID гостя.
- **Тело запроса:**
  - `name` - Имя гостя (необязательный).
  - `surname` - Фамилия гостя (необязательный).
  - `phone` - Телефонный номер гостя (необязательный).
  - `email` - Электронная почта гостя (необязательный).
  - `country` - Страна гостя (необязательный).

**Пример запроса:**
```http
PUT /guests/1
Content-Type: application/json

{
  "name": "Jane"
}
```
**Пример ответа:**
```http
Connection	close
Content-Type	application/json
X-Debug-Memory	2048
X-Debug-Time	5

{
    "status":true,
    "data":{
        "id":1,
        "name":"Jane",
        "surname":"Doe",
        "phone":"+16078849014",
        "country":"US"
    }
}
```

### 5. Удалить гостя

- **Метод:** `DELETE`
- **URL:** `/guests/{guest}`
- **Параметры:**
    - `guest` - ID гостя.

**Пример запроса:**
```http
DELETE /guests/1
```
**Пример ответа:**
```http
Connection	close
Content-Type	application/json
X-Debug-Memory	2048
X-Debug-Time	5

{
    "status":true,
    "message":"The guest was deleted successfully"
}
```
