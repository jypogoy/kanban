<h2>{{ board.name }} Settings</h2>

{{ hidden_field('id', 'id' : 'boardId', 'value' : board.id) }}

{% include 'boards/tab_settings_workflow_segment.volt' %} 
{% include 'boards/tab_settings_tags.volt' %}
{% include 'boards/tab_settings_colors.volt' %}

{{ alert.getRedirectMessage() }}