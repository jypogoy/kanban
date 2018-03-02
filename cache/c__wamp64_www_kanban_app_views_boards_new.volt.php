<?= $this->alert->getRedirectMessage() ?>

<h2>New Board</h2>

<?= $this->tag->form(['boards/create', 'id' => 'dataForm', 'class' => 'ui form', 'autocomplete' => 'off']) ?>

    <?php foreach ($form as $element) { ?>
    
        <?php if (is_a($element, 'Phalcon\Forms\Element\Hidden')) { ?>
            <?= $element ?>
        <?php } else { ?>
            <div id="<?= $element->getName() ?>_div" class="<?= ($this->length($element->getValidators()) > 0 ? 'required' : '') ?> field">
                <?= $element->label() ?>
                <?= $element->render() ?>
                <div class="ui basic red pointing prompt label transition hidden" id="name_alert">Please enter a board name</div>
            </div>
        <?php } ?>
    <?php } ?>

    <div class="ui error message"></div>

    <?= $this->tag->hiddenField(['saveNew', 'id' => 'saveNew']) ?>

    <?= $this->tag->submitButton(['Save', 'class' => 'ui primary button', 'onclick' => 'return Form.validate(false, false);']) ?>
    <?= $this->tag->submitButton(['Save & New', 'class' => 'ui teal button', 'onclick' => 'return Form.validate(false, true);']) ?>
    <a href="../boards" class="ui button">Cancel</a>

</form>


<?php if (isset($messages)) { ?>
    <?= $this->alert->getSystemMessage($messages) ?>
<?php } ?>   