## Система Управления Знаниями

## Установка

Для развертки проекта, <a href="https://github.com/Warchiefs/graph.warchiefs.pro/archive/master.zip">скачайте</a> репозиторий.

Далее установите все зависимости:<br>
<code>composer install</code>

В файле .env необходимо прописать данные от социальных приложения и БД.<br>
Пример заполненного файла .env<br>
<p>
DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=db<br>
DB_USERNAME=user<br>
DB_PASSWORD=password123<br>
<br><br>
NEO4J_HOST=52.3.248.95<br>
NEO4J_PORT=33638<br>
NEO4J_USER=user<br>
NEO4J_PASSWORD=password123<br>
<br><br>
BROADCAST_DRIVER=log<br>
CACHE_DRIVER=file<br>
SESSION_DRIVER=file<br>
QUEUE_DRIVER=sync<br>
<br><br>
FACEBOOK_CLIENT_ID=1897851810927606<br>
FACEBOOK_SECRET_KEY=c1c3bd9c0ac66e1b280d67a0f1115f03<br>
FACEBOOK_REDIRECT=/callback/facebook<br>
<br><br>
GOOGLE_CLIENT_ID=909522607060-c34nq644f6nms748gleqpi2oosa7ptk1.apps.googleusercontent.com<br>
GOOGLE_SECRET_KEY=k-oy9U9ImDt7umxx2aTyDu08<br>
GOOGLE_REDIRECT=/callback/google<br>
<br><br>
VK_CLIENT_ID=5915470<br>
VK_SECRET_KEY=I56atPHMLfkFdJq6kZWf<br>
VK_REDIRECT=/callback/vkontakte<br>
<br><br>
YANDEX_CLIENT_ID=78d850f7d79a4329b34ff95e2398h1f0<br>
YANDEX_SECRET_KEY=0368ce6947c9455e96b2635854ea7d1e<br>
YANDEX_REDIRECT=/callback/yandex<br>
</p>


## Методы API

...
