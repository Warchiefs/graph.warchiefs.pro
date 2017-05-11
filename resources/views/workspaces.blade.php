<!-- Доступ к объекту User - залогиненного пользователя -->
{{ Auth::user() }}
<hr>
<!-- Доступ к пространствам, владельцем которого является данный пользователь -->
{{ Auth::user()->workspaces }}
<hr>
<!-- Доступ к пространствам, к которым есть какой-либо доступ у авторизованного пользователя -->
{{ Auth::user()->workspaces_shared }}
<hr>

<!-- Доступ к правам на расшаренные пространства -->
@foreach(Auth::user()->workspaces_shared as $shared)
    {{ $shared->pivot->permissions }}
@endforeach

<!-- Полная документация по Blade шаблонизатору и фреймворку Laravel 5.4:
https://laravel.com/docs/5.4/blade
https://laravel.com/docs/5.4
-->

<!-- Пример обращения для поиска пользователей по строке - ищет в имени и email прямые совпадения со строкой поиска -->
<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
<!--
<script>
    $.ajax({
        url: '/users/find',
        dataType: 'json',
        method: 'POST',
        data: {
            string: 'alex'
        }
    }).done(function (res) {
        if (res.success == true) {
            console.log(res.users);
        } else {
            console.log(res.error);
        }
    });
</script>
-->
<!--

Ответ:

Array (2)
0 {id: 1, name: "Alexandr Muradov", email: "wowalexmur@yandex.ru", created_at: "2017-04-21 14:10:27", updated_at: "2017-04-21 14:10:27"}
1 {id: 2, name: "Александр Мурадов", email: "ialexmur@gmail.com", created_at: "2017-04-21 14:13:53", updated_at: "2017-04-21 14:13:53"}

-->
<!-- Привет создания пространства
<script>
    $.ajax({
        url: '/workspace/create',
        dataType: 'json',
        method: 'POST',
        data: {
            name: 'Workspace#1',
            color: '#eee',
            users: JSON.stringify({
                1: '0',
                3: '0'
            })
        }
    }).done(function (res) {
        if (res.success == true) {
            console.log(res.workspace);
        } else {
            console.log(res.error);
        }
    });
</script>

Ответ: {name: "Workspace#1", color: "#eee", own: 2, updated_at: "2017-05-06 23:27:55", created_at: "2017-05-06 23:27:55", …}
-->
