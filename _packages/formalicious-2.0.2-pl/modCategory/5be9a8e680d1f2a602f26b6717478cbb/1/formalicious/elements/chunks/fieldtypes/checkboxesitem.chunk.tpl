<label>
    <input type="checkbox" name="[[!+name]][]" id="[[!+name]]_[[!+idx]]" class="form-control form-control--checkbox [[!+error:notempty=`error`]]" value="[[!+title]]"
        [[!FormItIsChecked? &input=`[[!+value]]` &options=`[[!+title]]`]]
    />
    [[!+title]]
</label>