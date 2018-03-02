{{ alert.getRedirectMessage() }}

<h2>New Board</h2>

{{ form('boards/create', 'id' : 'dataForm', 'class' : 'ui form', 'autocomplete' : 'off') }}

    {% for element in form %}
    
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
            <div id="{{ element.getName() }}_div" class="{{ element.getValidators() | length > 0 ? 'required' : '' }} field">
                {{ element.label() }}
                {{ element.render() }}
                <div class="ui basic red pointing prompt label transition hidden" id="name_alert">Please enter a board name</div>
            </div>
        {% endif %}
    {% endfor %}

    <div class="ui error message"></div>

    {{ hidden_field('saveNew', 'id' : 'saveNew') }}

    {{ submit_button('Save', 'class': 'ui primary button', 'onclick': 'return Form.validate(false, false);') }}
    {{ submit_button('Save & New', 'class' : 'ui teal button', 'onclick': 'return Form.validate(false, true);') }}
    <a href="../boards" class="ui button">Cancel</a>

</form>

{# Validation messages thrown by the system in case not trapped on UI. #}
{% if messages is defined %}
    {{ alert.getSystemMessage(messages) }}
{% endif %}   