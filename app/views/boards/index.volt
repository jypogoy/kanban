<h2><i class="columns icon"></i>Boards</h2>

<form class="ui form" id="listForm" action="boards" method="post">
    {{ hidden_field("sortField", "value" : sortField) }}
    {{ hidden_field("sortDirection", "value" : sortDirection) }}
    {{ hidden_field("itemsPerPage", "value" : itemsPerPage) }}
    {{ hidden_field("currentPage", "value" : currentPage) }}
    <div class="ui equal width stackable grid">
        <div class="column">
            <div class="ui action left icon input">
                <i class="search icon"></i>
                {{ text_field("keyword", "id" : "fieldKeyword", "placeholder" : "Type in keywords...", "value" : keyword) }}
                <button type="submit" class="ui teal submit button">Submit</button>
                <!-- <div class="ui teal submit button">Submit</div>
                <button class="ui button" type="reset" id="resetBtn">Reset</button> -->
            </div>            
        </div>
        <div class="right aligned column">
            <a href="boards/new" class="ui primary button"><i class="plus icon"></i>New Board</a>
        </div>
    </div>     
</form>  

<table class="ui sortable selectable celled striped table">
    <thead>
        <tr>
            <th class="five wide <?php echo $sortField == 'name' ? 'sorted' . ($sortDirection == 'DESC' ? ' descending' : ' ascending') : '' ?>" 
                onclick="sort('name', '<?php echo $sortDirection == 'DESC' ? ($sortField != 'name' ? 'DESC' : 'ASC') : ($sortField != 'name' ? 'ASC' : 'DESC') ?>');">NAME</th>
            <th class="nine wide <?php echo $sortField == 'description' ? 'sorted' . ($sortDirection == 'DESC' ? ' descending' : ' ascending') : '' ?>" 
                onclick="sort('description', '<?php echo $sortDirection == 'DESC' ? ($sortField != 'description' ? 'DESC' : 'ASC') : ($sortField != 'description' ? 'ASC' : 'DESC') ?>');">DESCRIPTION</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {% for item in page.items %}
        <tr>
            <td>{{ item.name }}</td>
            <td>{{ item.description }}</td>
            <td>
                <a href="boards/board/{{ item.id }}" data-tooltip="Open Board" data-position="bottom center">
                    <i class="columns icon"></i>
                </a>
                <a href="boards/settings/{{ item.id }}" data-tooltip="Settings" data-position="bottom center">
                    <i class="settings icon"></i>
                </a>    
                <a href="boards/edit/{{ item.id }}" data-tooltip="Edit this board" data-position="bottom center">
                    <i class="edit icon"></i>
                </a>
                <a href onclick="del('{{ item.id }}', '{{ item.name }}'); return false;" data-tooltip="Delete this board" data-position="bottom center">
                    <i class="remove red icon"></i>
                </a>                             
            </td>
        </tr>
        {% else %}
            <!--No products to show...-->
        {% endfor %}
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">
                {{ listing.getPagination(page, start, end, totalItems, currentPage, itemsPerPage) }}                                        
            </th>
        </tr>
    </tfoot>
</table>

{{ alert.getRedirectMessage() }}
{{ modals.getConfirmation('delete', 'Board') }}

<div class="ui active loader"></div>

{{ javascript_include('js/boards_list.js') }}