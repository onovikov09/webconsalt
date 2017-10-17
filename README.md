Тестовое задание
============================

### Как развернуть проект:

1. Скачать архив с проектом в подготовленную папку либо клонировать через репозиторий
   
     ```
     git clone https://github.com/onovikov09/webconsalt.git ./
     ```

2. Создать папку logs в runtime
   
    ```
    cd runtime
    mkdir logs
    chmod 777 logs
    ```

3. Установить на папку web/assets права на запись
   
    ```
    cd ../web 
    chmod 777 assets
    ```
4. Создать базу данных
   
    ```
    CREATE DATABASE `webconsalt` /*!40100 DEFAULT CHARACTER SET utf8 */;
    ```

5. Применить миграции
    
    ```
    cd ../ 
    ./yii migrate
    ```
    
6. Все готово!