console.log('login.js')

function login(event)
{
  console.log('login()')
  event.preventDefault()

  const form = event.target.closest('form')
  
  handleFormSubmission(conf.base_url('auth/signin'), 'POST', form)
    .then(res => {
      console.log(res)

      if (res.status == true) {
        let redirect = res?.data?.redirectTo
        setTimeout(() => window.location.href = redirect, 4000);
      }
    })
}