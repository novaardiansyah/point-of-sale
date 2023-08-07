console.log('signup.js')

function signup(event)
{
  console.log('signup()')
  event.preventDefault()

  const form     = event.target.closest('form')
  const formData = new FormData(form)
  const data     = Object.fromEntries(formData)

  if (data.check_term_conditions == undefined) return showToast('warning', 'Please accept the terms and conditions')
  if (data.password != data.confirm_password) return showToast('warning', 'Password and confirm password does not match')

  handleFormSubmission(conf.base_url('auth/register'), 'POST', form)
    .then(res => {
      console.log(res)
    })
}