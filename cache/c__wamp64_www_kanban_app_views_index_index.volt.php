
<?= $this->getContent() ?>

<div class="jumbotron">
    <h1>Welcome to KanBan</h1>
    <p>Kanban is a method for managing the creation of products with an emphasis on continual delivery while not overburdening the development team. Like Scrum, Kanban is a process designed to help teams work together more effectively.</p>
    <p><?= $this->tag->linkTo(['register', 'Try it for Free &raquo;', 'class' => 'btn btn-primary btn-large btn-success']) ?></p>
</div>

<div class="row">
    <div class="col-md-4">
        <h2>Manage Boards Online</h2>
        <p>Create, track and export your boards online. Real time monitoring of board activities. </p>
    </div>
    <div class="col-md-4">
        <h2>Dashboards And Reports</h2>
        <p>Gain critical insights into how your boards are doing. See what sells most, who are your top paying customers and the average time your customers take to pay.</p>
    </div>
    <div class="col-md-4">
        <h2>Invite, Share And Collaborate</h2>
        <p>Invite users and share your workload as board supports multiple users with different permissions. It helps your business to be more productive and efficient. </p>
    </div>
</div>
