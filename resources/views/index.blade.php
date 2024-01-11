<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="w-100 h-100 d-flex justify-content-center m-5">
        <div class="relative w-50 text-center">
            <h4>Тестовое задание "Конвертер валют"</h4>
            <p>
                Спасибо за предоставленную возможность! Для этого задания использовал стек:
                Laravel, Postgres, Laravel Sail (Docker).

                Если приложение было установлено вручную, прошу еще раз проверить была ли инициализирована БД
                (Команда: php artisan migrate --seed).
            </p>
            <a href="/convert" />Перейти к форме</a>
        </div>
    </div>
</body>

</html>