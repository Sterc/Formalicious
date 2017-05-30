[[!FormIt?
    &preHooks=`[[+preHooks]]`
    &hooks=`[[+hooks]]`
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
<form action="[[~[[*id]]? &[[!+stepParam]]=`[[!+currentStep]]`]]" method="POST" enctype="multipart/form-data" novalidate>
    [[!+form]]

    [[!+currentStep:neq=`1`:then=`<a href="[[~[[*id]]]]?[[!+stepParam]]=[[!+currentStep:decr=`1`]]">&laquo; [[%prev]]</a>`:else=``]]
    <input type="submit" name="submit-form[[+id]]" value="[[!+submitTitle]]">
</form>