<?php
$city = "Bryansk";
$mode = "json";
$units = "metric";
$lang = "en";
$appid = '121508442903343fdb8b8871b8be77ec';
$countDay = 7;
$path = __DIR__.'\cashe.txt';
$url = "http://api.openweathermap.org/data/2.5/forecast/daily?appid=$appid&q=$city&mode=$mode&units=$units&cnt=$countDay&lang=$lang";
$data = file_get_contents($url); //при желании скрыть ошибки - можете вернуть собачку @
$dataJson = json_decode($data);
if(!file_exists('cashe.txt')) { //проверили, существует ли файл кеша
    $cashe = file_put_contents($path, $data); //если нет, то записали данные из сервиса в него
}
/*Оформление ниже - по вашему желанию:)*/
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<?php if(!empty($data)){ //проверили переменную на наличие в ней данных (нужно ли будет использовать кеш)
    $arrayDays = $dataJson->list;
    foreach($arrayDays as $oneDay){ //если данные есть - берем из url ?>
        <table>
        <tr>

            <td> <h3>Утро: </h3></td>
            <td> <h3>День: </h3></td>
            <td> <h3>Вечер: </h3></td>
            <td> <h3>Ночь: </h3></td>
            <td> <h3>Скорость ветра: </h3></td>
            <td> <h3>Погода: </h3></td>
            <td> <h3>Давление: </h3></td>
            <td> <h3>Влажность: </h3></td>
        </tr>
        <tr>

            <td> <?= $oneDay->temp->morn; ?></td>
            <td><?= $oneDay->temp->day; ?></td>
            <td><?= $oneDay->temp->eve; ?></td>
            <td> <?= $oneDay->temp->night; ?></td>
            <td><?= $oneDay->speed; ?></td>
            <td><?= $oneDay->weather[0]->description; ?></td>
            <td><?= $oneDay->pressure; ?></td>
            <td><?= $oneDay->humidity; ?></td>

       </tr>
        </table>
    <?php }
} else { //если в data нет данных - достаем их из cashe.txt (путь прописан в $path)
    $data = file_get_contents($path);
    $dataJson = json_decode($data);
    $arrayDays = $dataJson->list;
    foreach($arrayDays as $oneDay){ ?>
        <table>
            <tr>

                <td> <h3>Утро: </h3></td>
                <td> <h3>День: </h3></td>
                <td> <h3>Вечер: </h3></td>
                <td> <h3>Ночь: </h3></td>
                <td> <h3>Скорость ветра: </h3></td>
                <td> <h3>Погода: </h3></td>
                <td> <h3>Давление: </h3></td>
                <td> <h3>Влажность: </h3></td>
            </tr>
            <tr>

                <td> <?= $oneDay->temp->morn; ?></td>
                <td><?= $oneDay->temp->day; ?></td>
                <td><?= $oneDay->temp->eve; ?></td>
                <td> <?= $oneDay->temp->night; ?></td>
                <td><?= $oneDay->speed; ?></td>
                <td><?= $oneDay->weather[0]->description; ?></td>
                <td><?= $oneDay->pressure; ?></td>
                <td><?= $oneDay->humidity; ?></td>

            </tr>
        </table>
    <?php }} ?>

</body>
</html>
