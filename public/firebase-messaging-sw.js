// importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging.js');
importScripts("https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging-compat.js");

firebase.initializeApp({
    apiKey: "AIzaSyBuSSfp8WVJIIOwbRREBtGxYACuC_PB9RY",
    authDomain: "gorc-ka.firebaseapp.com",
    projectId: "gorc-ka",
    storageBucket: "gorc-ka.firebasestorage.app",
    messagingSenderId: "454946792892",
    appId: "1:454946792892:web:39fcbb115ee6c477bff7b9"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    self.registration.showNotification(payload.notification.title, {
        body: payload.notification.body,
        icon: payload.notification.icon
    });
});

