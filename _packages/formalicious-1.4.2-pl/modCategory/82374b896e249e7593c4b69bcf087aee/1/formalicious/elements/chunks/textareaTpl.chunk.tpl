<div class="form-group [[!+error:notempty=`has-error`]]">
    <label for="[[!+fieldname]]">[[!+title]][[!+required:notempty=`*`:empty=``]]:</label>
    <textarea id="[[!+fieldname]]" name="[[!+fieldname]]" class="form-control form-control--textarea" [[!+placeholder:notempty=`placeholder="[[!+placeholder]]"`]]>[[!+value]]</textarea>
    [[!+error]]
    [[!+description:notempty=`<p class="form-control--description">[[!+description]]</p>`]]
</div>