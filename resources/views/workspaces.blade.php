<!DOCTYPE html>
<html>
<head>
    <title>Рабочие пространства</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/fonts/opensans/opensans.css">
    <link rel="stylesheet" href="/assets/fonts/icomoon/style.css">
    <link rel="stylesheet" href="/build/Style.css">
</head>
<body>

<!-- BEGIN header -->
<header class="header">

    <!-- BEGIN header logo -->
    <div class="header__left">
        <img class="header__logo" src="/assets/img/header/header-logo.svg">
    </div>
    <!-- END header logo -->

    <!-- BEGIN header person -->
    <div class="header__right">
        <div class="dropdown">
            <a class="header__person" data-toggle="dropdown">
                <span class="icon-person header__person-icon"></span>
                {{ Auth::user()->email }}
                <span class="caret"></span>
            </a>
            <ul class="dropdown__menu">
                <li>
                    <a href="/logout">Выйти</a>
                </li>
            </ul>
        </div>

    </div>
    <!-- END header person -->

</header>
<!-- END header -->

<!-- BEGIN homescreen page -->
<article class="page homescreen">
    <div class="container">


    </div> <!-- /container -->
</article>
<!-- END homescreen page -->

<!-- BEGIN modal-->
<div class="modal" id="js-add-modal">
    <div class="modal-backdrop" data-dismiss="modal" data-modal="js-add-modal"></div>

    <!-- BEGIN modal content -->
    <div class="modal__content">

        <!-- BEGIN modal header -->
        <div class="modal__header">
            <h3 class="modal__title">Новое рабочее пространство</h3>
            <input class="text-input" type="text" placeholder="Название рабочего пространства">
        </div>
        <!-- END modal header -->

        <!-- BEGIN modal body -->
        <div class="modal__body">
            <div class="flex-between">
                <div class="flex-between__item flex-between__item_indent">
                    <div class="search-box">
                        <span class="icon-search-gray search-box__icon"></span>
                        <input class="text-input search-box__item" type="text" placeholder="Поиск пользователей">
                    </div>
                </div>
                <div class="flex-between__item flex-between__item_inline flex-between__item_indent flex-between__item_select">
                    <select class="select2-dropdown-regular js-select2">
                        <option value="0">Полный доступ</option>
                        <option value="0">Редактирование</option>
                        <option value="0">Чтение</option>
                    </select>
                </div>
                <div class="flex-between__item flex-between__item_inline flex-between__item_indent">
                    <a class="button button_accent button_round">
                        <span class="icon-control-plus"></span>
                    </a>
                </div>
            </div>
            <div class="modal__inner">
                <div class="modal__inner-center">
                    <p class="text-meta">
                        Для предоставления доступа к своему рабочему пространству необходимо добавить пользователей используя поиск.
                    </p>
                </div>
            </div>
        </div>
        <!-- END modal body -->

        <!-- BEGIN modal footer -->
        <div class="modal__footer">
            <div class="flex-between">
                <div class="flex-between__item flex-between__item_indent">
                    <button class="button button_accent button_fixed">Создать</button>
                    <button class="button button_fixed" data-dismiss="modal" data-modal="js-add-modal">Отмена</button>
                </div>
            </div>
        </div>
        <!-- END modal footer-->

    </div>
    <!-- END modal content-->

</div>
<!-- END modal-->

<!-- BEGIN modal STEP 2-->
<div class="modal" id="js-edit-modal">
    <div class="modal-backdrop" data-dismiss="modal" data-modal="js-edit-modal"></div>

    <!-- BEGIN modal content-->
    <div class="modal__content">

        <!-- BEGIN modal header -->
        <div class="modal__header">
            <h3 class="modal__title">Новое рабочее пространство</h3>
            <input class="text-input" type="text" placeholder="Название рабочего пространства" value="Мое рабочее пространство">
        </div>
        <!-- END modal header -->

        <!-- BEGIN modal body -->
        <div class="modal__body">
            <div class="flex-between">
                <div class="flex-between__item flex-between__item_indent">
                    <div class="search-box">
                        <span class="icon-search-gray search-box__icon"></span>
                        <input class="text-input search-box__item" type="text" placeholder="Поиск пользователей">
                    </div>
                </div>
                <div class="flex-between__item flex-between__item_inline flex-between__item_indent flex-between__item_select">
                    <select class="select2-dropdown-regular js-select2">
                        <option value="0">Полный доступ</option>
                        <option value="0">Редактирование</option>
                        <option value="0">Чтение</option>
                    </select>
                </div>
                <div class="flex-between__item flex-between__item_inline flex-between__item_indent">
                    <a class="button button_accent button_round">
                        <span class="icon-control-plus"></span>
                    </a>
                </div>
            </div>

            <!-- BEGIN access -->
            <div class="modal__inner access">

                <!-- BEGIN access item -->
                <div class="flex-between access-item">
                    <div class="flex-between__item flex-between__item_indent">
                        <p class="access-item__text">
                            jane@yandex.ru
                        </p>
                    </div>
                    <div class="flex-between__item flex-between__item_inline flex-between__item_indent flex-between__item_select">
                        <select class="select2-dropdown-regular js-select2">
                            <option value="0">Полный доступ</option>
                            <option value="1" selected>Редактирование</option>
                            <option value="2">Чтение</option>
                        </select>
                    </div>
                    <div class="flex-between__item flex-between__item_inline flex-between__item_indent">
                        <a class="button button_danger button_round">
                            <span class="icon-control-delete"></span>
                        </a>
                    </div>
                </div>
                <!-- END access item -->

                <!-- BEGIN access item -->
                <div class="flex-between access-item">
                    <div class="flex-between__item flex-between__item_indent">
                        <p class="access-item__text">
                            michelle@yahoo.com
                        </p>
                    </div>
                    <div class="flex-between__item flex-between__item_inline flex-between__item_indent flex-between__item_select">
                        <select class="select2-dropdown-regular js-select2">
                            <option value="0">Полный доступ</option>
                            <option value="1">Редактирование</option>
                            <option value="2" selected>Чтение</option>
                        </select>
                    </div>
                    <div class="flex-between__item flex-between__item_inline flex-between__item_indent">
                        <a class="button button_danger button_round">
                            <span class="icon-control-delete"></span>
                        </a>
                    </div>
                </div>
                <!-- END access item -->

                <!-- BEGIN access item -->
                <div class="flex-between access-item">
                    <div class="flex-between__item flex-between__item_indent">
                        <p class="access-item__text">
                            kirill@kj.ru
                        </p>
                    </div>
                    <div class="flex-between__item flex-between__item_inline flex-between__item_indent flex-between__item_select">
                        <select class="select2-dropdown-regular js-select2">
                            <option value="0" selected>Полный доступ</option>
                            <option value="1">Редактирование</option>
                            <option value="2">Чтение</option>
                        </select>
                    </div>
                    <div class="flex-between__item flex-between__item_inline flex-between__item_indent">
                        <a class="button button_danger button_round">
                            <span class="icon-control-delete"></span>
                        </a>
                    </div>
                </div>
                <!-- END access item -->

                <!-- BEGIN access item -->
                <div class="flex-between access-item">
                    <div class="flex-between__item flex-between__item_indent">
                        <p class="access-item__text">
                            intelit@mail.ru
                        </p>
                    </div>
                    <div class="flex-between__item flex-between__item_inline flex-between__item_indent flex-between__item_select">
                        <select class="select2-dropdown-regular js-select2">
                            <option value="0">Полный доступ</option>
                            <option value="1">Редактирование</option>
                            <option value="2" selected>Чтение</option>
                        </select>
                    </div>
                    <div class="flex-between__item flex-between__item_inline flex-between__item_indent">
                        <a class="button button_danger button_round">
                            <span class="icon-control-delete"></span>
                        </a>
                    </div>
                </div>
                <!-- END access item -->

                <!-- BEGIN access item -->
                <div class="flex-between access-item">
                    <div class="flex-between__item flex-between__item_indent">
                        <p class="access-item__text">
                            crisp@pochta.ru
                        </p>
                    </div>
                    <div class="flex-between__item flex-between__item_inline flex-between__item_indent flex-between__item_select">
                        <select class="select2-dropdown-regular js-select2">
                            <option value="0">Полный доступ</option>
                            <option value="1" selected>Редактирование</option>
                            <option value="2">Чтение</option>
                        </select>
                    </div>
                    <div class="flex-between__item flex-between__item_inline flex-between__item_indent">
                        <a class="button button_danger button_round">
                            <span class="icon-control-delete"></span>
                        </a>
                    </div>
                </div>
                <!-- END access item -->

            </div>
            <!-- END access -->
        </div>
        <!-- END modal body -->

        <!-- BEGIN modal footer -->
        <div class="modal__footer">
            <div class="flex-between">
                <div class="flex-between__item flex-between__item_indent">
                    <button class="button button_accent button_fixed">Создать</button>
                    <button class="button button_fixed" data-dismiss="modal" data-modal="js-edit-modal">Отмена</button>
                </div>
                <div class="flex-between__item flex-between__item_inline flex-between__item_indent">
                    <button class="button button_danger button_fixed">Удалить</button>
                </div>
            </div>
        </div>
        <!-- END modal footer-->

    </div>
    <!-- END modal content-->

</div>
<!-- END modal STEP 2-->

<script src="/build/App.js"></script>
<!-- Пример обращения для поиска пользователей по строке - ищет в имени и email прямые совпадения со строкой поиска -->
<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
<script>
    $.ajax({
        url: '/graph/relationship/edit',
        dataType: 'json',
        method: 'POST',
        data: {
            workspace_id: 11,
            rel_id: 4,
            type: "AAAAA",
            params: JSON.stringify({
                label: 'New node'
            })
        }
    }).success(function (response) {
        console.log(response);
    }).error(function(response) {
        console.log(response.responseJSON);
    });
</script>
<script>
    $.ajax({
        url: '/graph/get',
        dataType: 'json',
        method: 'POST',
        data: {
            workspace_id: 11
        }
    }).success(function (response) {
        console.log(response);
    }).error(function(response) {
        console.log(response.responseJSON);
    });
</script>

</body>
</html>
