<?php

namespace App\Console\Commands;

use App\Models;

use Illuminate\Console\Command;

// генерирует код запроса save для модели {model}
class requestSaveGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    private ?string $model;
    private string $folderServices;
    private string $pathToFile;
    private int $NumbStr;

    private string $os; // ежели изволил винду юзать - прими как должное

    protected $signature = 'saveGenerate {model} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = "App\Models\\" . $this->argument('model');

        $model = new $name;
        $columns = $model->getFillable();
        $this->getFilePath($this->generate($columns, $this->argument('model')));


    }

    public function generate($columns, $model)
    {
        $code = "\$" . "$model = new $model();  \n";
        foreach ($columns as $column) {
            $code .= "\$$model->$column = \$request->post('$column');  \n";
        }
        $code .= "\$$model" . "->save();";

        return $code . PHP_EOL;
    }

    private function getFilePath($data): void
    {

        $this->os = php_uname();
        if(str_contains($this->os,'Windows')) {
            $this->folderServices = dirname(__DIR__, 2) . "\\Services\\";
        } else {
            $this->folderServices = dirname(__DIR__, 2) . "/Services/";
        }

        //Получаем путь основной папки для работы
        $this->getFile("Выберите номер папки сервиса"); //Запускаем метод поиска файла
//        $this->getFile("Выберите номер папки сервиса второго уровня");
        $this->getFile("Выберите сервис", true); //Обозначаем что эта точка конечная и необходимо получить путь к файлу
        $numbStr = (int)$this->ask("И наконец выбери номер строки куда вставить код"); //узнаем в какую строку вставить код
        $numbStr -= 1;//переводим номер строки к уровню массива текста
        $text = file_get_contents($this->pathToFile);//получаем текст из файла в переменную
        $textStr = explode("\n", $text);//переводим текст в массив

        if (!isset($textStr[$numbStr])) {//проверяем существует ли выбранная строка
            echo "!!!Номер строки указан не верно. Аварийное завершение скрипта!!!\n";
            die;
        } else {
            $textStr[$numbStr] .= $data;//добавляем нужные нам данные в выбранную строку файла
        }
        $text = implode("\n", $textStr);//переводим массив обратно в текстовый файл
        file_put_contents($this->pathToFile, $text);//записываем изменения в файл
    }

    private function getFile(string $msg = "", $last = false): void
    {
        $msg .= "\n"; //добавляем перевод строки в сообщение
        $output = null; //обнуляем ссылку переменной результата (если это не сделать, то результат всегда будет дописываться)

        if(str_contains($this->os,'Windows')){
            exec("dir /B {$this->folderServices}", $output, $retval);
        } else {
            exec("ls {$this->folderServices}", $output, $retval);

        }
        //получаем список папок по указанному пути
        foreach ($output as $i => $item) {//записываем в сообщение возможные папки
            $numb = $i + 1;//добавляем к ключу индекса единицы для простоты пользователя (начинать с 1 а не с 0)
            $msg .= "[{$numb}] {$item}\n";//заносим название папок в переменную сообщения
        }
        $folder = (int)$this->ask($msg); //предлагаем пользователю выбрать папку

        if (!isset($output[$folder - 1])) {//если выбранной папки не существует в массиве
            echo "!!!Номер папки указан не верно. Аварийное завершение скрипта!!!\n"; //ошибка и завершение
            die;
        }

        if(str_contains($this->os,'Windows')){
            $this->folderServices .= $output[$folder - 1] . '\\';
        } else {
            $this->folderServices .= $output[$folder - 1] . '/'; //добавляем выбранную папку к общесу пути
        }


        if ($last) $this->pathToFile = substr($this->folderServices, 0, -1);//если стоит флаг завершения, получаем полный путь к файлу
    }
}
