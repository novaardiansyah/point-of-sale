<?php $this->load->view('firebase/firebase-config'); ?>

<script type="module">
  import { getAuth, signInWithPopup, GoogleAuthProvider } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js";

  const btnSignIn = document.getElementById('signInWithGoogleAccount')
  if (btnSignIn) btnSignIn.addEventListener('click', signInWithGoogleAccount);
  
  function signInWithGoogleAccount()
  {
    console.log('signInWithGoogleAccount()')

    const auth = getAuth();
    auth.languageCode = 'it';
  
    const provider = new GoogleAuthProvider();
    signInWithPopup(auth, provider)
      .then((result) => {
        const credential = GoogleAuthProvider.credentialFromResult(result)
        const user       = result.user;

        const send = {
          token: credential?.accessToken || '',
          email: user?.email || '',
          emailVerified: user?.emailVerified || '',
          isAnonymous: user?.isAnonymous || '',
          displayName: user?.displayName || '',
          photoURL: user?.photoURL || '',
          phoneNumber: user?.phoneNumber || '',
          lastLoginAt: user?.metadata?.lastLoginAt || '',
          lastSignInTime: user?.metadata?.lastSignInTime || '',
        }
        
        const formData = objectToFormData(send)
        formData.append(conf.csrf_name, conf.csrf_hash)

        ajax(conf.base_url('auth/signInWithGoogleAccount'), 'POST', formData)
          .then((result) => {
            conf.csrf_hash = result?.csrf || ''

            if (result.status == false) {
              showToast('danger', result?.message)
              return false
            }

            showToast('success', result?.message)
            setTimeout(() => window.location.href = result?.data?.redirectTo || conf.base_url(), 5000);
            return true
          })
      }).catch((error) => {
        let errorCode    = error?.code || ''
        let email        = error?.customData?.email || ''
        let credential   = GoogleAuthProvider?.credentialFromError(error) || ''
        let errorMessage = error?.message || ''
        
        console.log({ errorCode, errorMessage, email, credential })
        if (errorCode == 'auth/popup-closed-by-user') errorMessage = 'You have closed the authentication popup!'
        if (errorCode == 'auth/cancelled-popup-request') errorMessage = 'You have closed the authentication popup!'

        showToast('danger', errorMessage)
      });
  }
</script>