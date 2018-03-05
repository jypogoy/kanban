<h2>{{ board.name }} Settings</h2>

{{ hidden_field('id', 'id' : 'boardId', 'value' : board.id) }}

{% include 'boards/settings_workflows.volt' %} 
{% include 'boards/settings_tags.volt' %}

{{ alert.getRedirectMessage() }}