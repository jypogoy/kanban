<?= $this->alert->getRedirectMessage() ?>

<h2>New Project</h2>

<?= $this->tag->form(['projects/create', 'id' => 'dataForm', 'class' => 'ui form']) ?>

    <?php foreach ($form as $element) { ?>
    
        <?php if (is_a($element, 'Phalcon\Forms\Element\Hidden')) { ?>
            <?= $element ?>
        <?php } else { ?>
            <div id="<?= $element->getName() ?>_div" class="<?= ($this->length($element->getValidators()) > 0 ? 'required' : '') ?> field">
                <?= $element->label() ?>
                <?= $element->render() ?>
                <div class="ui basic red pointing prompt label transition hidden" id="name_alert">Please enter a project name</div>
            </div>
        <?php } ?>
    <?php } ?>

    <div class="ui error message"></div>

    <?= $this->tag->hiddenField(['saveNew', 'id' => 'saveNew']) ?>

    <?= $this->tag->submitButton(['Save', 'class' => 'ui primary button', 'onclick' => 'return Form.validate(false);']) ?>
    <?= $this->tag->submitButton(['Save & New', 'class' => 'ui teal button', 'onclick' => 'return Form.validate(false);']) ?>
    <a href="../projects" class="ui button">Cancel</a>

</form>


<?php if (isset($messages)) { ?>
    <?= $this->alert->getSystemMessage($messages) ?>
<?php } ?>   

    