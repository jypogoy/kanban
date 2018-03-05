<div class="ui tiny modal flow">
    <i class="close icon"></i>
    <div class="header">
        <i class="random icon"></i>New Work Flow
    </div>
    <div class="content">  

        {{ form('', 'id' : 'dataForm_Workflow', 'class' : 'ui form', 'autocomplete' : 'off') }}
       
            {% for element in workflowForm %}                
                {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
                    {{ element }}           
                {% else %}
                    <div id="{{ element.getName() }}_div" class="{{ element.getAttribute('required') ? 'required' : '' }} field">
                        {{ element.label() }}
                        {{ element.render() }}
                        <div class="ui basic red pointing prompt label transition hidden" id="{{ element.getName() }}_alert" style="text-align: left;">
                            <i class="warning icon"></i>{{ element.getAttribute('requiredMsg') }}
                        </div>
                    </div>
                {% endif %}
            {% endfor %}

            <div class="ui error message"></div>
            
            {{ hidden_field('saveNew', 'id' : 'saveNew') }}
            
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