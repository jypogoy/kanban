<h2><?= $project->name ?> Settings</h2>

<?= $this->tag->hiddenField(['id', 'id' => 'projectId', 'value' => $project->id]) ?>

<div class="ui segment">
    <a class="ui blue ribbon label"><i class="random icon"></i>WORK FLOW</a>
    <button class="ui right floated icon small primary button" id="btnAddWorkflow" data-tooltip="Add work flow" data-position="bottom center">
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
                <th></th>
            </tr>
        </thead>
        <tbody>                
            
        </tbody>
        </table>
    </div>

    
</div>

<div class="ui tiny modal flow">
    <i class="close icon"></i>
    <div class="header">
        <i class="random icon"></i>New Work Flow
    </div>
    <div class="content">  

        <?= $this->tag->form(['', 'id' => 'dataForm_Workflow', 'class' => 'ui form', 'autocomplete' => 'off']) ?>
       
            <?php foreach ($form as $element) { ?>
                
                <?php if (is_a($element, 'Phalcon\Forms\Element\Hidden')) { ?>
                    <?= $element ?>           
                <?php } else { ?>
                    <div id="<?= $element->getName() ?>_div" class="<?= ($this->length($element->getValidators()) > 0 ? 'required' : '') ?> field">
                        <?= $element->label() ?>
                        <?= $element->render() ?>
                        <div class="ui basic red pointing prompt label transition hidden" id="name_alert">Please enter a work flow name</div>
                    </div>
                <?php } ?>
            <?php } ?>

            <div class="ui error message"></div>
            
            <?= $this->tag->hiddenField(['saveNew', 'id' => 'saveNew']) ?>

            
            
        </form>
    </div>
    <div class="actions">
        <div id="editActions">
            <div class="ui primary button" onclick="saveWorkflow(false);">Save changes</div>
            <div class="ui negative button">Cancel</div>        
        </div>
        <div id="newActions">
            <div class="ui primary button" onclick="saveWorkflow(false);">Save</div>
            <div class="ui teal button" onclick="saveWorkflow(true);">Save & New</div>
            <div class="ui negative button">Cancel</div>        
        </div>    
    </div>
</div>

<?= $this->modals->getConfirmation('delete', 'Workflow') ?>

<?= $this->tag->javascriptInclude('js/projects_workflows_ajax.js') ?> 
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
<div class="ui segment">
    <a class="ui blue ribbon label"><i class="toggle on icon"></i>COLORS</a>
    <button class="ui right floated icon small primary button" id="btnAddColor" data-tooltip="Add color" data-position="bottom center">
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

<div class="ui tiny modal color">
    <i class="close icon"></i>
    <div class="header">
        <i class="toggle on icon"></i>New Color
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

<?= $this->alert->getRedirectMessage() ?>