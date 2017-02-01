[[!FormIt?
    &preHooks=`[[+preHooks]]`
    &hooks=`[[+hooks]]`
    &emailTo=`[[+emailto]]`
    &emailSubject=`[[+subject]]`
    &emailFrom=`[[++emailsender]]`
    &emailTpl=`emailFormTpl`
    &redirectTo=`[[+redirectTo]]`
    &redirectParams=`[[+redirectParams]]`
    &formid=`[[+id]]`
    &validate=`[[+validation]]`
    &fieldNames=`[[+fieldNames]]`
    &formFields=`[[+formFields]]`
    &submitVar=`submit-form[[+id]]`

    &fiarToField=`field_[[+fiaremailto]]`
    &fiarTpl=`fiarTpl`
    &fiarSubject=`[[+fiarsubject]]`
    &fiarFrom=`[[+fiaremailfrom]]`
    &fiarFiles=`[[+fiarattachment]]`
    [[+parameters]]
]]

<hr>
<form action="[[~[[*id]]? &step=`[[!+currentStep]]`]]" method="POST" enctype="multipart/form-data" novalidate>
    [[!+form]]

    [[!+currentStep:neq=`1`:then=`<a href="[[~[[*id]]]]?step=[[!+currentStep:decr=`1`]]">&laquo; [[%prev]]</a>`:else=``]]
    <input type="submit" name="submit-form[[+id]]" value="[[!+submitTitle]]">
</form>