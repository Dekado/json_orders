<?php
namespace app\commands;

use app\models\Order;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Json;
use yii\httpclient\Client;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Класс контроллера для обработки данных заказов
 */
class OrderController extends Controller
{
    /**
     * Получаем файл с данными из сети Интернет по URL
     * Тестовый url: https://zelenka.ru/sample/orders.json
     * @param $url string
     * @return void
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function actionUpdateNet(string $url = '')
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->send();

        if ($response->isOk && isset($response->data['orders'])) {
            Yii::$app->ordersSaver->processJsonInput($response->data['orders']);
        } else {
            echo 'Не удалось получить список заказов';
        }
    }

    /**
     * Получаем файл с данными локально
     * @param string $path
     * @return void
     */
    public function actionUpdate(string $path = '')
    {
        $dataString = file_get_contents(Yii::getAlias('@app/'. $path));
        $data = Json::decode($dataString, true);

        if (isset($data['orders'])) {
            Yii::$app->ordersSaver->processJsonInput($data['orders']);
        } else {
            echo 'Не удалось получить список заказов';
        }
    }

    /**
     * Получаем информацию по заказу
     * @param $order_id int
     * @return void
     * @throws NotFoundHttpException
     */
    public function actionInfo(int $order_id)
    {
        $order = Order::findOne([$order_id]);

        if (!$order) {
            throw new NotFoundHttpException('Заказ не найден.');
        }

        echo Json::encode($order);
    }

    /**
     * Выводит общее число заказав
     * @return void
     */
    public function actionGetOrdersCount()
    {
        echo Order::find()
            ->asArray()
            ->count();
    }

    /**
     * Удаляет все заказы
     * @return void
     */
    public function actionDeleteOrders()
    {
        Order::deleteAll();
        echo 'Таблица очищена';
    }
}
