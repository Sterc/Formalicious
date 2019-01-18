[[!FormIt?
    &hooks=`[[+hooks]]`
    &preHooks=`[[+preHooks]]`
    &renderHooks=`[[+renderHooks]]`
    &emailTo=`[[+emailto]]`
    &emailSubject=`[[+subject]]`
    &emailFrom=`[[++emailsender]]`
    &emailTpl=`[[+emailTpl]]`
    &redirectTo=`[[+redirectTo]]`
    &redirectParams=`[[+redirectParams]]`
    &formid=`[[+id]]`
    &validate=`[[+validation]]`
    &customValidators=`[[+customValidators]]`
    &fieldNames=`[[+fieldNames]]`
    &formFields=`[[+formFields]]`
    &submitVar=`submit-form[[+id]]`
    &formName=`[[+name]]`
    &saveTmpFiles=`1`

    &fiarToField=`field_[[+fiaremailto]]`
    &fiarTpl=`[[+fiarTpl]]`
    &fiarSubject=`[[+fiarsubject]]`
    &fiarFrom=`[[+fiaremailfrom]]`
    &fiarFiles=`[[+fiarattachment]]`
    [[+parameters]]
]]

<hr>
<form action="[[!+formalicious.currentUrl]]" method="POST" enctype="multipart/form-data" novalidate>
    [[!+formalicious.form]]

    [[!+formalicious.step:neq=`1`:then=`<a href="[[!+formalicious.prevUrl]]" class="btn" title="[[%formalicious.prev? &namespace=`formalicious` &topic=`default`]]">
        [[%formalicious.prev? &namespace=`formalicious` &topic=`default`]]
    </a>`:else=``]]
    <button type="submit" class="btn" name="submit-form[[+id]]" value="[[!+submitTitle]]" title="[[!+submitTitle]]">
        [[!+submitTitle]]
    </button>
</form>