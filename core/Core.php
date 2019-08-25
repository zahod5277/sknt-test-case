<?php

class Core {

    public $config = array();
    /** @var Fenom $fenom */
    public $fenom;

    /**
     * Конструктор класса
     *
     * @param array $config
     */
    function __construct(array $config = array()) {
        $this->config = array_merge(
                array(
            'templatesPath' => dirname(__FILE__) . '/Templates/',
            'cachePath' => dirname(__FILE__) . '/Cache/',
            'fenomOptions' => array(
                'auto_reload' => true,
            ),
                ), $config
        );
    }

    public function getFenom() {
        // Работаем только, если переменная класса пуста
        if (!$this->fenom) {
            // Пробуем загрузить шаблонизатор
            // Все выброшенные исключения внутри этого блока будут пойманы в следующем
            try {
                // Подключаем класс загрузки
                if (!class_exists('Fenom')) {
                    require 'Fenom.php';
                    // Регистрируем остальные классы его методом
                    Fenom::registerAutoload();
                }
                // Проверяем и создаём директорию для кэширования скомпилированных шаблонов
                if (!file_exists($this->config['cachePath'])) {
                    mkdir($this->config['cachePath']);
                }
                // Запускаем Fenom
                $this->fenom = Fenom::factory($this->config['templatesPath'], $this->config['cachePath'], $this->config['fenomOptions']);
            }
            // Ловим исключения, если есть, и отправляем их в лог
            catch (Exception $e) {
                $this->log($e->getMessage());
                // Возвращаем false
                return false;
            }
        }

        // Возвращаем объект Fenom
        return $this->fenom;
    }

    public function run($template, $vars) {
        if ($fenom = $this->getFenom()) {
            return $fenom->fetch($template, [
                'pagetitle' => 'Главная',
            ]);
        } else {
            echo '404';
            return '';
        }
    }

    /**
     * Обработка входящего запроса
     * Очень простой маршрутизатор
     * @param $uri
     */
    public function handleRequest($uri, $vars) {
        switch ($uri) {
            case 'index.php':
            case '':
                echo $this->run('home.tpl', []);
                break;
            default:
                break;
        }
    }

    /**
     * Метод удаления директории с кэшем
     *
     */
    public function clearCache() {
        $this->rmDir($this->config['cachePath']);
        mkdir($this->config['cachePath']);
    }

    /**
     * Рекурсивное удаление директорий
     *
     * @param $dir
     */
    public function rmDir($dir) {
        $dir = rtrim($dir, '/');
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (is_dir($dir . '/' . $object)) {
                        $this->rmDir($dir . '/' . $object);
                    } else {
                        unlink($dir . '/' . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }

    /**
     * Логирование. Пока просто выводит ошибку на экран.
     *
     * @param $message
     * @param $level
     */
    public function log($message, $level = E_USER_ERROR) {
        trigger_error($message, $level);
    }

}
