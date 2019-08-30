<div class="form-group [[!+error:notempty=`has-error`]]">
    <label for="[[!+name]]">[[!+title]][[!+required:notempty=`*`:empty=``]]:</label>
    <div class="form-control--wrapper">
        <input type="file" name="[[!+name]]" id="[[!+name]]" class="form-control form-control--file [[!+error:notempty=`error`]]" value="[[!+value.name]]" />
        [[!+error]]
        <i>[[!+value.name]]</i>
    </div>
    [[!+description:notempty=`<div class="form-control--description">[[!+description]]</div>`]]
</div>