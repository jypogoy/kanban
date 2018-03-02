<h2>Board {{ board.name }}</h2>
<button class="ui right floated icon small primary button" id="btnAddWorkflow" data-tooltip="Add work flow" data-position="bottom center">
        <i class="plus icon"></i>
    </button>


{{ hidden_field('id', 'id' : 'boardId', 'value' : board.id) }}

<div class="ui top attached tabular menu">
    <a class="item active" data-tab="board"><h4><i class="clipboard icon"></i>Board</h4></a>
    <a class="item" data-tab="settings"><h4><i class="settings icon"></i>Settings</h4></a>    
</div>
<div class="ui bottom attached active tab segment" data-tab="board">
    {% include 'boards/tab_settings_board_segment.volt' %}  
</div>
<div class="ui bottom attached tab segment" data-tab="settings">
    {% include 'boards/tab_settings_workflow_segment.volt' %}    
    {#% include 'boards/tab_settings_workflow.volt' %#}
    {% include 'boards/tab_settings_tags.volt' %}
    {% include 'boards/tab_settings_colors.volt' %}
</div>

{{ alert.getRedirectMessage() }}

{{ javascript_include('js/boards_profile.js') }}