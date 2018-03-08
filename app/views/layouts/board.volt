<nav class="ui fixed menu">
    <a href="#" class="header item">
        <img class="logo" src="/kanban/public/img/logo.png"> KANBAN
    </a>
    {{ elements.getMenu() }}
</nav>

<div class="ui main wide">
    {{ flash.output() }}
    {{ content() }}    
</div>