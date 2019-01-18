<div class="form-group [[!+error:notempty=`has-error`]]">
    <label for="[[!+fieldname]]">[[!+title]][[!+required:notempty=`*`:empty=``]]:</label>
    <select id="[[!+fieldname]]" name="[[!+fieldname]]" class="form-control form-control--select">
        [[!+placeholder:notempty=`<option>[[+placeholder]]</option>`]]
        [[!+values]]
    </select>
    [[!+error]]
    [[!+description:notempty=`<p class="form-control--description">[[!+description]]</p>`]]
</div>