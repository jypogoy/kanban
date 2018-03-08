<div class="ui segment">
    <a class="ui blue ribbon label"><i class="tag icon"></i>TAGS</a>
    <button class="ui right floated icon small primary button" id="btnAddTag" data-tooltip="Add Tag" data-position="bottom center">
        <i class="plus icon"></i>
    </button>
    <p></p>
    <div id="tagListWrapper">
        <div class="ui active loader"></div>
        <table id="tagTable" class="ui celled striped table sorted_table">
        <thead class="sorted_head">
            <tr>
                <th class="five wide">NAME</th>
                <th class="eight wide">DESCRIPTION</th>
                <th>COLOR</th>
                <th class="two wide"></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
    </div>
</div>

{% include 'boards/settings_tags_modal.volt' %} 

{{ modals.getConfirmation('delete', 'tag') }}

{{ javascript_include('js/boards_tags.js') }}