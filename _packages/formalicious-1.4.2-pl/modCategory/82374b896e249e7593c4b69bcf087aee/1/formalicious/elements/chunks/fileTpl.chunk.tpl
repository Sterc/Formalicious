<div class="form-group [[!+error:notempty=`has-error`]]">
    <label for="[[!+fieldname]]">[[!+title]][[!+required:notempty=`*`:empty=``]]:</label>
    <input type="file" name="[[!+fieldname]]" id="[[!+fieldname]]" class="form-control form-control--file" value="[[!+value.name]]" />
    [[!+error]]
    <i>[[!+value.name]]</i>
    [[!+description:notempty=`<p class="form-control--description">[[!+description]]</p>`]]
</div>