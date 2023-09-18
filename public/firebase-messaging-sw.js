importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyBOlTZQnd-unpJwr59TXr1LFYX2DgWzOOo",
    projectId: "unified-marine",
    messagingSenderId: "369415495916",
    appId: "1:369415495916:web:4900c59aca3176092bc5c9"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
