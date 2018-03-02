<nav class="ui fixed menu">
    <a href="#" class="header item">
        {#<img class="logo" src="/openpoc/public/img/logo.png">#}
        <i class="table large icon"></i> KANBAN
    </a>
    {{ elements.getMenu() }}
</nav>

<div class="ui main stackable container">
    {{ flash.output() }}
    {{ content() }}    
    <div class="footer text-muted"><p>&copy; Copyright 2018, All rights reserved.</p></div>
</div>