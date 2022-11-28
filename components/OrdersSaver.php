<?php

namespace app\components;

use SebastianBergmann\CodeCoverage\Report\PHP;
use Yii;
use app\models\Order;
use yii\base\Component;

/**
 * Класс обработки данных заказов
 */
class OrdersSaver extends Component
{
    /**
     * Обрабатываем и сохраняем данные
     * @param $orders array
     * @return void
     */
    public function processJsonInput(array $orders)
    {
        foreach ($orders as $order) {
            $model = Order::findOne(['id' => $order['id']]);
            if (!$model) {
                $model = new Order();
            }

            $model->load($order, '');

            if (isset($order['items'])) {
                $model->items_count = count($order['items']);
            }

            if (!$model->validate()) {
                $message = 'Ошибки валидации заказа ID: ' . $order['id'] . ' ' . print_r($model->getErrors(), true);
                echo $message . PHP_EOL;
                Yii::warning($message);
            }

            $model->save();
        }

        echo 'Данные обработаны' . PHP_EOL;
    }
}