<nav class="ui fixed menu">
    <a href="#" class="header item">
        
        <i class="table large icon"></i> KANBAN
    </a>
    <?= $this->elements->getMenu() ?>
</nav>

<div class="ui main stackable container">
    <?= $this->flash->output() ?>
    <?= $this->getContent() ?>    
    <div class="footer text-muted"><p>&copy; Copyright 2018, All rights reserved.</p></div>
</div>