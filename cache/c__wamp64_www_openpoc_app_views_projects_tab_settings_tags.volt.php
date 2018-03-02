<div class="ui segment">
    <a class="ui blue ribbon label"><i class="tag icon"></i>TAGS</a>
    <button class="ui right floated icon small primary button" id="btnAddTag" data-tooltip="Add tag" data-position="bottom center">
        <i class="plus icon"></i>
    </button>
    <p></p>
    <table class="ui celled striped table">
    <thead>
        <tr>
            <th class="five wide">NAME</th>
            <th class="nine wide">DESCRIPTION</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>2</td>
            <td>
                <a class="ui icon" data-tooltip="Edit" data-position="bottom center">
                    <i class="edit icon"></i>
                </a>
                <a class="ui icon" data-tooltip="Move" data-position="bottom center">
                    <i class="move icon"></i>
                </a>
                <a class="ui icon" data-tooltip="Delete" data-position="bottom center">
                    <i class="remove red icon"></i>
                </a>                        
            </td>
        </tr> 
    </tbody>
    </table>
</div>

<div class="ui tiny modal tag">
    <i class="close icon"></i>
    <div class="header">
        <i class="tag icon"></i>New Tag
    </div>
    <div class="content">  
        <form class="ui form">
            <div class="field">
                <label>Name</label>
                <input type="text" name="flowName">
            </div>
            <div class="field">
                <label>Description</label>
                <textarea name="flowDescription"></textarea>
            </div>         
        </form>
    </div>
    <div class="actions">
        <div class="ui primary button">Save</div>
        <div class="ui teal button">Save & New</div>
        <div class="ui negative button">Cancel</div>        
    </div>
</div>