   $(document).ready(function() {
       const config = {
           apiKey: "AIzaSyDo7ROTfCj3FUEdnIRe1t_1vqDcNiN0giY",
           authDomain: "moha-15237.firebaseapp.com",
           databaseURL: "https://moha-15237.firebaseio.com",
           projectId: "moha-15237",
           storageBucket: "moha-15237.appspot.com",
           messagingSenderId: "895678542983",
           appId: "1:895678542983:web:3cabd0402e892222683422"

       };

       firebase.initializeApp(config);
       const messaging = firebase.messaging();
       messaging.usePublicVapidKey("BF2lDTgqhjcDt5aPbdEg0iS7jgycknTTsn7BbPtJ23lQtScRDJBy7Fw9y9wyPVBKppSguc85SxFcf3f1sowiOx4");

       
            messaging.requestPermission()
                .then(function () {
                  console.log("success connection")
                 // if(isTokenSentToServer()){
                    // console.log("token allredy send")
                 // }else{
                     getRegisterToken()
                 // }
                   

                })


               
                .catch(function (err) {

                    console.log("Unable to get permission to notify.", err);
                });

              function getRegisterToken(){

                   // Get Instance ID token. Initially this makes a network call, once retrieved
                            // subsequent calls to getToken will return from cache.
                            messaging.getToken().then((currentToken) => {
                              if (currentToken) {
                                console.log(currentToken);
                                reseveToken();
                                sendTokenToServer(currentToken);
                                //updateUIForPushEnabled(currentToken);
                              } else {
                                // Show permission request.
                                console.log('No Instance ID token available. Request permission to generate one.');
                                // Show permission UI.
                                //updateUIForPushPermissionRequired();
                                setTokenSentToServer(false);
                              }
                            }).catch((err) => {
                              console.log('An error occurred while retrieving token. ', err);
                              //showToken('Error retrieving Instance ID token. ', err);
                              setTokenSentToServer(false);
                            });

               }
               function setTokenSentToServer(sent) {
                 window.localStorage.setItem('sentToServer', sent ? '1' : '0');
                 }

                 function isTokenSentToServer() {
                        return window.localStorage.getItem('sentToServer') === '1';
                        }


                 function sendTokenToServer(currentToken) {
                     if (!isTokenSentToServer()) {
                    console.log('Sending token to server...');
                   // TODO(developer): Send the current token to your server.
                   setTokenSentToServer(true);
                   } else {
                     console.log('Token already sent to server so won\'t send it again ' +
                     'unless it changes');
    }

  }


 function  reseveToken(){

        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
        $.ajax({
           url: '{{url(route('save-device-token'))}}',
           type: 'POST',
           data: {

               fcm_token: token
           },
           success: function (response) {
               console.log(response)
           },
           error: function (err) {
               console.log(" Can't do because: " + err);
           },
       });
    }


   })