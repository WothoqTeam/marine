importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyDIfUD-GXmbl6gubV8i0XQ6Ij6XauaITjk",
    projectId: "unified-marine-services",
    messagingSenderId: "773504700054",
    appId: "1:773504700054:web:2637a0f46a534ccdd3bcb7",
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
