/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
  importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
 importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
  apiKey: "AIzaSyDo7ROTfCj3FUEdnIRe1t_1vqDcNiN0giY",
    authDomain: "moha-15237.firebaseapp.com",
    databaseURL: "https://moha-15237.firebaseio.com",
    projectId: "moha-15237",
    storageBucket: "moha-15237.appspot.com",
    messagingSenderId: "895678542983",
    appId: "1:895678542983:web:3cabd0402e892222683422"

});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});