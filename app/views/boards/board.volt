<h2 class="ui dividing header">{{ board.name }}</h2>

{{ stylesheet_link('css/board.css') }}

{{ hidden_field('id', 'id' : 'boardId', 'value' : board.id) }}

<div class="ui active loader"></div>
<div id="boardWrapper" class="ui equal width grid"></div>

{{ alert.getRedirectMessage() }}
{{ javascript_include('js/boards_board.js') }}

<div id="sortable_grid" class="ui equal width stackable divided grid connectedGridSortable" style="margin-top: 0px;">
{% for workflow in workflows %}
    <div class="column">     
        <input type="text" id="workflowId" value="{{ workflow.id }}"/>
        <h3 class="ui dividing header" style="text-align: center;">        
          {{ workflow.name }}   
          <div class="ui lightgrey label" style="{{ workflow.limit > 0 ? '' : 'display:none;' }}">3 / {{ workflow.limit }}</div>
          <a data-tooltip="New Card" data-position="bottom center" style="float:right;"><i class="plus icon"></i></a>
        </h3>
        {#<a class="ui large blue ribbon label">{{ workflow.name }}</a>#}
        <ul id="sortable_{{ workflow.id }}" class="connectedSortable">
            <li>
                <div class="ui red card">                    
                    <div class="content">
                      <img class="right floated mini ui image" src="../../img/avatar/elliot.jpg">                      
                      <div class="header"><h4>Measure load performance of the site.</h4></div>
                      <div class="meta">Some notes for this task.</div>
                      <div class="description">
                        <a class="ui tiny tag label">New</a>
                      </div>                                        
                    </div>
                    <div class="extra content">
                      <div class="ui dropdown red-actions">
                        <div class="text">Actions</div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                          <div class="item"><i class="long arrow alternate right icon"></i>Move right</div>
                          <div class="item"><i class="toggle off icon"></i>Set color</div>
                          <div class="item"><i class="user outline icon"></i>Set responsible</div>
                          <div class="item">
                            <i class="copy icon"></i>
                            Copy/Move
                            <i class="dropdown icon"></i>
                            <div class="menu">
                              <div class="item">Copy here</div>
                              <div class="item">Copy to other board</div>
                              <div class="item">Move to other board</div>
                            </div>
                          </div>
                          <div class="item"><i class="trash alternate outline icon"></i>Delete</div>
                        </div>
                      </div>
                    </div> 
                </div>
            </li>
            <li>
                <div class="ui orange card">                    
                    <div class="content">
                      <img class="right floated mini ui image" src="../../img/avatar/daniel.jpg">
                      <div class="header"><h4>Measure load performance of the site.</h4></div>
                      <div class="meta">Some notes for this task.</div>
                      <div class="description">
                        <a class="ui red tiny tag label">Error</a>
                        <a class="ui teal tiny tag label">From QA</a>
                      </div>  
                    </div>
                    <div class="extra content">
                      <div class="ui dropdown orange-actions">
                        <div class="text">Actions</div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                          <div class="item"><i class="long arrow alternate right icon"></i>Move right</div>
                          <div class="item"><i class="toggle off icon"></i>Set color</div>
                          <div class="item"><i class="user outline icon"></i>Set responsible</div>
                          <div class="item">
                            <i class="copy icon"></i>
                            Copy/Move
                            <i class="dropdown icon"></i>
                            <div class="menu">
                              <div class="item">Copy here</div>
                              <div class="item">Copy to other board</div>
                              <div class="item">Move to other board</div>
                            </div>
                          </div>
                          <div class="item"><i class="trash alternate outline icon"></i>Delete</div>
                        </div>
                      </div>
                    </div> 
                </div>
            </li>
            <li>
                <div class="ui yellow card">                    
                    <div class="content">
                      <img class="right floated mini ui image" src="../../img/avatar/elyse.png">
                      <div class="header"><h4>Measure load performance of the site.</h4></div>
                      <div class="meta">Some notes for this task.</div>
                      <div class="description">
                        <a class="ui blue tiny tag label">Update</a>
                        <a class="ui green tiny tag label">For Review</a>
                      </div>  
                    </div>
                    <div class="extra content">
                      <div class="ui dropdown yellow-actions">
                        <div class="text">Actions</div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                          <div class="item"><i class="long arrow alternate right icon"></i>Move right</div>
                          <div class="item"><i class="toggle off icon"></i>Set color</div>
                          <div class="item"><i class="user outline icon"></i>Set responsible</div>
                          <div class="item">
                            <i class="copy icon"></i>
                            Copy/Move
                            <i class="dropdown icon"></i>
                            <div class="menu">
                              <div class="item">Copy here</div>
                              <div class="item">Copy to other board</div>
                              <div class="item">Move to other board</div>
                            </div>
                          </div>
                          <div class="item"><i class="trash alternate outline icon"></i>Delete</div>
                        </div>
                      </div>
                    </div> 
                </div>
            </li>
            <li>
                <div class="ui green card">                    
                    <div class="content">
                      <img class="right floated mini ui image" src="../../img/avatar/helen.jpg">
                      <div class="header"><h4>Measure load performance of the site.</h4></div>
                      <div class="meta">Some notes for this task.</div>
                    </div>
                    <div class="extra content">
                      <div class="ui dropdown green-actions">
                        <div class="text">Actions</div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                          <div class="item"><i class="long arrow alternate right icon"></i>Move right</div>
                          <div class="item"><i class="toggle off icon"></i>Set color</div>
                          <div class="item"><i class="user outline icon"></i>Set responsible</div>
                          <div class="item">
                            <i class="copy icon"></i>
                            Copy/Move
                            <i class="dropdown icon"></i>
                            <div class="menu">
                              <div class="item">Copy here</div>
                              <div class="item">Copy to other board</div>
                              <div class="item">Move to other board</div>
                            </div>
                          </div>
                          <div class="item"><i class="trash alternate outline icon"></i>Delete</div>
                        </div>
                      </div>
                    </div> 
                </div>
            <li>
                <div class="ui blue card">                    
                    <div class="content">
                      <img class="right floated mini ui image" src="../../img/avatar/jenny.jpg">
                      <div class="header"><h4>Measure load performance of the site.</h4></div>
                      <div class="meta">Some notes for this task.</div>
                    </div>
                    <div class="extra content">
                      <div class="ui dropdown blue-actions">
                        <div class="text">Actions</div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                          <div class="item"><i class="long arrow alternate right icon"></i>Move right</div>
                          <div class="item"><i class="toggle off icon"></i>Set color</div>
                          <div class="item"><i class="user outline icon"></i>Set responsible</div>
                          <div class="item">
                            <i class="copy icon"></i>
                            Copy/Move
                            <i class="dropdown icon"></i>
                            <div class="menu">
                              <div class="item">Copy here</div>
                              <div class="item">Copy to other board</div>
                              <div class="item">Move to other board</div>
                            </div>
                          </div>
                          <div class="item"><i class="trash alternate outline icon"></i>Delete</div>
                        </div>
                      </div>
                    </div> 
                </div>
            </li>
            <li>
                <div class="ui violet card">                    
                    <div class="content">
                      <img class="right floated mini ui image" src="../../img/avatar/molly.png">
                      <div class="header"><h4>Measure load performance of the site.</h4></div>
                      <div class="meta">Some notes for this task.</div>
                    </div>
                    <div class="extra content">
                      <div class="ui dropdown violet-actions">
                        <div class="text">Actions</div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                          <div class="item"><i class="long arrow alternate right icon"></i>Move right</div>
                          <div class="item"><i class="toggle off icon"></i>Set color</div>
                          <div class="item"><i class="user outline icon"></i>Set responsible</div>
                          <div class="item">
                            <i class="copy icon"></i>
                            Copy/Move
                            <i class="dropdown icon"></i>
                            <div class="menu">
                              <div class="item">Copy here</div>
                              <div class="item">Copy to other board</div>
                              <div class="item">Move to other board</div>
                            </div>
                          </div>
                          <div class="item"><i class="trash alternate outline icon"></i>Delete</div>
                        </div>
                      </div>
                    </div> 
                </div>
            </li>
        </ul>        
    </div>
{% else %}
    <div class="ui warning message" style="margin: 10px 0px 0px 10px;">
      <div class="header">
        No existing workflow found for this board.
      </div>
      Visit the board's <b><a href="../../boards/settings/{{ board.id }}" data-tooltip="Open Board Settings" data-position="bottom center"><i class="settings icon"></i>settings</a></b> and add at least one (1) workflow.
    </div>
{% endfor %}
</div>