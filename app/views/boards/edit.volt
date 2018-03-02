{{ alert.getRedirectMessage() }}

<h2>Edit Board {{ board.name }}</h2>

{{ form('boards/save', 'role': 'form', 'id' : 'dataForm', 'class' : 'ui form') }}

    {% for element in form %}
    
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
            <div id="name_div" class="{{ element.getValidators() | length > 0 ? 'required' : '' }} field">
                {{ element.label() }}
                {{ element.render() }}
                <div class="ui basic red pointing prompt label transition hidden" id="name_alert">Please enter a board name</div>
            </div>
        {% endif %}
    {% endfor %}

    <div class="ui error message"></div>

    {{ submit_button('Save Changes', 'class': 'ui primary button', 'onclick': 'return Save.validate();') }}
    <a href="../../boards" class="ui button">Cancel</a>

</form>

{# Validation messages thrown by the system in case not trapped on UI. #}
{% if messages is defined %}
    {{ alert.getSystemMessage(messages) }}
{% endif %}