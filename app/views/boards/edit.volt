{{ alert.getRedirectMessage() }}

<h2>Edit Board {{ board.name }}</h2>

{{ form('boards/save', 'role': 'form', 'id' : 'dataForm', 'class' : 'ui form', 'autocomplete' : 'off') }}

    {% for element in form %}
    
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
            <div id="{{ element.getName() }}_div" class="{{ element.getAttribute('required') ? 'required' : '' }} field">
                {{ element.label() }}
                {{ element.render() }}
                <div class="ui basic red pointing prompt label transition hidden" id="{{ element.getName() }}_alert">
                    <i class="warning icon"></i>{{ element.getAttribute('requiredMsg') }}
                </div>
            </div>
        {% endif %}
    {% endfor %}

    <div class="ui error message"></div>

    {{ submit_button('Save Changes', 'class': 'ui primary button', 'onclick': 'return Form.validate(false, false);') }}
    <a href="../../boards" class="ui button">Cancel</a>

</form>

{# Validation messages thrown by the system in case not trapped on UI. #}
{% if messages is defined %}
    {{ alert.getSystemMessage(messages) }}
{% endif %}