<div class="form-group [[!+error:notempty=`has-error`]]">
    <label for="[[!+fieldname]]">[[!+title]][[!+required:notempty=`*`:empty=``]]:</label>
    <input type="text" id="[[!+fieldname]]" name="[[!+fieldname]]" class="form-control" value="[[!+value]]" [[!+placeholder:notempty=`placeholder="[[!+placeholder]]"`]] />
    [[!+error]]
    [[!+description:notempty=`<p class="form-control--description">[[!+description]]</p>`]]
</div>