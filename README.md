Тестовое задание https://gist.github.com/bezdelnique/ee37c8ab9566f091e96b6e10d2d4d36b?signup=true

В качестве СУБД использована sqlite.

Для запуска проекта необходимо:
1. `git clone`
2. Перейти в папку проекта и затем `composer install`
3. `yii migrate`
4. `yii order/update-net https://zelenka.ru/sample/orders.json` - сохранить заказы по url
4. `yii order/update sample/orders.json` - сохранить заказы из файла
4. `yii order/info 80018` - вывести информацию о заказе
4. `yii order/get-orders-count` - вывести количество сохраненных моделей
4. `yii order/delete-orders` - удалить все заказы