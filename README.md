# restAPI
Создать простой REST сервис проверки заказа

## Установка сервисов для запуска приложения
Все приложение находится в директории restAPI/app. Там же находится docker-compose.yml, для запуска контейнеров.

Для работы приложения запускаются контейнеры NGINX и php-fpm.

В директории restAPI/app выполнить в терминале следующую команду  для запуска контейнеров:
```    
    docker-compose up
```    
URL адрес приложения: 
```
    http://localhost:8080
```
### Коды ошибок
        200: ОК
        400: Неверный запрос
        401: Неавторизован
        404: Не найдено
        405: Метод не разрешен
        50X: Ошибки сервера
## Описание REST API
Этот API использует GET и POST запросы для связи и коды ответов HTTP для определения статуса и ошибок. 
* **URL**

  /rest.php

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `order_id=[integer]`
* **Success Response:**

  * **Code:** 200 <br />
    **Content:** 
    
                  { 
                    "id":"5",
                    "order_id":"00005",
                    "amount":"16000",
                    "response_code":null,
                    "response_desc":null
                   }
 
* **Error Response:**

  * **Code:** 404 NOT FOUND <br />
    **Content:** "Error: 404 Page Not Found"
    
##### Заголовки:
+ content-type - для представления тела ответа в виде JSON

##### Параметры запроса:
+ order_id - идентификатор заказа