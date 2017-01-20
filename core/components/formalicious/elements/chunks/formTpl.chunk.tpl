[[!FormIt?
    &preHooks=`[[+preHooks]]`
    &hooks=`[[+hooks]]`
    &emailTo=`[[+emailto]]`
    &emailSubject=`[[+subject]]`
    &emailFrom=`[[++emailsender]]`
    &emailTpl=`@CODE:[[+fieldsemailoutput]]`
    &redirectTo=`[[+redirectTo]]`
    &redirectParams=`[[+redirectParams]]`
    &formid=`[[+id]]`
    &validate=`[[+validation]]`
    &fieldNames=`[[+fieldNames]]`
    &formFields=`[[+formFields]]`

    &fiarToField=`field_[[+fiaremailto]]`
    &fiarTpl=`@CODE:[[+fiarcontent]]`
    &fiarSubject=`[[+fiarsubject]]`
    &fiarFrom=`[[+fiaremailfrom]]`
    &fiarFiles=`[[+fiarattachment]]`
    [[+parameters]]
]]

<hr>
<form action="[[~[[*id]]? &step=`[[!+currentStep]]`]]" method="POST">
    [[!+form]]

    [[!+currentStep:neq=`1`:then=`<a href="[[~[[*id]]]]?step=[[!+currentStep:decr=`1`]]">« [[%prev]]</a>`:else=``]]
    <input type="submit" value="[[!+submitTitle]]">
</form>