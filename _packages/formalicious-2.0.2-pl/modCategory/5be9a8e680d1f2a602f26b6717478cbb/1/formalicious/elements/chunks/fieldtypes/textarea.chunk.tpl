<div class="form-group [[!+error:notempty=`has-error`]]">
    <label for="[[!+name]]">[[!+title]][[!+required:notempty=`*`:empty=``]]:</label>
    <div class="form-control--wrapper">
        <textarea id="[[!+name]]" name="[[!+name]]" class="form-control form-control--textarea [[!+error:notempty=`error`]]" [[!+placeholder:notempty=`placeholder="[[!+placeholder]]"`]]>[[!+value]]</textarea>
        [[!+error]]
    </div>
    [[!+description:notempty=`<div class="form-control--description">[[!+description]]</div>`]]
</div>