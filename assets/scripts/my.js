$('.ui.form.loginform')
  .form({
    fields: {
        username     : 'empty',
        password : ['empty']
    }
  })
;


$('.ui.form.signupform')
  .form({
    fields: {
        first_name     : 'empty',
        last_name     : 'empty',
        email     : 'email',
        password : ['minLength[6]']
    }
  })
;