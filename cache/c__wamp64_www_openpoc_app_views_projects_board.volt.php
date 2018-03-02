<h2><?= $project->name ?> Board</h2>

<?= $this->tag->stylesheetLink('css/board.css') ?>

<?= $this->tag->hiddenField(['id', 'id' => 'projectId', 'value' => $project->id]) ?>


<div id="boardWrapper" class="ui equal width grid"></div>

<?= $this->alert->getRedirectMessage() ?>
<?= $this->tag->javascriptInclude('js/projects_board.js') ?>

<div class="ui equal width stackable divided grid">
<?php foreach ($workflows as $workflow) { ?>
    <div class="column">    
        <h3 class="ui dividing header">
          <?= $workflow->name ?>   
          <div class="ui grey label">3 / 3</div>  
          <a data-tooltip="Add Task" data-position="bottom center" style="float:right;"><i class="plus icon"></i></a>           
        </h3>  
        <ul id="sortable_<?= $workflow->id ?>" class="connectedSortable">
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
<?php } ?>
</div>


 