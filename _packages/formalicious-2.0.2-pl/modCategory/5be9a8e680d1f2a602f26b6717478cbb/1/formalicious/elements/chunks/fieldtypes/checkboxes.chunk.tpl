<div class="form-group [[!+error:notempty=`has-error`]]">
    <input type="hidden" name="[[+name]]" />
    [[!+valuesCount:gt=`1`:then=`
        <label>[[!+title]][[!+required:notempty=`*`:empty=``]]:</label>
    `:else=``]]
    <div class="form-control--wrapper">
        [[!+values]]
        [[!+error]]
    </div>
    [[!+description:notempty=`<div class="form-control--description">[[!+description]]</div>`]]
</div>