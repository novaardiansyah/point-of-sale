<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js"
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: '<?= $_ENV['FIREBASE_API_KEY']; ?>',
    authDomain: '<?= $_ENV['FIREBASE_AUTH_DOMAIN']; ?>',
    projectId: '<?= $_ENV['FIREBASE_PROJECT_ID']; ?>',
    storageBucket: '<?= $_ENV['FIREBASE_STORAGE_BUCKET']; ?>',
    messagingSenderId: '<?= $_ENV['FIREBASE_MESSAGING_SENDER_ID']; ?>',
    appId: '<?= $_ENV['FIREBASE_APP_ID']; ?>'
  }

  // Initialize Firebase
  const app = initializeApp(firebaseConfig)
</script>