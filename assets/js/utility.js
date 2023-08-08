document.body.insertAdjacentHTML('afterbegin', `<div class="toast-container position-static" id="toast-container"></div>`)

function showToast(icon = 'success', message = '') 
{
  const container = document.getElementById('toast-container');
  container.innerHTML = '';

  const toast = `<div class="toast align-items-center position-fixed text-white bg-gradient-${icon} p-2 border-0 bottom-5 end-2" role="alert" aria-live="assertive" aria-atomic="true" id="toast">
    <div class="d-flex">
      <div class="toast-body">
        ${message}
      </div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>`

  container.insertAdjacentHTML('afterbegin', toast);

  const bootstrapToast = new bootstrap.Toast(document.getElementById('toast'));
  bootstrapToast.show();
}

function ajax(url, method, data) 
{
  console.log('ajax()')

  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open(method, url, true);

    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          resolve(JSON.parse(xhr.responseText));
        } else {
          reject(new Error(`Request failed with status: ${xhr.status}`));
        }
      }
    };

    xhr.onerror = function () {
      reject(new Error('Request failed'));
    };

    xhr.send(data);
  });
}

/**
 * ? Handle form submission
 * ! Dependent on :
 * *   > ajax(), showToast()
 * *   > conf.csrf_name, conf.csrf_hash
 */
function handleFormSubmission(url, method, form) {
  console.log('handleFormSubmission()')

  return new Promise((resolve, reject) => {
    const formData = new FormData(form)
    formData.append(conf.csrf_name, conf.csrf_hash)

    ajax(url, method, formData)
      .then(response => {
        conf.csrf_hash = response.csrf

        if (!response.status) {
          if (response.message === 'invalid-form') {
            Object.keys(response.error).forEach(function (key) {
              let error = response.error[key]
              form.querySelector(`.invalid-feedback.${key}`).innerHTML = error
              form.querySelector(`[name="${key}"]`).classList.add('is-invalid')
            })

            showToast('warning', 'Please check your form, some fields are invalid')
          } else {
            showToast('danger', response.message)
          }
        } else {
          showToast('success', response.message)
        }

        resolve(response)
      })
      .catch(error => {
        form.reset()
        console.error('Error:', error)
        showToast('danger', 'Something went wrong, please try again')
        reject(error)
      })
  })
}


// ? remove invalid-feedback when input field is clicked
document.addEventListener('DOMContentLoaded', function() {
  const inputs = document.querySelectorAll('input, textarea, select, checkbox, radio')

  inputs.forEach(function(input) {
    input.addEventListener('click', function() {
      const propertyName    = input.getAttribute('name')
      const invalidFeedback = document.querySelector(`.invalid-feedback.${propertyName}`)
      
      if (invalidFeedback) {
        invalidFeedback.innerHTML = ''
        input.classList.remove('is-invalid')
      }
    })
  })
})

function objectToFormData(obj) {
  const formData = new FormData();
  for (const key in obj) {
    if (obj.hasOwnProperty(key)) {
      formData.append(key, obj[key]);
    }
  }
  return formData;
}