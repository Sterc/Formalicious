<div class="form-group [[!+error:notempty=`has-error`]]">
    <label for="[[!+name]]">[[!+title]][[!+required:notempty=`*`:empty=``]]:</label>
    <div class="form-control--wrapper">
        <select id="[[!+name]]" name="[[!+name]]" class="form-control form-control--select [[!+error:notempty=`error`]]">
            [[!+placeholder:notempty=`<option value="">[[+placeholder]]</option>`]]
            [[!+values]]
        </select>
        [[!+error]]
    </div>
    [[!+description:notempty=`<div class="form-control--description">[[!+description]]</div>`]]
</div>