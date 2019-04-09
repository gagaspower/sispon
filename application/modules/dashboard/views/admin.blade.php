<?php require_once(APPPATH."modules/layouts/header.blade.php") ?>
<?php require_once(APPPATH."modules/layouts/top_menu.blade.php") ?>
<div class="content-wrapper">
    <div class="container">
        <section class="content">
            @yield('content')
        </section>
    </div>
</div>
<?php require_once(APPPATH."modules/layouts/footer.blade.php") ?>
@yield('js-bottom')
<?php require_once(APPPATH."modules/layouts/scripts.blade.php") ?>


