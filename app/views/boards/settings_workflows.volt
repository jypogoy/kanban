<div class="ui segment">
    <a class="ui blue ribbon label"><i class="random icon"></i>WORK FLOW</a>
    <button class="ui right floated icon small primary button" id="btnAddWorkflow" data-tooltip="Add Work Flow" data-position="bottom center">
        <i class="plus icon"></i>
    </button>
    <p></p>
    <div id="workflowListWrapper">
        <div class="ui active loader"></div>
        <table id="workflowTable" class="ui celled striped table sorted_table">
        <thead class="sorted_head">
            <tr>
                <th width="1%"></th>
                <th class="five wide">NAME</th>
                <th class="nine wide">DESCRIPTION</th>
                <th class="one wide">LIMIT</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
    </div>
</div>

{% include 'boards/settings_workflows_modal.volt' %} 

{{ modals.getConfirmation('delete', 'workflow') }}

{{ javascript_include('js/boards_workflows.js') }}