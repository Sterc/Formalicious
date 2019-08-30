<div class="form-group [[!+error:notempty=`has-error`]]">
    <label for="[[!+name]]">[[!+title]][[!+required:notempty=`*`:empty=``]]:</label>
    <div class="form-control--wrapper">
        <input type="email" id="[[!+name]]" name="[[!+name]]" class="form-control [[!+error:notempty=`error`]]" value="[[!+value]]" [[!+placeholder:notempty=`placeholder="[[!+placeholder]]"`]] />
        [[!+error]]
    </div>
    [[!+description:notempty=`<div class="form-control--description">[[!+description]]</div>`]]
</div>