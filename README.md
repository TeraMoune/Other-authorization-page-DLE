# Other-authorization-page-DLE
Хак представляет из себя отдельную страницу авторизации пользователей сайта.
Установка очень проста и потребует минимум изменений.

Для начала разместите файлы в свои места, `login.php` в папку `/engine/modules/`, а файл шаблона в в папку с шаблоном `/templates/skin/`
Затем добавьте запись в файле `/engine/engine.php` ниже `switch ( $do ) {` напишите

```php
case "name_module" :
  include (DLEPlugins::Check(ENGINE_DIR . '/modules/login.php'));  // Для версий движка 13 и выше.
  include ENGINE_DIR . '/modules/login.php';                       // Для версии движка ниже 13.
break;
```
Где **name_module** используйте любое название страницы но главное, чтобы оно не совпадало с другими страницами 
и затем новая страница будет доступна по адресу `http://sitename/index.php?do=name_module`

P.S.1 У меня так и названа **login**

P.S.2 В зависимости от версий движка, код в `login.php` может быть немного другим, это относиться в основном к авторизации через социальные сети.

В файле `login.php` есть два тега {class} и {btnClose}. Их я использую для ajax вызова формы авторизации. 
И назначение их я думаю не должно вызывать вопросов. Можете поправить по себя или удалить если у Вас нету красивых модульных окошек.

```php
if($_SERVER['REQUEST_METHOD'] == 'POST') $tpl->set( '{class}', "ajax-login" );
else $tpl->set( '{class}', "" );
	
if($_SERVER['REQUEST_METHOD'] == 'POST') $tpl->set( '{btnClose}', "<button type=\"button\" class=\"mfp-close\">×</button>" );
else $tpl->set( '{btnClose}', "" );
```
Обращение к странице при помощи ajax точно такое же как и обычный вход. На ссылку с адресом на страницу можно повесить получение формы входа, а если js дал сбой или по ссылке нажали средней кнопкой мыши то будет стандатная страница.

P.S.3 {btnClose} Чисто отсебятина, я использую скрипт [Magnific Popup](https://dimsemenov.com/plugins/magnific-popup/) и там у меня
проблемки с добавлением кнопки на закрытие окна, пришлось её добавить в сам шаблон. Так вот её можно не использовать и удалить вовсе.

Стилизуйте формы и шаблоны самостоятельно, Удачи в установке.

### Контакты
Email: teramoune@gmail.com

Telegram: TeraMoune

### На печеньки...
> ЮMoney: 4100115063692304
> 
> Qiwi nickname: TERAMOUNE
> 
> Wmz: Z990082286464
> 
> Wmr: R425445633105
